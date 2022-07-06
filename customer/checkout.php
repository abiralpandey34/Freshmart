<?php include '../reusable/errorReporting.php'?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../sass/main.css">
  <link rel="stylesheet" href="../css/checkout.css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Google fonts -->
  <link    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"    rel="stylesheet">

  <title> Freshmart</title>
</head>

<body>

  <header> 
    <?php  
      include '../reusable/new_customer_header.php'; 
    ?> 
  </header>

  <section id="checkout-wraper">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="billing-details">
            <h4>Billing Details</h4>
            <div class="user-name">
            <?php
              echo "<h4>".$_SESSION['user_name']."</h4>";
            ?>
            </div>
            <form style='padding:0px;' method="POST" action='paypal.php'>
              <div class="row">
                <div class="col-md-12">
                  <label>Collection Day</label><br>
                  <select onchange="addTimes()" name="collection-day" id="dayCollectionSelect"></select>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <label>Collection Time:</label><br>
                  <select name="collection-time" id="timeCollectionSelect"></select>
                </div>
              </div>
          <br>
          <h6>Complete Your Order</h6>
          <div class="icons">
          <button type="submit" class='proceed-button' style='width:100%'> Pay<span style='font-weight:600'>Pal</span> </button>
          </form>
          </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card" style='height:auto'>

          <!-- Cart items are here-->
          <?php 
          
            $currentCartID = $_SESSION['currentActiveCart'];

            //This part will retrieve product information from PRODUCT_CART
            $productCartQuery="SELECT FK2_PRODUCT_ID, ITEM_QUANTITY FROM PRODUCT_CART WHERE FK1_CART_NO = $currentCartID";
            $productCartResult=  oci_parse($connection, $productCartQuery); 
            oci_execute($productCartResult); 

            $totalPrice = 0;
            while (($productCartRow = oci_fetch_assoc($productCartResult))) {

              $testCurrentProduct = $productCartRow['FK2_PRODUCT_ID'];
              $testCurrentProductQuantity = $productCartRow['ITEM_QUANTITY'];

              //This nested part is required to fetch details of PRODUCT of a particular cart items.
              $currentProductQuery="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID	 = $testCurrentProduct";
              $currentProductResult=  oci_parse($connection, $currentProductQuery); 
              oci_execute($currentProductResult); 

              while ($currentProductRow = oci_fetch_assoc($currentProductResult)) {

                // Storing values into variables for later on use.
                $currentProductPrice = $currentProductRow['PRODUCT_PRICE'];
                $totalPrice = ($currentProductRow['PRODUCT_PRICE'] * $testCurrentProductQuantity) + $totalPrice ;

                echo "
                <div class='product-box'>
                  <div class='image-container'>
                      <img src='../images/products/$currentProductRow[PRODUCT_IMAGE]'>
                  </div>
                  <div class='description-container'>
                      <p class='product-name'>$currentProductRow[PRODUCT_NAME]</p>";
              }
                $currentSubTotal = $testCurrentProductQuantity * $currentProductPrice;
                      echo "
                      <p class='product-quantity'>In cart: $testCurrentProductQuantity</p>
                      <p class='product-sub-total'>Sub-Total: $currentSubTotal </p>
                  </div>
                  <div class='additional'>
                      <a href='../cart/cart-delete.php?productID=$testCurrentProduct'>Del</a>
                  </div>
                </div>";
            }
            
              echo "<p class='product-total'> Total Price : Rs ".$totalPrice."</p>";?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <?php include '../reusable/footer_customer.php';?>
  </footer>
  

  
</body>

<script src="../js/collectionSlot.js"></script>


</html>