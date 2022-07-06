<!DOCTYPE html>
<html lang="en">

<head>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"  rel="stylesheet">

  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
  <title> Order History</title>
  
  <style>

    #order-history {
      padding-top: 50px;
    }
    #order-history .verification {
      border: 1px solid rgba(0, 0, 0, .125);
      padding-top: 30px;
      padding-bottom: 30px;
      border-radius: 4px;
      padding-left: 40px;
      padding-right: 40px;
    }
    #order-history .verification .verification-logo img {
      width: 270px;
    }
    #order-history .verification .verification-logo {
      text-align: center;
      padding-bottom: 15px;
    }
    #order-history .verification .card {
      padding-top: 20px;
      padding-bottom: 20px;
    }
    #order-history .verification .card table {
      text-align: center;
    }
    #order-history tbody {
      background-color: #f6f6f6;
    }
    #order-history th {
      font-weight: normal;
    }
    @media(max-width:768px) {
    #order-history .verification {
        border: 1px solid rgba(0, 0, 0, .125);
        padding-top: 30px;
        padding-bottom: 30px;
        border-radius: 4px;
        padding-left: 0px;
        padding-right: 0px;
      }
      
    }
    @media(max-width:576px) {
    #order-history .card-body {
        padding-left: 0px;
        padding-right: 0px;
      }
    #order-history .verification {
        border: unset;
      }
    }

    @media(min-width:768px) {
      #order-history .table-responsive {
        display: inline-table !important;
      width: 100%;
      overflow-x: auto;
      
      }
    }
    #order-history .form-row .btn {
      background-color: #96bf2e;
      border-color: #96bf2e;
    }
    #order-history .cc {
      margin-right: -15px;
    }
    #order-history .form-control {
      box-shadow: unset;
    }
    #order-history .form-control:focus {
      border-color: #96bf2e;
    }
    #order-history .page-link {
    color: #96bf2e;
    }

    .complete{
      padding:2px 5px;
      /* background-color:rgb(129, 192, 34, 0.6); */
      /* color:white; */
      border-radius:5px;
    }

    .incomplete{
      padding:2px 5px;
      /* background-color:#f7ec16; */
      /* color:black; */
      border-radius:5px;
    }
  </style>
</head>

<body>

<?php include '../reusable/new_customer_header.php' ?>

  <section id="order-history">
    <div class="container">
      <div class="verification">
        <div class="verification-logo">
          <img src="../images/logo.png" alt="logo">
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <h4>Order History</h4>
              </div>
              <div class="col-md-4">
               
              </div>
            </div>
            <table class="table table-responsive">
              <thead>
                <tr style="background-color: #96bf2e;">
                  <th scope="col"><b>Order ID</b></th>
                  <th scope="col"><b>Date</b></th>
                  <th scope="col"><b>Item</b></th>
                  <th scope="col"><b>Price</b></th>
                  <th scope="col"><b>Status</b></th>
                </tr>
              </thead>
              <tbody>

                <?php

                  $currentActiveUser = $_SESSION['user_id'];

                  $fetchPaymentDetailsQuery="SELECT P.FK1_ORDER_ID, P.PAYMENT_AMOUNT, P.TRANSACTION_DATE, CO.IS_DELIVERED FROM PAYMENT P INNER JOIN CUST_ORDER CO ON CO.PK_ORDER_ID = P.FK1_ORDER_ID WHERE P.FK3_USER_ID = $currentActiveUser ORDER BY FK1_ORDER_ID DESC";
                  $fetchPaymentDetailsResult=  oci_parse($connection, $fetchPaymentDetailsQuery); 
                  oci_execute($fetchPaymentDetailsResult); 
    
                  while ($fetchPaymentDetailsRow = oci_fetch_assoc($fetchPaymentDetailsResult)) {

                    $currentActiveOrder = $fetchPaymentDetailsRow['FK1_ORDER_ID'];

                    echo "
                      <tr>
                        <th scope='row'>#$fetchPaymentDetailsRow[FK1_ORDER_ID]</th>
                        <td>$fetchPaymentDetailsRow[TRANSACTION_DATE]</td>
                        <td>";

                        $fetchQuantityDetailsQuery="SELECT P.PRODUCT_NAME, OD.PRODUCT_QUANTITY FROM ORDER_DETAILS OD INNER JOIN PRODUCT P ON P.PK_PRODUCT_ID = OD.FK3_PRODUCT_ID WHERE OD.FK1_ORDER_ID = $currentActiveOrder";
                        $fetchQuantityDetailsResult=  oci_parse($connection, $fetchQuantityDetailsQuery); 
                        oci_execute($fetchQuantityDetailsResult); 
          
                        while ($fetchQuantityDetailsRow = oci_fetch_assoc($fetchQuantityDetailsResult)) {
                          echo "<li style='list-style:none;'> $fetchQuantityDetailsRow[PRODUCT_NAME] X $fetchQuantityDetailsRow[PRODUCT_QUANTITY] </li>";
                        }

                        echo "</td>
                        <td>$fetchPaymentDetailsRow[PAYMENT_AMOUNT]</td>
                        <td>";
                          if($fetchPaymentDetailsRow['IS_DELIVERED'] == 'Y'){echo "<p class='complete'>Completed</p>";}
                          else{echo "<p class='incomplete'>Incomplete</p>";}
                        echo "</td>
                      </tr>";
                  }

                ?>

              </tbody>
            </table>
            <br>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include '../reusable/footer_customer.php' ?>


</body>

</html>