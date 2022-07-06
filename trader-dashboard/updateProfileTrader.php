
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
      <link rel="stylesheet" type="text/css" href="../sass/main.css">
      <link rel="stylesheet" type="text/css" href="../css/update.css">
      
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"  integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
      
      <link  href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"    rel="stylesheet">
      <!-- js -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="css/update.css">
      <title> Freshmart</title>
      <style>
         .image-container{
            height:350px;
            width:350px;
            border-radius:50%;
            overflow:hidden;

         }

         .image-container img{
            height:100%;
            width:100%;
            object-fit:cover;
         }

         .cancel{
            display:inline-block;
            text-align:center;
            width:49%;
            padding:10px;
            border-radius:50px;
            border:none;
            background-color:#cc2121;
            font-weight:600;
            color:white;
         }

         input[type=file]{
            border: 1px solid #dedede;
            padding:10px;
            display:inline;
         }

         .upload-container{
            text-align:center;
            margin-top:10px;
         }
      </style>
   </head>
   <body>
      <header> 
         <?php 
         
            include '../reusable/new_customer_header.php'; 
            include '../reusable/errorReporting.php';
            $user_id= $_SESSION['currentTraderId'];
         ?>
         
      </header>
      <main>
         <div class="container">
         <!-- create new row -->
         <div class="row">
            <!-- first column starts -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
               <br>
               <!-- navigation tab starts -->
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                        aria-selected="true">Profile</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="shop-tab" data-toggle="tab" href="#shop" role="tab" aria-controls="shop"
                        aria-selected="false">Shops</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security"
                        aria-selected="false">Security</a>
                  </li>
               </ul>
               <?php include "updateProfileTraderSuccess.php" ; ?>
               <div class="tab-content">
                  <!-- general form details -->
                  <div role="tabpanel" class="tab-pane fade active show" id="profile">
                     <div class="row justify-content-center">
                        <div class="col-md-8  d-flex flex-column bd-highlight pt-5">
                           <?php 
                              // This statement clears all cache so page doesnt resubmit form in case of reloading the page. 
                              // header("Cache-Control: no cache");             
                              
                              $profileQuery = "SELECT * FROM SITE_USER WHERE pk_user_id = $user_id and user_type='trader'";
                              $profileQueryResult=  oci_parse($connection,$profileQuery); 
                              if (!$profileQueryResult) 
                              {
                                  $error = oci_error($connection);    
                                  trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
                              }
                              $run = oci_execute($profileQueryResult); 
                              if(!$run) 
                              {    
                                  $error = oci_error($profileQueryResult);
                                  trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
                              }
                              while($profileRow = oci_fetch_assoc($profileQueryResult)){
                              
                                $full_name = filter_var($profileRow['USER_NAME'],FILTER_SANITIZE_SPECIAL_CHARS);
                                $user_contact = filter_var($profileRow['USER_PH'],FILTER_SANITIZE_NUMBER_INT);
                                $user_email=filter_var($profileRow['USER_EMAIL'],FILTER_SANITIZE_SPECIAL_CHARS);
                                $user_address = filter_var($profileRow['USER_ADDRESS'],FILTER_SANITIZE_SPECIAL_CHARS);
                                $user_profile_img= $profileRow['USER_PROFILE_IMG'];
                              }
                              ?>
                           <h4 class=""> Update Information </h4>
                           <form method='POST' action=''>
                              <label for="name">Full Name:</label>
                              <input name="fullname" type="name" class="form-control" value="<?php echo (isset($full_name))?$full_name:'';?>" required><br>
                              <label for="contact">Contact:</label>
                              <input name="contact" type="tel" class="form-control" value="<?php echo (isset($user_contact))?$user_contact:'';?>" required><br>
                              <label for="Email">Email:</label>
                              <input name="email" type="text" class="form-control" value="<?php echo (isset($user_email))?$user_email:'';?>" disabled><br>
                              <label for="address">Address:</label>
                              <input name="address" type="text" class="form-control" value="<?php echo (isset($user_address))?$user_address:'';?>" required><br>
                              <input type="submit" name="save" value="Save">
                              <a href="trader-dashboard.php"><div class="cancel">Cancel</div></a>
                           </form>
                        </div>
                        <div class=" col-md-4  d-flex flex-column bd-highlight mb-3">


                        
                           <div class="image-container"><img src="../images/profile/<?php echo $user_profile_img?>" alt="<?php echo $user_profile_img?>"/></div>
                           <form action="upload.php" method="post" enctype="multipart/form-data">
                              <input type="file" name="my_image" >
                              <div class='upload-container'><input type="submit" name="upload_pic" value="upload" ></div> 
                           </form>
                        </div>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="shop">
                     <div class="row justify-content-center">
                        <?php 
                           // This statement clears all cache so page doesnt resubmit form in case of reloading the page. 
                           // header("Cache-Control: no cache");             
                           
                           
                                           $shopQuery = "select * from shop s inner join site_user su on su.pk_user_id=s.fk4_user_id where s.fk4_user_id =$user_id  and shop_active='Y'";
                                           $shopQueryResult=  oci_parse($connection,$shopQuery); 
                                           if (!$shopQueryResult) 
                                           {
                                               $error = oci_error($connection);    
                                               trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
                                           }
                                           $run = oci_execute($shopQueryResult); 
                                           if(!$run) 
                                           {    
                                               $error = oci_error($shopQueryResult);
                                               trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
                                           }
                                           $count=0;
                                           while($shopRow = oci_fetch_assoc($shopQueryResult)){
                                             $shop_id=filter_var($shopRow['PK_SHOP_ID'],FILTER_SANITIZE_SPECIAL_CHARS);
                                             $shop_name = filter_var($shopRow['SHOP_NAME'],FILTER_SANITIZE_SPECIAL_CHARS);
                                             $shop_type=filter_var($shopRow['SHOP_TYPE'],FILTER_SANITIZE_SPECIAL_CHARS);
                                             $shop_address = filter_var($shopRow['SHOP_ADDR'],FILTER_SANITIZE_SPECIAL_CHARS);
                
                                             echo'
                                         <div class="col-md-7  d-flex flex-column bd-highlight pt-5">
                                         <form method="POST" action="">
                                               <input name="hiddenshopid" type="hidden" class="form-control" value="'.$shop_id .'"required>
                                                 <label for="name">Shop Name:</label>
                                                 <input name="shopname" type="name" class="form-control" value="'.$shop_name.'" required><br>
                           
                                                 <label for="Type">Shop Type:</label>
                                                 <input name="shoptype" type="text" class="form-control" value="'.$shop_type.'" disabled><br>
                           
                                                 <label for="address">Shop Address:</label>
                                                 <input name="shopaddress" type="text" class="form-control" value="'.$shop_address.'" required><br>
                                             <input type="submit" name="save2" value="Save">
                                             <a href="trader-dashboard.php"><div class="cancel">Cancel</div></a>
                                             </form>
                                         </div>
                                         ';
                                         $count++;
                                       }
                                       if($count==0){
                                         echo"Shop pending for aproval. Please contact your admin";
                                       }
                                       ?>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="security">
                     <div class="row justify-content-center">
                        <div class="col-md-7  d-flex flex-column bd-highlight pt-5">
                           <h4 class="heading"> Change Password </h4>
                           <form method='POST' action=''>
                              <label for="password">Old Password:</label>
                              <input name="old-pass" type="password" class="form-control"><br>
                              <label for="password">New Password:</label>
                              <input name="new-pass" type="password" id="password" class="form-control"><br>
                              <label for="password">Re-enter Password:</label>
                              <input name="re-pass" type="password" id="password" class="form-control"> <br>
                              <input type="submit" name="save3" value="Save">
                              <a href="trader-dashboard.php"><div class="cancel">Cancel</div></a>
                           </form>
                        </div>
                        <div class=" col-md-5  d-flex flex-column bd-highlight mb-3">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <footer>
         <?php include '../reusable/footer_customer.php'; ?>
      </footer>
  <!-- js file -->
  <script src="../js/owl.carousel.min-1.js"></script>
  <script src="../js/main-1.js"></script>
  <script src="../js/popper.min-1.js"></script>
  <script src="../js/internal.min-1.js"></script>


      
    <script>
      setTimeout(function(){
      document.getElementById('error-box').style.visibility = 'hidden'; 
      document.getElementById('error-box').style.display = 'none';
      }, 8000);
    </script>
  
   <script>
      setTimeout(function(){
      document.getElementById('success-box').style.visibility = 'hidden'; 
      document.getElementById('success-box').style.display = 'none';
      }, 8000);
   </script>

   </body>
</html>