  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="sass/main.css">

  <!-- Fonts awesome for icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Fonts Google -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



  <?php include 'connection.php';
    error_reporting(0);
  ?>

<section id="logo-serch-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-lg-4">
          <div class="logo">
          <a href="index.php">
            <img src="images/logo.png" alt="logo" class="img-fluid">
          </a>
        </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-6">
          <form class="search" action="./productSearchPage.php" method="GET" >
            <div class="form-row">
              <div class="col">
                <input type="text" name="searchQuery" class="form-control" placeholder="Search for product">
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2 col-sm-12 col-lg-2">
          <div class="user-cart-cover">
            <div class="user">
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-togglee" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="far fa-user"></i>

                <!-- To fetch User Name on navbar -->
                  <?php 
                        if( !empty($_SESSION['user_name'])){
                          $arr = explode(' ',trim($_SESSION['user_name']));
                          echo'<p>'.$arr[0].'</p>';
                          }
                        else{
                          echo'<p> Login/Signup </p>';
                        }
                       ?>


                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                   <?php
                        //Navbar options for logged in and not logged in users.
                        
                        if( !empty($_SESSION['user_name'])){
                          echo'<a class="dropdown-item" href="#">Profile</a>';
                          echo'<a class="dropdown-item" href="./login_user/logout.php">Logout</a>';
                        }

                        else{
                          echo '<a class="dropdown-item" href="./login_user/login_form.php">Login</a>
                                <a class="dropdown-item" href="./register_user/register_form_customer.php">Sign up</a>';
                        }

                        ?>
                </div>
              </div>
            </div>
            <div class="cart">

            <!-- Cart PHP backend starts from here.  -->
            <?php 

            if(!empty($_SESSION['user_id'])){

              $currentCartID = $_SESSION['currentActiveCart'];

              echo "
              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
                <i class='fas fa-shopping-cart my-cart-icon'></i>
                <div class='items'>
                  <span class='badge badge-notify my-cart-badge'>$_SESSION[currentActiveCartSize]</span>
              </div>
              </button>";
  
              //This part will retrieve product information from PRODUCT_CART
              $productCartQuery="SELECT FK2_PRODUCT_ID, ITEM_QUANTITY FROM PRODUCT_CART WHERE FK1_CART_NO = $currentCartID";
              $productCartResult=  oci_parse($connection, $productCartQuery); 
              oci_execute($productCartResult); 
  
              
              echo '
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">My Cart</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Images</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Remove</th>
                          </tr>
                        </thead>
                        <tbody>';
                        
                        
                        while (($productCartRow = oci_fetch_assoc($productCartResult))) {
  
                          $testCurrentProduct = $productCartRow['FK2_PRODUCT_ID'];
                          $testCurrentProductQuantity = $productCartRow['ITEM_QUANTITY'];
  
                          //This nested part is required to fetch details of PRODUCT of a particular cart items.
                          $currentProductQuery="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID	 = $testCurrentProduct";
                          $currentProductResult=  oci_parse($connection, $currentProductQuery); 
                          oci_execute($currentProductResult); 
  
                          while ($currentProductRow = oci_fetch_assoc($currentProductResult)) {
                            echo "
  
                            <tr>
                              <th scope='row'> <img src='images/$currentProductRow[PRODUCT_IMAGE]' alt='img'></th>
                              <td>$currentProductRow[PRODUCT_NAME]</td>
                              <td>$currentProductRow[PRODUCT_PRICE]</td>
                              <td>$testCurrentProductQuantity</td>
                              <td><a href='cart/cart-delete.php?productID=$testCurrentProduct'><i class='fas fa-times'></i></a></td>
                            </tr>";
  
                          }
                        }
  
                        //Total price kasari nikalni idea xa? hamro database ma direct price vanne kei rakhexainam.. 
                        // inner join garera garna parxa.. good luck.
                        echo '
                        </tbody>
                      </table>
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <h6><b>Total Price</b></h6>
                        </div>
                        <div class="col-md-6">
                          <h6>Rs. 150/-</h6>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="checkout.php"> <button type="button" class="btn btn-primary">Checkout</button></a>
                    </div>
                  </div>
                </div>
              </div>';
            }

            else{

              echo "
              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
                <i class='fas fa-shopping-cart my-cart-icon'></i>
                <div class='items'>
                  <span class='badge badge-notify my-cart-badge'>"; 

                  // Calculating Total Items of an array.
                  $totalItems = 0;
                  foreach($_SESSION['guestCurrentCart'] as $cart){
                    foreach($cart as $productId => $productQuantity){
                      $totalItems  = $productQuantity + $totalItems;
                    }
                  }

                  echo $totalItems;

                  
                  echo"</span>
              </div>
              </button>";

              echo '
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">My Cart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Images</th>
                              <th scope="col">Name</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Remove</th>
                            </tr>
                          </thead>
                          <tbody>';

              foreach($_SESSION['guestCurrentCart'] as $cart){
                foreach($cart as $productId => $productQuantity){

                  


                  $testCurrentProduct = $productId;
                  $testCurrentProductQuantity = $productQuantity;

                  //This nested part is required to fetch details of PRODUCT of a particular cart items.
                  $currentProductQuery="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID	 = $testCurrentProduct";
                  $currentProductResult=  oci_parse($connection, $currentProductQuery); 
                  oci_execute($currentProductResult); 

                  while ($currentProductRow = oci_fetch_assoc($currentProductResult)) {
                    echo "

                    <tr>
                      <th scope='row'> <img src='images/$currentProductRow[PRODUCT_IMAGE]' alt='img'></th>
                      <td>$currentProductRow[PRODUCT_NAME]</td>
                      <td>$currentProductRow[PRODUCT_PRICE]</td>
                      <td>$testCurrentProductQuantity</td>
                      <td><a href='cart/cart-delete.php?productID=$testCurrentProduct'><i class='fas fa-times'></i></a></td>
                    </tr>";
                  }
                }

                
              }

              //Total price kasari nikalni idea xa? hamro database ma direct price vanne kei rakhexainam.. 
              // inner join garera garna parxa.. good luck.
                        echo '
                        </tbody>
                      </table>
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <h6><b>Total Price</b></h6>
                        </div>
                        <div class="col-md-6">
                          <h6>Rs. 150/-</h6>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="checkout.php"> <button type="button" class="btn btn-primary">Checkout</button></a>
                    </div>
                  </div>
                </div>
                </div>';


            }

            
            ?>
              <!-- end -->


              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- js file -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- <script src="js/main.js"></script>  This file is causing that scrolling bug -->
  <script src="js/popper.min.js"></script>
  <script src="js/internal.min.js"></script>
  