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
  <link rel="stylesheet" type="text/css" href="../sass/main-2.css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Google fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <title> Freshmart</title>
</head>
<style>



#success-box {
  display: block;
  padding: 10px;
  border-radius: 5px;
  background-color: rgb(129, 192, 34);
  color: white;
  font-weight: 500;

}
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

<body>

<header> 
    <?php 
    
    include '../reusable/new_customer_header.php'; 
    include '../reusable/errorReporting.php';

    $user_id = $_SESSION['currentTraderId'];

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


    ?>
</header>

<?php

if (isset($_POST['send'])){  

    

    
    $to = 'broshan18@tbc.edu.np';

    $subject = $_POST['title'];
    $message = $_POST['Message'];

    // // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // $header = "From: broshan18@tbc.edu.np";
    //         $header .= "MIME-Version: 1.0" . "\r\n";
    //         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // // More headers
    $headers .= 'From: '.$user_email . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";
    if(mail($to,$subject,$message,$headers)){
        $success = 'Message Sent to Admin.';
    }
    
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
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#health" role="tab" aria-controls="Product_update" aria-selected="true">Contact Admin</a>
          </li>
        </ul>
        
        <div class="tab-content">

        <?php 
          if(!empty($success)){
            $message = $success;

            echo '<br><div id="success-box">';
            echo $message;
            echo '</div>';
          }
        ?>
           
          <!-- product- update- form -->
          <div role="tabpanel" class="tab-pane fade active show" id="health">
            <div class="row justify-content-center">
              <div class="col-md-7  d-flex flex-column bd-highlight pt-5">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="title">Title:</label>
                        <input type="text" name="title" value="" class="form-control"   required/>  <br>

                        <label for="Message">Message:</label>
                        <textarea class="form-control"  name="Message" id="" cols="3" rows="5" required></textarea><br>

                        <input type="submit" class='btn btn-primary' style='background-color:rgb(129, 192, 34); width:50%; border-radius:30px; padding:10px 10px; border:none;' name="send" value="SEND">
                        <a href="trader-dashboard.php"><div class="cancel">Cancel</div></a>
                    </form>
                


              </div>
              <div class=" col-md-5  d-flex flex-column bd-highlight mb-3">
              <br>
              <!-- Product image
                <form action="" method="POST" enctype="multipart/form-data">
                  <input type="file"    name="productimage" required/>  
                  <input type="submit" name="upload" value="Save">
                </form> -->
              </div>
          </div>  
      </div>
    </div>
    
  </div>
</div>



  <!-- js file -->
  <script src="../js/owl.carousel.min-1.js"></script>
  <!-- <script src="../js/main-1.js"></script> -->
  <script src="../js/popper.min-1.js"></script>
  <script src="../js/internal.min-1.js"></script>


<script>
      setTimeout(function(){
      document.getElementById('success-box').style.visibility = 'hidden'; 
      document.getElementById('success-box').style.display = 'none';
      }, 8000);
   </script>



</body>
</html>

