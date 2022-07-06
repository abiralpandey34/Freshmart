<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <title> Paypal</title>

  <style>

    #payment {
      padding-top: 70px;
    }

    #payment .collection {
      padding-bottom: 15px;
      text-align: center;
      padding-bottom: 30px;
    }

    #payment .collection li {
      list-style: none;
      font-weight: 500;
      font-size: 18px;
    }

    #payment .thank-you {
      text-align: center;
      padding-top: 50px;
    }

    #payment .thank-you h6 {
      font-style: italic;
      font-size: 21px;
    }

    @media(max-width:576px) {
      #payment .thank-you h6 {
        font-size: 13px;
      }
    }

    #paypal-button-container {
      text-align: center;
    }

    #payment .collection span {
      color: #666;
      font-size: 18px;
      color: #96bf2e;
      padding-left: 5px;
    }

    #payment .id-order {
      color: #666;
      font-weight: 500;
      padding-left: 5px;
    }

    #payment .total-p {
      color: #96bf2e;
      font-weight: 600;
    }

    #payment .ordersm h5 {
      text-align: left;
      color: #96bf2e;
    }

    #payment .ordersm h6 {
      text-align: right;
    }
    @media(max-width:576px){
  #payment .ordersm h5 {
    font-size: 15px;
  }
}
</style>
</head>

<?php   

  include '../reusable/connection.php';
  include '../reusable/errorReporting.php';

  //I had to change timezone before fetching 
  date_default_timezone_set('Asia/Kathmandu');

  //Fetching collection Time and Day from form
  $collectionTime = $_POST['collection-time'];
  $collectionDay = strtoupper(trim($_POST['collection-day']));

  //Fetching Current Active Cart
  $currentActiveCart = $_SESSION['currentActiveCart'];


  //Querying pickup from database table. 
  $pickupIdQuery="SELECT PK_PICKUP_ID FROM COLLECTION_SLOT WHERE TIMESLOT = '$collectionTime' AND PICKUP_DAY = '$collectionDay'";
  $pickupIdResult=  oci_parse($connection,$pickupIdQuery); 
  oci_execute($pickupIdResult); 

  while (($pickupIdRow = oci_fetch_assoc($pickupIdResult))) {
    $pickupId = $pickupIdRow['PK_PICKUP_ID'];
  }

  //We are fetching date of range 8 days. 
  //The reason it is 8 days is because our command on line 128 is uses IN BETWEEN so, to keep it in 'in between', we are taking 8 days.
  $selectedDateEnd = date("d-M-Y", strtotime("$collectionDay"));
  $selectedDateStart = date("d-M-Y", strtotime("$collectionDay -8 day"));


  // Now we are going to check if particular user-selected pick time/day contains more than 20 orders or not.
  $totalOrdersQuery="SELECT COUNT(PK_ORDER_ID) FROM CUST_ORDER WHERE ORDER_DATE BETWEEN TO_DATE('$selectedDateStart', 'DD-mm-YYYY') AND TO_DATE('$selectedDateEnd', 'DD-mm-YYYY')  AND FK_PICKUP_ID = $pickupId";
  $totalOrdersResult=  oci_parse($connection,$totalOrdersQuery); 
  oci_execute($totalOrdersResult); 

  while (($totalOrdersRow = oci_fetch_assoc($totalOrdersResult))) {
    $totalOrdersCount = $totalOrdersRow['COUNT(PK_ORDER_ID)'];
  }

  if($totalOrdersCount >= 20){
    header('Location: ../error-pages/orderMaxSlot.php');
  }


  $date = date("Y-m-d H:i:s");
  $newDate = "'".$date."'";


  /* Creating Order for this current Order with success flag as 'N'

  Order ID is generated everytime because, Pickup time and slot might have changed than previous time,
  so, generating a new order_id makes sure that old pickup time & slot doesn't interfere. 
  */
  
  $createOrderQuery="INSERT INTO CUST_ORDER(PK_ORDER_ID, FK_CART_NO, IS_SUCCESS, FK_PICKUP_ID, ORDER_DATE, ORDER_TIME, IS_DELIVERED) VALUES (PK_ORDER_ID.NEXTVAL, $currentActiveCart ,'N' ,$pickupId, TO_DATE($newDate, 'yyyy/mm/dd hh24:mi:ss'), TO_DATE($newDate, 'yyyy/mm/dd hh24:mi:ss'), 'N')";
  $createOrderResult=  oci_parse($connection,$createOrderQuery); 
  oci_execute($createOrderResult); 

  $fetchOrderIdQuery="SELECT PK_ORDER_ID FROM CUST_ORDER WHERE FK_CART_NO = $currentActiveCart";
  $fetchOrderIdResult=  oci_parse($connection,$fetchOrderIdQuery); 
  oci_execute($fetchOrderIdResult); 

  while (($fetchOrderIdRow = oci_fetch_assoc($fetchOrderIdResult))) {
    $_SESSION['currentActiveOrder'] = $fetchOrderIdRow['PK_ORDER_ID'];
  }

?>



<body>
  <section id="payment">
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="collection">
            <li>Collection time is:<span><?php echo $collectionTime ?></span></li>
            <li>Collection Day is:<span><?php echo $collectionDay?></span></li>
          </div>
          <div class="ordersm">
            <div class="row">
              <div class="col-6">
                <h5>Order Summary</h5>
              </div>
              <div class="col-6">
                <h6><strong>Order id: <span class="id-order">#<?php echo $_SESSION['currentActiveOrder'];?></span></strong></h6>
              </div>
            </div>
          </div>
          <div class="order-summary">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Items</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                </tr>
              </thead>
              <tbody>
              <?php
                
                $cartProductsFetchQuery="SELECT * FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
                $cartProductsFetchResult=  oci_parse($connection, $cartProductsFetchQuery); 
                oci_execute($cartProductsFetchResult); 

                while ($cartProductsFetchRow = oci_fetch_assoc($cartProductsFetchResult))  {

                  $currentItemQuantity = $cartProductsFetchRow['ITEM_QUANTITY'];
                  $currentProductId = $cartProductsFetchRow['FK2_PRODUCT_ID'];


                  $productDetailsFetchQuery="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID = $currentProductId";
                  $productDetailsFetchResult=  oci_parse($connection, $productDetailsFetchQuery); 
                  oci_execute($productDetailsFetchResult); 

                  while ($fetchCurrentProductDetailsRow = oci_fetch_assoc($productDetailsFetchResult))  {

                    echo "
                      <tr>
                        <td>$fetchCurrentProductDetailsRow[PRODUCT_NAME]</th>
                        <td>$currentItemQuantity</td>
                        <td>$fetchCurrentProductDetailsRow[PRODUCT_PRICE]</td>
                      </tr>
                      ";
                  }
                }
              ?>
                <tr>
                  <td></td>
                  <td><b>Total price</b></td>
                  <td class="total-p"><?php echo $_SESSION['currentTotalPrice'];?>/-</td>
                </tr>
              </tbody>
            </table>
          </div>

            <div id="paypal-button-container">  </div>
        </div>
        <div class="col-md-2">
        </div>
      </div>

    </div>
  </section>






  <!-- js file -->
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/internal.min.js"></script>

  <script
              src="https://www.paypal.com/sdk/js?client-id=AWAhb86DRbyR0hr_hE-29W_NAcA8xNRwwsSeZpEO6PFJzK7l91JnZB24wb16QUlnk_dECFvwndqJDM6i&currency=GBP"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
              </script>
            <script>
              paypal.Buttons({
                createOrder: function (data, actions) {
                  // This function sets up the details of the transaction, including the amount and line item details.
                  return actions.order.create({
                    purchase_units: [{
                      amount: {
                        currency_code: "GBP",
                        value: '<?php echo $_SESSION['currentTotalPrice'];?>'
                      }
                    }]
                  });
                },
                onApprove: function (data, actions) {
                  // This function captures the funds from the transaction.
                  return actions.order.capture().then(function (details) {
                    // This function shows a transaction success message to your buyer.
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    location.href='paymentSuccess.php';

                  });
                }
              }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
            </script>

</body>

</html>