  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css"> -->
  <link rel="stylesheet" type="text/css" href="../sass/main.css">

  <!-- Fonts awesome for icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Fonts Google -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



  <?php 
  
  include '../reusable/connection.php';
  include '../reusable/errorReporting.php';
    
  ?>

<section id="logo-serch-cart" style='padding-bottom:0px;'>
    <div class="container">
      <div class="row">

        <div class="col-md-3 col-sm-12 col-lg-3">
          <div class="logo">
            <a href="../customer/index.php">
              <img src="../images/logo.png" alt="logo" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-md-1 col-sm-12 col-lg-1"> </div>


        <div class="col-md-6 col-sm-12 col-lg-6">
          <form class="search" action="productSearchPage.php" method="GET" >
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

                  <!-- User Icon is here -->
                  <div><svg xmlns="http://www.w3.org/2000/svg" style="transform:scale(1.2)" width="24" height="24" viewBox="0 0 24 24"><path d="M20.822 18.096c-3.439-.794-6.641-1.49-5.09-4.418 4.719-8.912 1.251-13.678-3.732-13.678-5.082 0-8.465 4.949-3.732 13.678 1.598 2.945-1.725 3.641-5.09 4.418-2.979.688-3.178 2.143-3.178 4.663l.005 1.241h1.995c0-3.134-.125-3.55 1.838-4.003 2.851-.657 5.543-1.278 6.525-3.456.359-.795.592-2.103-.338-3.815-2.058-3.799-2.578-7.089-1.423-9.026 1.354-2.275 5.426-2.264 6.767-.034 1.15 1.911.639 5.219-1.403 9.076-.91 1.719-.671 3.023-.31 3.814.99 2.167 3.707 2.794 6.584 3.458 1.879.436 1.76.882 1.76 3.986h1.995l.005-1.241c0-2.52-.199-3.975-3.178-4.663z"/></svg>
                  
                    <!-- To fetch User Name on navbar -->
                    <?php 
                      if( !empty($_SESSION['user_name'])){
                        $arr = explode(' ',trim($_SESSION['user_name']));
                        echo"<p style='font-weight:600;text-transform:uppercase;font-size:12px;padding-top:5px;' >".$arr[0].'</p>';
                        }
                      else{
                        echo"<p style='font-weight:600;text-transform:uppercase;font-size:12px;padding-top:5px;'> Login/Signup </p>";
                      }
                    ?>

                  </div>
                </a>
                
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                   <?php
                        //Navbar options for logged in and not logged in users.
                        
                        if( !empty($_SESSION['user_id'])){

                          if(empty($_SESSION['currentAdminId'])){
                          echo'<a class="dropdown-item" href="../customer/updateProfileCustomer.php">Profile</a>';
                          echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                          }

                          else{
                            
                            echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                          }
                        }

                        elseif(!empty($_SESSION['currentTraderId'])){
                          
                          if(empty($_SESSION['currentAdminId'])){
                            echo'<a class="dropdown-item" href="../trader-dashboard/updateProfileTrader.php">Profile</a>';
                            echo'<a class="dropdown-item" href="../trader-dashboard/trader-dashboard.php">Dashboard</a>';
                            echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                            }
  
                            else{
                              echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                            }
                        } 

                        elseif(!empty($_SESSION['currentAdminId'])){
                          echo'<a class="dropdown-item" href="../admin/admin-dashboard.php">Dashboard</a>';
                          echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                        }

                        else{
                          echo '<a class="dropdown-item" href="../login_user/login_form.php">Login</a>
                                <a class="dropdown-item" href="../register_user/register_form_customer.php">Sign up</a>
                                <hr>
                                <a class="dropdown-item" href="../login_user/login_form_trader.php">Trader Login</a>
                                <a class="dropdown-item" href="../register_user/register_form_trader.php">Trader Signup</a>';
                        }

                        ?>
                </div>
              </div>
            </div>

            <div class="cart">






            

            <!-- Cart PHP backend starts from here.  -->
            <?php 
            
            // If user is logged in
            if(!empty($_SESSION['user_id'])){

              $currentCartID = $_SESSION['currentActiveCart'];

              //This part contains Cart Icon, Cart Name and cart size
              echo "
              
              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>

              <svg style='transform:scale(1.3); fill:#333;' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path d='M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm6.305-15l-3.432 12h-10.428l-3.777-9h-2.168l4.615 11h13.239l3.474-12h1.929l.743-2h-4.195z'/></svg>                  
              
              <div class='items'>
                <span style='margin-right:13px;margin-top:10px;' class='badge badge-notify my-cart-badge'>$_SESSION[currentActiveCartSize]</span>
                <p style='font-weight:600;text-transform:uppercase;font-size:12px;padding-top:5px' >CART</p>
              </div>
              
              </button>
              ";
  
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
                        
                        $totalPrice = 0;
                        while (($productCartRow = oci_fetch_assoc($productCartResult))) {
  
                          $testCurrentProduct = $productCartRow['FK2_PRODUCT_ID'];
                          $testCurrentProductQuantity = $productCartRow['ITEM_QUANTITY'];
  
                          //This nested part is required to fetch details of PRODUCT of a particular cart items.
                          $currentProductQuery="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID	 = $testCurrentProduct";
                          $currentProductResult=  oci_parse($connection, $currentProductQuery); 
                          oci_execute($currentProductResult); 
  
                          while ($currentProductRow = oci_fetch_assoc($currentProductResult)) {
                            $totalPrice = ($currentProductRow['PRODUCT_PRICE'] * $testCurrentProductQuantity) + $totalPrice ;
                            echo "

                            <tr>
                              <th scope='row'> <img src='../images/products/$currentProductRow[PRODUCT_IMAGE]' alt='img'></th>
                              <td>$currentProductRow[PRODUCT_NAME]</td>
                              <td>$currentProductRow[PRODUCT_PRICE]</td>
                              <td>$testCurrentProductQuantity</td>
                              <td><a href='../cart/cart-delete.php?productID=$testCurrentProduct'><i class='fas fa-times'></i></a></td>
                            </tr>";
  
                          }
                        } 

                        //Total price is stored in session variable.
                        $_SESSION['currentTotalPrice'] = $totalPrice;
  
                        
                        echo '
                        </tbody>
                      </table>
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <h6><b>Total Price</b></h6>
                        </div>
                        <div class="col-md-6"> 
                          <h6>'.$totalPrice.'</h6>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="../error-pages/preCheckout.php"> <button type="button" class="btn btn-primary">Checkout</button></a>
                    </div>
                  </div>
                </div>
              </div>';
            }








            //else, user isnt logged in and data is stored in an array and later merged when logged in.
            else{

              //This part contains cart icon and size for guest users.
              echo "
              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>

              <svg style='transform:scale(1.5); fill:#333;' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path d='M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm6.305-15l-3.432 12h-10.428l-3.777-9h-2.168l4.615 11h13.239l3.474-12h1.929l.743-2h-4.195z'/></svg>                  
              
              <p style='font-weight:600;text-transform:uppercase;font-size:12px;padding-top:5px;' >CART</p>

                <div class='items'>
                  <span style='margin-right:14px;margin-top:10px;' class='badge badge-notify my-cart-badge'>"; 

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
                          $guestTotalPrice = 0;
              foreach($_SESSION['guestCurrentCart'] as $cart){
                foreach($cart as $productId => $productQuantity){

                  


                  $testCurrentProduct = $productId;
                  $testCurrentProductQuantity = $productQuantity;

                  //This nested part is required to fetch details of PRODUCT of a particular cart items.
                  $currentProductQuery="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID	 = $testCurrentProduct";
                  $currentProductResult=  oci_parse($connection, $currentProductQuery); 
                  oci_execute($currentProductResult); 

                  while ($currentProductRow = oci_fetch_assoc($currentProductResult)) {
                    $guestTotalPrice = ($currentProductRow['PRODUCT_PRICE'] * $testCurrentProductQuantity) + $guestTotalPrice ;

                    echo "

                    <tr>
                      <th scope='row'> <img src='../images/products/$currentProductRow[PRODUCT_IMAGE]' alt='img'></th>
                      <td>$currentProductRow[PRODUCT_NAME]</td>
                      <td>$currentProductRow[PRODUCT_PRICE]</td>
                      <td>$testCurrentProductQuantity</td>
                      <td><a href='../cart/cart-delete.php?productID=$testCurrentProduct'><i class='fas fa-times'></i></a></td>
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
                        <h6>'.$guestTotalPrice.'</h6>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="../error-pages/preCheckout.php"> <button type="button" class="btn btn-primary">Checkout</button></a>
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
  <script src="../js/popper.min.js"></script>
  <script src="../js/internal.min.js"></script>
  