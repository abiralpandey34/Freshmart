<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap -->
      <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
      <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
      <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="../sass/main.css">
      <link rel="stylesheet" type="text/css" href="../css/traderDashboard.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <!-- js -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <title> Freshmart</title>

      
   </head>
   <body>
      <?php 
         include '../reusable/connection.php';
         include '../reusable/errorReporting.php';
         
         if(empty($_SESSION['currentTraderId'])){
           echo 'You are not a trader.';
           header('Location: ../error-pages/notATraderError.php');
         }
         
         else{
           $currentTraderId = $_SESSION['currentTraderId'];
           include 'ordersInit.php';
         }
         ?>

      <section id="logo-serch-cart" style='padding:5px 0px 0px 0px; margin:5px 0px'>
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-sm-12 col-lg-3">
                  <div class="logo">
                     <a href="../index.php">
                     <img src="../images/logo.png" alt="logo" class="img-fluid">
                     </a>
                  </div>
               </div>

               <div class="col-md-4 col-sm-12 col-lg-5">
                  
               </div>

               <div class="col-md-1">
                  
               </div>

               <div class="col-md-4 col-sm-12 col-lg-2">
                  <div class="user-cart-cover">
                     <div class="user-dbord">

                        <div class="dropdown" style='text-align:center;position:relative; top:8px;'>

                              <a target='_blank' href='http://localhost:8080/apex/f?p=103:LOGIN_DESKTOP:12309176158657:::::'><svg xmlns="http://www.w3.org/2000/svg" style="transform:scale(1.3); fill:#8a8a8a;" width="24" height="24" viewBox="0 0 24 24"><path d="M23.949 13c-.509 6.158-5.66 11-11.949 11-6.627 0-12-5.373-12-12 0-6.29 4.842-11.44 11-11.95v12.95h12.949zm-10.949-2h10.949c-.481-5.828-5.122-10.467-10.949-10.95v10.95z"/></svg>                  <!-- To fetch User Name on navbar -->
   

                                 <p style='font-weight:600;text-transform:uppercase;font-size:12px;color:#333;padding-top:9px;color:#333'>report</p>
                              </a>
                        </div>

                        <div class="dropdown">
                           <a class="btn btn-secondary dropdown-togglee" href="#" role="button" id="dropdownMenuLink"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="far fa-user"></i>
                              <!-- To fetch User Name on navbar -->
                              <?php 
                                 if( !empty($_SESSION['currentTraderId'])){
                                   $arr = explode(' ',trim($_SESSION['user_name']));
                                   echo"<p style='font-weight:600;text-transform:uppercase;font-size:12px;' >".$arr[0].'</p>';
                                   }
                                 ?>
                           </a>

                           <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <?php
                                 //Navbar options for logged in and not logged in users.
                                 if( !empty($_SESSION['currentTraderId'])){
                                    if(empty($_SESSION['currentAdminId'])){
                                       echo'<a class="dropdown-item" href="updateProfileTrader.php">Profile</a>';
                                       echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                                    }
                                    else{
                                       echo'<a class="dropdown-item" href="../login_user/logout.php">Logout</a>';
                                    }
                                  
                                 }
                                 
                                 
                                 else{
                                   echo '<a class="dropdown-item" href="../login_user/login_form.php">Login</a>
                                         <a class="dropdown-item" href="../register_user/register_form_customer.php">Sign up</a>';
                                 }
                                 
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section id="products-details">
         <div class="container">
         <div class="row">
         <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
               <!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                  aria-controls="v-pills-home" aria-selected="true">Dashboard</a> -->
               <a class="nav-link active" id="v-pills-profile-tab"  data-toggle="pill" href="#v-pills-profile" role="tab"
                  aria-controls="v-pills-profile" aria-selected="true">Orders</a>
               <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                  aria-controls="v-pills-messages" aria-selected="false">Products</a>
               <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                  aria-controls="v-pills-settings" aria-selected="false">Shop</a>
               <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settingv" role="tab"
                  aria-controls="v-pills-settingv" aria-selected="false">Reviews</a>
               <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settingss" role="tab"
                  aria-controls="v-pills-settings" aria-selected="false">Trader Information</a>
            </div>
         </div>
         <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
               
               <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <div class="p-details">
                     <div class="card">
                        <div class="card-header">
                           Pending Order
                        </div>
                        <div class="card-body">
                           <?php
                              //Section-1.1 :  Pending Orders 
                                
                              // Looking for logged in trader's orders that hasnt been placed.
                              $currentTraderUnplacedOrdersQuery ="SELECT OD.FK1_ORDER_ID, OD.FK3_PRODUCT_ID, P.PRODUCT_NAME, P.PRODUCT_IMAGE, OD.PRODUCT_QUANTITY, CO.FK_PICKUP_ID
                                                                  FROM CUST_ORDER CO
                                                                  INNER JOIN ORDER_DETAILS OD ON CO.PK_ORDER_ID = OD.FK1_ORDER_ID
                                                                  INNER JOIN PRODUCT P ON P.PK_PRODUCT_ID = OD.FK3_PRODUCT_ID 
                                                                  INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID
                                                                  INNER JOIN SITE_USER U ON U.PK_USER_ID = S.FK4_USER_ID
                                                                  WHERE U.PK_USER_ID = $currentTraderId AND IS_PLACED='N'";
                              
                              $currentTraderUnplacedOrdersQueryResult = oci_parse($connection, $currentTraderUnplacedOrdersQuery);
                              oci_execute($currentTraderUnplacedOrdersQueryResult); 
                              
                              while($currentTraderUnplacedOrdersQueryRow = oci_fetch_assoc($currentTraderUnplacedOrdersQueryResult)){
                              
                                  $currentOrderID = $currentTraderUnplacedOrdersQueryRow['FK1_ORDER_ID'];
                                  $currentPickupID = $currentTraderUnplacedOrdersQueryRow['FK_PICKUP_ID'];
                              
                                  // Fetching name of customer who placed an order and storing in a  variable
                                  $currentOrderUsernameQuery = "SELECT U.USER_NAME FROM SITE_USER U 
                                                              INNER JOIN CART C ON U.PK_USER_ID = C.FK1_USER_ID
                                                              INNER JOIN CUST_ORDER CO ON CO.FK_CART_NO = C.PK_CART_NO
                                                              WHERE CO.PK_ORDER_ID = $currentOrderID";
                                  $currentOrderUsernameQueryResult = oci_parse($connection, $currentOrderUsernameQuery);
                                  oci_execute($currentOrderUsernameQueryResult); 
                                  while($currentOrderUsernameQueryRow = oci_fetch_assoc($currentOrderUsernameQueryResult)){  
                                    $currentUser = $currentOrderUsernameQueryRow['USER_NAME'];
                                  }
                              
                                  // Fetching Collection slot and collection time of a placed order and storing in a variable.
                                  $currentPickupIdQuery = "SELECT CS.TIMESLOT, CS.PICKUP_DAY FROM COLLECTION_SLOT CS WHERE PK_PICKUP_ID = $currentPickupID";
                                  $currentPickupIdQueryResult = oci_parse($connection, $currentPickupIdQuery);
                                  oci_execute($currentPickupIdQueryResult); 
                                  while($currentPickupIdQueryRow = oci_fetch_assoc($currentPickupIdQueryResult)){  
                                    $currentTimeslot = $currentPickupIdQueryRow['TIMESLOT'];
                                    $currentPickupDay = $currentPickupIdQueryRow['PICKUP_DAY'];
                                  }
                              
                                      echo "
                                      <div class='individual-card'>
                                        <div class='card-top'>
                                          <img class='card-top-img' src='../images/products/$currentTraderUnplacedOrdersQueryRow[PRODUCT_IMAGE]'>
                                        </div>
                              
                                        <div class='card-bottom'>
                                            <p><strong>Order ID :</strong> $currentTraderUnplacedOrdersQueryRow[FK1_ORDER_ID]</p>
                                            <p><strong>Customer :</strong> $currentUser</p>
                                            <p><strong>Name :</strong> $currentTraderUnplacedOrdersQueryRow[PRODUCT_NAME]</p>
                                            <p><strong>Quantity :</strong> $currentTraderUnplacedOrdersQueryRow[PRODUCT_QUANTITY]</p>
                                            <p><strong>Time :</strong> $currentTimeslot</p>
                                            <p><strong>Day :</strong> $currentPickupDay</p>
                                            <a href='placeOrder.php?orderId=$currentOrderID&productId=$currentTraderUnplacedOrdersQueryRow[FK3_PRODUCT_ID]'><button>Place Order</button></a>
                                        </div>
                                      </div>  ";
                              }
                              
                              
                              ?>
                        </div>
                     </div>
                     <div class="views">
                        <br>
                     </div>
                     <div class="sort-list">
                        <div class="row">
                           <div class="col-md-2">
                           </div>
                           <div class="col-md-10">
                           </div>
                        </div>
                     </div>
                     <div class="card" style="margin-top: 0;">
                        <div class="card-header">
                           Order history
                        </div>
                        <div class="card-body">
                           <?php
                              //Section-1.2 :  Order history
                              
                              echo "
                              
                              <table  style='width:100%' cellpadding='10'>
                              <thead>
                                  <tr>
                                      <th>Customer</th>
                                      <th>Order ID</th>
                                      <th>Product ID</th>
                                      <th>Quantity</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              
                              <tbody>
                                  <tr>";
                              
                              $currentTraderUnplacedOrdersQuery = "SELECT OD.FK1_ORDER_ID, P.PRODUCT_NAME, OD.PRODUCT_QUANTITY 
                                                                  FROM ORDER_DETAILS OD 
                                                                  INNER JOIN PRODUCT P ON P.PK_PRODUCT_ID = OD.FK3_PRODUCT_ID 
                                                                  INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID
                                                                  INNER JOIN SITE_USER U ON U.PK_USER_ID = S.FK4_USER_ID
                                                                  WHERE U.PK_USER_ID = $currentTraderId AND IS_PLACED='Y'";
                              
                              $currentTraderUnplacedOrdersQueryResult = oci_parse($connection, $currentTraderUnplacedOrdersQuery);
                              oci_execute($currentTraderUnplacedOrdersQueryResult); 
                              
                              while($currentTraderUnplacedOrdersQueryRow = oci_fetch_assoc($currentTraderUnplacedOrdersQueryResult)){
                              
                                  $currentOrderID = $currentTraderUnplacedOrdersQueryRow['FK1_ORDER_ID'];
                              
                                  $currentOrderUsernameQuery = "SELECT U.USER_NAME FROM SITE_USER U 
                                                              INNER JOIN CART C ON U.PK_USER_ID = C.FK1_USER_ID
                                                              INNER JOIN CUST_ORDER CO ON CO.FK_CART_NO = C.PK_CART_NO
                                                              WHERE CO.PK_ORDER_ID = $currentOrderID";
                              
                                  $currentOrderUsernameQueryResult = oci_parse($connection, $currentOrderUsernameQuery);
                                  oci_execute($currentOrderUsernameQueryResult); 
                              
                                  while($currentOrderUsernameQueryRow = oci_fetch_assoc($currentOrderUsernameQueryResult)){
                                      
                                      echo " <td>$currentOrderUsernameQueryRow[USER_NAME]</td> ";
                                          
                                  }
                              
                                  echo "  <td>$currentTraderUnplacedOrdersQueryRow[FK1_ORDER_ID]</td>
                                          <td>$currentTraderUnplacedOrdersQueryRow[PRODUCT_NAME]</td>
                                          <td>$currentTraderUnplacedOrdersQueryRow[PRODUCT_QUANTITY]</td>
                                          <td>Placed</td>
                              
                                      </tr>";   
                              }
                              
                              echo "</tbody>
                              </table>";
                              
                              
                              ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                  <div class="p-list">
                     <div class="card">
                        <div class="card-header" style="text-align: left;">
                           <div class="row">
                              <div class="col-md-6">
                                 <h6>Products List</h6>
                              </div>
                           </div>
                        </div>
                        <!-- Product -->
                        <div class="card-body">
                           
                              <?php
                                 //Section-2 :  Products
                                 
                                 $productByTraderQuery = "SELECT * FROM PRODUCT P 
                                                          INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID 
                                                          INNER JOIN SITE_USER U  ON U.PK_USER_ID = S.FK4_USER_ID 
                                                          WHERE U.PK_USER_ID = $currentTraderId AND P.PRODUCT_DELETE='N' AND PRODUCT_ACTIVE='Y'";
                                 
                                 $productByTraderResult=  oci_parse($connection,$productByTraderQuery); 
                                 oci_execute($productByTraderResult); 
                                 
                                 while (($productByTraderRow = oci_fetch_assoc($productByTraderResult))) {
                                    $_SESSION['shop_id']=$productByTraderRow['FK1_SHOP_ID'];
                                    echo "
                                    <div class='individual-card'>
                                      <div class='card-top'>
                                        <img class='card-top-img' src='../images/products/$productByTraderRow[PRODUCT_IMAGE]'>
                                      </div>
                            
                                      <div class='card-bottom'>
                                          <p><strong>Name :</strong> $productByTraderRow[PRODUCT_NAME]</p>
                                          <p><strong>Price :</strong> $productByTraderRow[PRODUCT_PRICE]</p>
                                          <p><strong>Stock :</strong> $productByTraderRow[PRODUCT_QUANTITY]</p>
                                          <a href='editProduct.php?productID=$productByTraderRow[PK_PRODUCT_ID]'><button>Edit</button></a>
                                          <a href='deleteProduct.php?productID=$productByTraderRow[PK_PRODUCT_ID]'><button style='background-color:#fa2020'>Delete</button></a>
                                      </div>
                                    </div>  ";

                                 }
                                 
                                 ?>
                        </div>
                     </div>
                     <div class="card">
                     <div class="card-header" style="text-align: left;">
                        <div class="row">
                           <div class="col-md-6">
                           <h6>Products Pending for approval</h6>
                           </div>
                        </div>
                     </div>
                     
                     <!-- Product -->
                     <div class="card-body">

                           <?php
                        //Section-2 :  Products
                        
                        $productByTraderQuery = "SELECT * FROM PRODUCT P 
                                                INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID 
                                                INNER JOIN SITE_USER U  ON U.PK_USER_ID = S.FK4_USER_ID 
                                                WHERE U.PK_USER_ID = $currentTraderId AND P.PRODUCT_ACTIVE='N' AND P.PRODUCT_DELETE='N'";
                        
                        $productByTraderResult=  oci_parse($connection,$productByTraderQuery); 
                        oci_execute($productByTraderResult); 
                        
                        while (($productByTraderRow = oci_fetch_assoc($productByTraderResult))) {
                          echo "
                           <div class='individual-card'>
                              <div class='card-top'>
                                 <img class='card-top-img' src='../images/products/$productByTraderRow[PRODUCT_IMAGE]'>
                              </div>
                     
                              <div class='card-bottom'>
                                 <p><strong>Name :</strong> $productByTraderRow[PRODUCT_NAME]</p>
                                 <p><strong>Price :</strong> $productByTraderRow[PRODUCT_PRICE]</p>
                                 <p><strong>Stock :</strong> $productByTraderRow[PRODUCT_QUANTITY]</p>
                                 <a href='editProduct.php?productID=$productByTraderRow[PK_PRODUCT_ID]'><button>Edit</button></a>
                                 <a href='deleteProduct.php?productID=$productByTraderRow[PK_PRODUCT_ID]'><button style='background-color:#fa2020'>Delete</button></a>
                              </div>
                           </div>  ";
                        }

                        
                        ?>
                     </div>
                     </div>
                  </div>
               </div>

               
               <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <div class="p-list">
        
        <div class="views">
        </div>
        <div class="shop">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                              <?php 
                              //Section-3 :  Shops
                              
                                 $traderShopQuery = "SELECT * FROM SHOP WHERE FK4_USER_ID = $currentTraderId";
                                 $traderShopResult=  oci_parse($connection,$traderShopQuery); 
                                 oci_execute($traderShopResult); 
                                 
                                 while ($traderShopRow = oci_fetch_assoc($traderShopResult)) {
                                    $_SESSION['shop_id']=$traderShopRow['PK_SHOP_ID'];

                                    $shopID=$traderShopRow['PK_SHOP_ID'];

                                    $shopActive=$traderShopRow['SHOP_ACTIVE'];

                                       echo '
                                    <div class="col-md-8">';

                                    if($shopActive == 'Y'){
                                       echo "
                                       <h5><span>Shop name:</span>  $traderShopRow[SHOP_NAME] </h5>
                                       <h5><span>Shop Address</span> $traderShopRow[SHOP_ADDR]</h5>
                                       <h5><span>Shop Type:</span> $traderShopRow[SHOP_TYPE]</h5>


                                       <!-- start popup -->
                                       <a href='addProduct.php?shopID=$shopID' class='btn btn-primary' style='background-color:rgb(129, 192, 34); border:none;'> Add Products </a>"; 
                                       }

                                    else{
                                       echo "<br>Your shop '$traderShopRow[SHOP_NAME]' is currently pending for approval.<hr>";
                                    }
                                 
                                    
                           
                                    echo '
                                                            
                                    

                                    </div>';
                              }
                        ?>

                    </div>
                </div>

            </div>
            <br>
            <a href='addShop.php'><button style='background-color:rgb(129, 192, 34); border:none; padding:5px; color:white'> Add a new Shop </button></a>

        </div>

    </div>
</div>

               <div class="tab-pane fade" id="v-pills-settingv" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="p-list">
                  <div class="card">
                      <?php
                          //Section-4 :  Reviews
                          
                          $feedbackInfoQuery = "SELECT f.product_comment,f.FK1_PRODUCT_ID, f.product_rating, p.PRODUCT_NAME FROM feedback f 
                                                INNER JOIN product p ON p.PK_PRODUCT_ID = f.FK1_PRODUCT_ID 
                                                INNER JOIN SHOP S ON S.PK_SHOP_ID = p.FK1_SHOP_ID
                                                WHERE S.FK4_USER_ID = $currentTraderId";
                            
                          $feedbackInfoResult=  oci_parse($connection,$feedbackInfoQuery); 
                          oci_execute($feedbackInfoResult); 
                          
                          while($feedbackInfoRow = oci_fetch_assoc($feedbackInfoResult)){
                            $rating = $feedbackInfoRow['PRODUCT_RATING'];
                            $i = 1; 
                          
                          
                            echo "
                              <div class='card-body' style='background-color:#f0f0f0; margin:10px;'>
                              <span>";
                          
                                  while($i <= 5){
                                    if( $i<=$rating){
                                        echo "<span class='fa fa-star checked' style='color:orange;'></span>";
                                        $i = $i +1;
                                    }
                          
                                    else{                                
                                      echo "<span class='fa fa-star unchecked' style='color: rgb(215, 215, 215) ;'></span>";
                                        $i = $i +1;
                                    }
                                }
                          
                                echo "</span> <br> <span> Comment   : $feedbackInfoRow[PRODUCT_COMMENT]<br> </span>
                                <span> Product: <a href='individualProduct.php?productID=$feedbackInfoRow[FK1_PRODUCT_ID]'> $feedbackInfoRow[PRODUCT_NAME] </a></span>
                              </div>
                              ";
                          }
                          ?>
                    </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="v-pills-settingss" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="p-list">
                    <div class="card">
                      <div class="card-body">
                          <div class="row">
                            <div class="col-md-8">
                                <?php 
                                  //Section-5 :  Trader Informations
                                  
                                  $traderInfoQuery = "SELECT DISTINCT PK_USER_ID, TRADER_TYPE, USER_NAME, USER_EMAIL, USER_PH, USER_ADDRESS, USER_PROFILE_IMG FROM SITE_USER WHERE PK_USER_ID = $currentTraderId ";
                                  $traderInfoQueryResult = oci_parse($connection, $traderInfoQuery);
                                  oci_execute($traderInfoQueryResult); 
                                  
                                  while($traderInfoQueryRow = oci_fetch_assoc($traderInfoQueryResult)){
                                  
                                    echo "
                                    <h5><span>Name:</span> $traderInfoQueryRow[USER_NAME]</h5>
                                    <h5><span>Contact:</span> $traderInfoQueryRow[USER_PH]</h5>
                                    <h5><span>Address:</span> $traderInfoQueryRow[USER_ADDRESS]</h5>
                                    <h5><span>Email:</span> $traderInfoQueryRow[USER_EMAIL]</h5>
                                    <h5><span>Trader Type:</span> $traderInfoQueryRow[TRADER_TYPE]</h5>
                                    <h5><span>Shops:</span> ";
                                  
                                    $ShopNamesquery = "SELECT s.shop_name FROM shop s WHERE s.FK4_USER_ID=$currentTraderId";
                                    $ShopNamesqueryResult = oci_parse($connection, $ShopNamesquery);
                                    oci_execute($ShopNamesqueryResult); 
                                    
                                    while($ShopNamesqueryRow = oci_fetch_assoc($ShopNamesqueryResult)){
                                      echo "$ShopNamesqueryRow[SHOP_NAME], ";
                                      }
                                      echo "</h5>
                                  
                                      <a href='updateProfileTrader.php'>Edit Your Information</a><br><br>
                                      <a href='contactAdmin.php' class='btn btn-primary' style='background-color:rgb(129, 192, 34); border:none;'> Contact Admin </a>
                                      ";

                                      
                                  
                                  
                                  
                                  echo "
                                  </div>
                                  
                                  <div class='col-md-4'>
                                  <div class='shop-img'>
                                  <img src='../images/profile/$traderInfoQueryRow[USER_PROFILE_IMG]' style='height:250px; width:auto; object-fit:cover;' alt='img' class='img-fluid'>
                                  </div>
                                  </div>";
                                  }
                                  ?>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
              </div>
            </div>
         </div>
      </section>
      <section id="footer-wrapper">
      <div class="container">
      <div class="row">
      <div class="col-md-3">
      <div class="cover-f">
      <h4>MY ACCOUNT</h4>
      <li><a href="#">Edit my Information</a></li>
      <li><a href="#">My Cart</a></li>
      <li><a href="#">Order History</a></li>
      </div>
      </div>
      <div class="col-md-3">
      <div class="cover-f">
      <h4>ABOUT US</h4>
      <li><a href="#">Who are we?</a></li>
      <li><a href="#">Why us?</a></li>
      <li><a href="#">Be a member</a></li>
      </div>
      </div>
      <div class="col-md-3">
      <div class="cover-f">
      <h4>CONTACT US</h4>
      <li><i class="fa fa-phone"></i> <a href="tel:+9779849563456">(+977)9812345678</a></li>
      <li><i class="fa fa-map-marker"></i> <a href="#">Thapathali, Kathmandu</a></li>
      <li><i class="fa fa-envelope"></i> <a href="mailto:info@freshmart.com">info@freshmart.com</a></li>
      </div>
      </div>
      <div class="col-md-3">
      <div class="cover-f">
      <h4>SUPPORT US</h4>
      <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
      <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
      <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!-- js file -->
      <script src="../js/owl.carousel.min.js"></script>
      <script src="../js/main.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/internal.min.js"></script>
   </body>
</html>