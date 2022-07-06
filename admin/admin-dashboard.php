<?php include '../reusable/errorReporting.php'?>


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
  <link rel="stylesheet" type="text/css" href="../sass/main.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <link rel="stylesheet" href="../css/adminDashboard.css">

  <title> Freshmart</title>
</head>

<?php 
    include '../reusable/connection.php';

    //Unsetting currentTraderID after admin came back to its homepage.
    // unset($_SESSION['currentTraderId']);  
    // unset($_SESSION['user_name']);  

    if(empty($_SESSION['currentAdminId'])){
      header('Location: ../error-pages/notAnAdminError.php');
    }
?>

<body>

  <section id="logo-serch-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12 col-lg-3">
          <div class="logo">
            <a href="../index.php">
              <img src="../images/logo.png" alt="logo" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="col-md-5 col-sm-12 col-lg-5">
          
        </div>
        <div class="col-md-1">
          
        </div>
        <div class="col-md-3 col-sm-12 col-lg-2 text-end">
          <div class="user-cart-cover2">
            <div class="user-dbord">

                <div class="dropdown" style='text-align:center;position:relative; top:8px;'>
                  <a target='_blank' href='http://localhost:8080/apex/f?p=103:LOGIN_DESKTOP:16455796213004:::::'><svg xmlns="http://www.w3.org/2000/svg" style="transform:scale(1.3); fill:#8a8a8a;" width="24" height="24" viewBox="0 0 24 24"><path d="M23.949 13c-.509 6.158-5.66 11-11.949 11-6.627 0-12-5.373-12-12 0-6.29 4.842-11.44 11-11.95v12.95h12.949zm-10.949-2h10.949c-.481-5.828-5.122-10.467-10.949-10.95v10.95z"/></svg>                  <!-- To fetch User Name on navbar -->
                      <p style='font-weight:600;text-transform:uppercase;font-size:12px;color:#333;padding-top:9px;color:#333'>report</p>
                  </a>
                </div>
              
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-togglee" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="far fa-user"></i>
                  <!-- To fetch User Name on navbar -->
                              <?php 
                                 if( !empty($_SESSION['currentAdminId'])){
                                   $arr = explode(' ',trim($_SESSION['user_name']));
                                   echo"<p style='font-weight:600;text-transform:uppercase;font-size:12px;color:#333' >".$arr[0].'</p>';
                                   }
                                 ?>
                          
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="../login_user/logout.php">Log out</a>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section id="dashboard-wrapper">
    <div class="container">
      <div class="dashboard-cover">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dashboard</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Traders</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="feedback-tab" data-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Comments</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="dh-details">
             <div class="row">
               <div class="col-md-2">
                
               </div>
             </div>
             <div class="card">
              <div class="card-header">
              Products Pending for Approval.
              </div>
              <div class="card-body" style='display:flex;gap: 15px; flex-wrap:wrap;'>

                <?php 
                  // Counting Products
                  $productCountQuery="SELECT COUNT(PK_PRODUCT_ID) FROM PRODUCT WHERE PRODUCT_ACTIVE = 'N' ";
                  $productCountResult=  oci_parse($connection,$productCountQuery); 
                  oci_execute($productCountResult); 
                  while ($productCountRow = oci_fetch_assoc($productCountResult)) {
                    $productsFound = $productCountRow['COUNT(PK_PRODUCT_ID)'];
                  }

                  if($productsFound >= 1){
                    //Look for product that has product_active as 'N';
                    $productQuery="SELECT * FROM PRODUCT WHERE PRODUCT_ACTIVE = 'N' ";
                    $productResult=  oci_parse($connection,$productQuery); 
                    oci_execute($productResult); 
                
                    while ($productRow = oci_fetch_assoc($productResult)) {
                      
                      echo "
                      <div class='individual-card'>
                      <div class='card-top'><img class='card-top-img' src='../images/products/$productRow[PRODUCT_IMAGE]'></div>
                        <div class='card-bottom'>
                            <p><strong>Name :</strong> $productRow[PRODUCT_NAME]</p>
                            <p><strong>Type :</strong> $productRow[PRODUCT_TYPE]</p>
                            <p><strong>Price :</strong> $productRow[PRODUCT_PRICE]</p>
                            <a href='adminApproval.php?productApproveID=$productRow[PK_PRODUCT_ID]'><button>Approve</button></a>
                            <a href='adminApproval.php?productDisableID=$productRow[PK_PRODUCT_ID]'><button style='background-color:#e03a3a;'>Disable</button></a>
                        </div>
                    </div>  ";
                    }
                  }
                  
                  else{    echo "<p> No products pending for approval";  }

                
                ?>

               

              </div>

              <div class="card-header">
                Shops Pending for Approval.
                </div>
                <div class="card-body" style='display:flex;gap: 15px; flex-wrap:wrap;'>

                  <?php 
                    // Counting Shops
                    $shopCountQuery="SELECT COUNT(PK_SHOP_ID) FROM SHOP WHERE SHOP_ACTIVE = 'N' ";
                    $shopCountResult=  oci_parse($connection,$shopCountQuery); 
                    oci_execute($shopCountResult); 
                    
                    while ($shopCountRow = oci_fetch_assoc($shopCountResult)) {
                      $shopsFound = $shopCountRow['COUNT(PK_SHOP_ID)'];
                    }

                    if($shopsFound >= 1){
                      $shopQuery="SELECT * FROM SHOP WHERE SHOP_ACTIVE = 'N'";
                      $shopResult=  oci_parse($connection,$shopQuery); 
                      oci_execute($shopResult); 
                  
                      while ($shopRow = oci_fetch_assoc($shopResult)) {
                        
                        echo "
                        <div class='individual-card'>
                        <div class='card-top'><img class='card-top-img' src='../images/shop.png'></div>
                          <div class='card-bottom'>
                              <p><strong>Name :</strong> $shopRow[SHOP_NAME]</p>
                              <p><strong>Type :</strong> $shopRow[SHOP_TYPE]</p>
                              <p><strong>Address :</strong> $shopRow[SHOP_ADDR]</p>
                              <a href='adminApproval.php?shopID=$shopRow[PK_SHOP_ID]'><button>Approve</button></a>
                              <a href='adminApproval.php?shopDisableID=$shopRow[PK_SHOP_ID]'><button style='background-color:#ed3939'>Disable</button></a>
                          </div>
                      </div>  ";
                      }
                    }

                    else{
                      echo "<p>  No shops pending for approval </p> ";
                    }

                    

                    
                  
                  ?>

              </div>

              <div class="card-header">
                Traders Pending for Approval.
                </div>
                <div class="card-body" style='display:flex;gap: 15px; flex-wrap:wrap;'>

                  <?php 

                    // Counting Traders
                    $traderCountQuery="SELECT COUNT(PK_USER_ID) FROM SITE_USER WHERE USER_STATUS = 'N' AND USER_TYPE = 'trader'";
                    $traderCountResult=  oci_parse($connection,$traderCountQuery); 
                    oci_execute($traderCountResult); 
                    
                    while ($traderCountRow = oci_fetch_assoc($traderCountResult)) {
                      $tradersFound = $traderCountRow['COUNT(PK_USER_ID)'];
                    }

                    if($tradersFound >= 1){
                      $traderQuery="SELECT * FROM SITE_USER WHERE USER_STATUS = 'N' AND USER_TYPE = 'trader'";
                      $traderResult=  oci_parse($connection,$traderQuery); 
                      oci_execute($traderResult); 
                  
                      while ($traderRow = oci_fetch_assoc($traderResult)) {
                        
                        echo "
                        <div class='individual-card'>
                        <div class='card-top'><img class='card-top-img' src='../images/profile/$traderRow[USER_PROFILE_IMG]'></div>
                          <div class='card-bottom'>
                              <p><strong>Name :</strong> $traderRow[USER_NAME]</p>
                              <p><strong>Type :</strong> $traderRow[TRADER_TYPE]</p>
                              <p><strong>Address :</strong> $traderRow[USER_ADDRESS]</p>
                              <a href='adminApproval.php?traderApproveID=$traderRow[PK_USER_ID]'><button>Approve</button></a>
                          </div>
                      </div>  ";
  
                      }
                    }
                    else{
                      echo "<p> No traders pending for approval. </p>";
                    }

                   
                  
                  ?>

              </div>


            </div>
            </div>
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="dh-details">
              <div class="row">
                <div class="col-md-2">
                 
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-4">
                  
                 </div>
              </div>
              <div class="card">
               <div class="card-header">
               Traders List
               </div>
               <div class="card-body" style='display:flex;gap: 15px; flex-wrap:wrap;'>

                <?php 

                  $traderQuery="SELECT * FROM SITE_USER WHERE USER_TYPE = 'trader' OR USER_TYPE = 'TRADER'";
                  $traderResult=  oci_parse($connection,$traderQuery); 
                  oci_execute($traderResult); 
              
                  while ($traderRow = oci_fetch_assoc($traderResult)) {

                    $traderUserId = $traderRow['PK_USER_ID'];
                    
                    //Counting shops of that trader
                    $shopCountQuery="SELECT COUNT(PK_SHOP_ID) FROM SHOP WHERE FK4_USER_ID = $traderUserId";
                    $shopCountResult=  oci_parse($connection,$shopCountQuery); 
                    oci_execute($shopCountResult); 
                    while ($shopCountRow = oci_fetch_assoc($shopCountResult)) {
                      $shopCount = $shopCountRow['COUNT(PK_SHOP_ID)'];
                    }

                    //Counting total Products of that trader
                    $productCountQuery="SELECT COUNT(P.PK_PRODUCT_ID) FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE S.FK4_USER_ID =  $traderUserId";
                    $productCountResult=  oci_parse($connection,$productCountQuery); 
                    oci_execute($productCountResult); 
                    while ($productCountRow = oci_fetch_assoc($productCountResult)) {
                      $productCount = $productCountRow['COUNT(P.PK_PRODUCT_ID)'];
                    }


                    echo "
                    <div class='individual-card'>
                    <div class='card-top'><img class='card-top-img' src='../images/profile/$traderRow[USER_PROFILE_IMG]'></div>
                      <div class='card-bottom'>
                          <p><strong>Name :</strong> $traderRow[USER_NAME]</p>
                          <p><strong>Type :</strong> $traderRow[TRADER_TYPE]</p>
                          <p><strong>Email :</strong> $traderRow[USER_EMAIL]</p>
                          <p><strong>Shop Count :</strong> $shopCount</p>
                          <p><strong>Product Count :</strong> $productCount</p>
                          <p><strong>Address :</strong> $traderRow[USER_ADDRESS]</p>
                          <a href='adminApproval.php?traderID=$traderRow[PK_USER_ID]'><button>SESSION</button></a>
                      </div>
                  </div>  ";

                  }
                
                ?>

               

              </div>
             </div>
             </div>
             
          </div>

          <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
            <div class="card-header">
              Feedback on Products
            </div>

            <div class="card-body" style='display:flex; flex-direction:row;gap: 15px; flex-wrap:wrap;'>

                  <?php
                  $feedbackQuery="SELECT F.PRODUCT_COMMENT, F.PK_FEEDBACK_ID, P.PRODUCT_NAME, P.PK_PRODUCT_ID FROM FEEDBACK F INNER JOIN PRODUCT P ON P.PK_PRODUCT_ID = F.FK1_PRODUCT_ID"; 
                  $feedbackResult=  oci_parse($connection,$feedbackQuery); 
                  oci_execute($feedbackResult); 

                  while ($feedbackRow = oci_fetch_assoc($feedbackResult)) {
                    echo "
                    <div class='individual-card'>
                      <div class='top' style='border-bottom:1px solid #dedede; padding:5px 0px; margin-bottom:5px;'>
                       <a href='../customer/individualProduct.php?productID=$feedbackRow[PK_PRODUCT_ID]'>$feedbackRow[PRODUCT_NAME]</a>
                      </div>
                      
                      <div class='feedback-text'>
                        $feedbackRow[PRODUCT_COMMENT]                  
                      </div>

                      <div class='feedback-option' style='margin-top:10px; padding:5px 0px;'>
                        <a href='adminApproval.php?feedbackDelete=$feedbackRow[PK_FEEDBACK_ID]' style='border:#e02222 1px solid; color:#e02222; padding:5px; border-radius:5px; text-decoration:none'><i class='fa fa-times fa-sm' style='color:#e02222;' aria-hidden='true'></i> <strong>DELETE</strong></a>
                      </div>
                    </div>
                    ";
                  }
                  

                  

                  ?>

            </div>
            
          </div>


        </div>
      </div>
    </div>
  </section>

  <section id="footer-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="cover-f">
            <h4>ABOUT US</h4>
            <li><a href="#">Who are we?</a></li>
            <li><a href="#">Why us?</a></li>
            <li><a href="#">Be a member</a></li>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cover-f">
            <h4>CONTACT US</h4>
            <li><i class="fas fa-phone"></i> <a href="tel:+9779849563456">(+977)9812345678</a></li>
            <li><i class="fa fa-map-marker"></i> <a href="#">Thapathali, Kathmandu</a></li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:info@freshmart.com">info@freshmart.com</a></li>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cover-f">
            <h4>SUPPORT US</h4>
            <span style='margin-right:10px;'><a href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" style="transform:scale(1.5); fill:white;" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            <a></span>

            <span><a href="#">
            <svg width="24" style="transform:scale(1.5); fill:white;" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22.288 21h-20.576c-.945 0-1.712-.767-1.712-1.712v-13.576c0-.945.767-1.712 1.712-1.712h20.576c.945 0 1.712.767 1.712 1.712v13.576c0 .945-.767 1.712-1.712 1.712zm-10.288-6.086l-9.342-6.483-.02 11.569h18.684v-11.569l-9.322 6.483zm8.869-9.914h-17.789l8.92 6.229s6.252-4.406 8.869-6.229z"/></svg>
            </a></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- js file -->
  <script src="../js/owl.carousel.min.js"></script>
  <!-- <script src="../js/main.js"></script>  -->  <!-- commenting this file because it makes that weird scroll top issue -->
  <script src="../js/popper.min.js"></script>
  <script src="../js/internal.min.js"></script>

</body>

</html>