<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .container {
            margin: auto;
            width: 50%;
            border: 3px solid #96bf2e;
            padding: 10px;
        }
        .order, .icon, .texts, .table{
            margin: auto;
            width:50%;
            text-align: center;
            align-items: center;
            padding: 0;
        }
        .texts{
            width: auto;
        }
        
    </style>  
    <title>Document</title>
</head>

<body>
         <div class="container">

            <?php 
              //$previousActiveCart =  $_SESSION['previousActiveCart'];
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
                    <h3>Order Successful</h3>
                    <div class='icon'>
                        <i class='far fa-check-circle'></i>
                    </div>
                </div>
                <div class='texts'>
        
                    <h5 style='color:#666; padding-top:15px;'>Here is Your Invoice</h5>
                
                    <h3>Order ID: <span>#$fetchPaymentDetailsRow[FK1_ORDER_ID]</span> </h3>
                       
                    <h3>Date: <span>$fetchPaymentDetailsRow[TRANSACTION_DATE]</span> </h3>
                </div>
            
                <table class='table'>
                    <thead>
                        <tr style='background-color:#f6f6f6; color:#000;'>
                          <th scope='col'>Item</th>
                          <th scope='col'>Price</th>
                          <th scope='col'>Quantity</th>
                        </tr>
                    </thead>
                ";
                    
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
                    <div class='texts'>
                    <h5 style='color:#666; padding-top:15px;'>Thank You for your order ! <br /> Best regards, <br />  Freshmart</h5>
                  </div>
                  </div>";

                    
              }

            ?>

         </div>

  

 
</body>

</html>