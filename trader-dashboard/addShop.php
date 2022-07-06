<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../css/update.css">
  <title> Add Shop</title>
  <style>

    #success-box{
      display:block; 
      padding:10px; 
      border-radius:5px;
      background-color:rgb(129, 192, 34); 
      text-align:center;
      color:white; 
      font-weight:500;
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
  </style>
</head>

<?php

    include '../reusable/connection.php';

    $user_id=$_SESSION['currentTraderId'];
    $user_email='';
    $selectProfileQuery = "SELECT * FROM SITE_USER WHERE pk_user_id = $user_id";
    $selectProfileQueryResult=  oci_parse($connection,$selectProfileQuery); 
    if (!$selectProfileQueryResult) 
    {
        $error = oci_error($connection);    
        trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
    }
    $run = oci_execute($selectProfileQueryResult); 
    if(!$run) 
    {    
        $error = oci_error($selectProfileQueryResult);
        trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
    }
    
    while($profileRow = oci_fetch_assoc($selectProfileQueryResult)){
        $user_email=filter_var($profileRow['USER_EMAIL'],FILTER_SANITIZE_SPECIAL_CHARS);
    }


// Shop General Info
if (isset($_POST['save']))
{   
    $currentTraderId = $_SESSION['currentTraderId'];

    $shopName = filter_var($_POST['shopName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $shopAddress = filter_var($_POST['shopAddress'], FILTER_SANITIZE_SPECIAL_CHARS);
    $shopType=filter_var($_POST['shopType'], FILTER_SANITIZE_SPECIAL_CHARS);
    $shopactive='N';

    $query = "INSERT INTO SHOP(PK_SHOP_ID, SHOP_NAME, FK4_USER_ID, SHOP_ADDR, SHOP_TYPE, SHOP_ACTIVE, PERMISSIONS, ADMIN_PERMISSION) VALUES (PK_SHOP_ID_SEQ.NEXTVAL, '$shopName', $currentTraderId, '$shopAddress', '$shopType', '$shopactive','$user_email','ADMIN_FRESHMART')"; 
    $addShop = oci_parse($connection, $query);
    oci_execute($addShop); 

    $success = 'Shop sent for approval.';

        
}
?>

<body>
  <div class="container">
    <!-- create new row -->
    <div class="row">
      <!-- first column starts -->
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <br>
        <!-- navigation tab starts -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        
          <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#health" role="tab" aria-controls="Product_update" aria-selected="true">Product Update</a>
          </li>
        </ul>
        
        <div class="tab-content" style="border:1px solid #dedede; padding:20px 0px;">

        <?php 
            if(!empty($success)){
              echo "<div id='success-box'>".$success."</div>";
            }
        ?>
           
          <!-- product- update- form -->
          <div role="tabpanel" class="tab-pane fade active show" id="health">
            <div class="row justify-content-center">
              <div class="col-md-7  d-flex flex-column bd-highlight pt-5">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="Name">Shop Name:</label>
                        <input type="text"   placeholder="Shop Name" name="shopName" class="form-control"   required/>  <br>

                        <label for="Product Description">Shop Address:</label>
                        <input type="text"   placeholder="Shop Address" name="shopAddress" class="form-control"   required/>  <br>

                        <label for="Product Description">Shop Type:</label>
                        <input type="text"   placeholder="Shop Type" name="shopType" class="form-control"   required/>  <br>

                        
                        <input type="submit" name="save" value="Save">
                        <a href='trader-dashboard.php'><div class='cancel'>Cancel </div> </a>
                        <br><br><br>
                    </form>
              </div>
              
          </div>  
      </div>
    </div>
    
  </div>
</div>

<!-- jQuery first, then Bootstrap JS. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</body>
</html>




<script>
    setTimeout(function(){
    document.getElementById('error-box').style.visibility = 'hidden'; 
    }, 8000);
</script>
