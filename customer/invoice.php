<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../sass/main.css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  
  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <title> Freshmart</title>
  <style>
    #invoice-wrapper {
	padding-top: 50px;
}
#invoice-wrapper .invoice {
	border:1px solid rgba(0,0,0,.125);
	padding-top: 30px;
	padding-bottom: 30px;
	border-radius: 4px;
	padding-left: 40px;
	padding-right: 40px;
}
#invoice-wrapper .invoice .order {
	text-align: center;
}
#invoice-wrapper .invoice .order i {
	font-size: 30px;
	color: #28a745;
}
#invoice-wrapper .invoice .order h4 {
	color: #28a745;
}
#invoice-wrapper .invoice .invoice-logo img {
	width: 270px;
}
#invoice-wrapper .invoice .invoice-logo {
	text-align: center;
}
#invoice-wrapper .invoice h5 {
	text-align: center;
}
#invoice-wrapper .invoice .card {
	padding-top: 20px;
	padding-bottom: 20px;
}
#invoice-wrapper h3 {
	font-size: 20px;
}
#invoice-wrapper span {
	color: #666;
}
#invoice-wrapper .return i {
	color: red;
}
#invoice-wrapper .return {
	text-align: center;
}

  </style>
</head>

<body>

    <?php include '../reusable/new_customer_header.php' ?>
   
       <section id="invoice-wrapper">
         <div class="container">
          <div class="invoice">

            <?php 
            
              $previousActiveCart =  $_SESSION['previousActiveCart'];
              $currentActiveUser = $_SESSION['user_id'];
              $currentActiveOrder = $_SESSION['currentActiveOrder'];
              // $currentActiveOrder =11;
              

              // $previousActiveCart = 15;
              // $currentActiveUser = $_SESSION['user_id'];

              $fetchPaymentDetailsQuery="SELECT * FROM PAYMENT WHERE FK1_ORDER_ID = $currentActiveOrder AND FK3_USER_ID = $currentActiveUser ";
              $fetchPaymentDetailsResult=  oci_parse($connection, $fetchPaymentDetailsQuery); 
              oci_execute($fetchPaymentDetailsResult); 

              while ($fetchPaymentDetailsRow = oci_fetch_assoc($fetchPaymentDetailsResult)) {

                    echo "<div class='order'>
                  <h4>Order Successful</h4>
                  <i class='far fa-check-circle'></i>
                  <h5 style='color: #666;padding-top: 15px;'>Here is Your Invoice</h5>
                </div>
                <div class='card mb-3'>
                  <div class='invoice-logo'>
                    <img src='../images/logo.png' alt='logo'>
                  </div>
                  <div class='row no-gutters'>
                    <div class='col-md-8'>
                      <div class='card-body'>
                        <h3>Order ID: <span>#$fetchPaymentDetailsRow[FK1_ORDER_ID]</span> </h3>
                      </div>
                    </div>
                    <div class='col-md-4'>
                      <div class='card-body'>
                        <h3>Date: <span>$fetchPaymentDetailsRow[TRANSACTION_DATE]</span> </h3>
                      </div>
                    </div>
                  </div>
                  <table class='table'>
                    <thead>
                      <tr style='background-color: #f6f6f6;color: #000;'>
                        <th scope='col'>Item</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Quantity</th>
                      </tr>
                    </thead>";
                    
                    $fetchProductDetailsQuery="SELECT * FROM ORDER_DETAILS WHERE FK1_ORDER_ID = $currentActiveOrder";
                    $fetchProductDetailsResult=  oci_parse($connection, $fetchProductDetailsQuery); 
                    oci_execute($fetchProductDetailsResult); 
      
                    while ($fetchProductDetailsRow = oci_fetch_assoc($fetchProductDetailsResult))  {

                        $currentProductID = $fetchProductDetailsRow['FK3_PRODUCT_ID'];

                        $fetchCurrentProductDetailsQuery="SELECT PRODUCT_NAME, PRODUCT_PRICE FROM PRODUCT WHERE PK_PRODUCT_ID = $currentProductID";
                        $fetchCurrentProductDetailsResult=  oci_parse($connection, $fetchCurrentProductDetailsQuery); 
                        oci_execute($fetchCurrentProductDetailsResult); 

                        while ($fetchCurrentProductDetailsRow = oci_fetch_assoc($fetchCurrentProductDetailsResult))  {
                          echo "<tbody>
                            <tr>
                              <th scope='row'>$fetchCurrentProductDetailsRow[PRODUCT_NAME]</th>
                              <td>$fetchCurrentProductDetailsRow[PRODUCT_PRICE]</td>
                            ";
                        }
                        echo "<td> $fetchProductDetailsRow[PRODUCT_QUANTITY] </td></tr>";
                      }

                      echo "
                        <tr>
                          <th scope='row'>Total price:</th>
                          <td><strong>Rs $fetchPaymentDetailsRow[PAYMENT_AMOUNT]</strong> </td>
                        </tr>
                      
                      </tbody>
                    
                    </table>
                    <h5>Thank You for your order !</h5>
                  </div>";

                    
              }

            ?>



            

            <div class="return">
              
             <a href="index.php"><h6>Return to home page</h6></a> 
            </div>
          </div>
         </div>
       </section>


    <?php include '../reusable/footer_customer.php' ?>
  

 
</body>

</html>