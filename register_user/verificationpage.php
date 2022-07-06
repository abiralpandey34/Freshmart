  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  
  <link  href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <style>
    #verification-wrapper {
      padding-top: 50px;
    }

    #verification-wrapper .verification {
      border: 1px solid rgba(0, 0, 0, .125);
      padding-top: 30px;
      padding-bottom: 30px;
      border-radius: 4px;
      padding-left: 40px;
      padding-right: 40px;
    }

    #verification-wrapper .verification .verification-logo img {
      width: 270px;
    }

    #verification-wrapper .verification .verification-logo {
      text-align: center;
      padding-bottom: 15px;
    }

    #verification-wrapper .verification .card {
      padding-top: 20px;
      padding-bottom: 20px;
      text-align: center;
    }

    #verification-wrapper h3 {
      font-size: 25px;
      text-align: center;
    }

    #verification-wrapper .form-control {
      height: 50px;
      text-align: center;
      font-size: 20px;
      box-shadow: unset;
    }

    #verification-wrapper .btn {
      padding-right: 60px;
      padding-left: 60px;
      background-color: #96bf2e;
      border: unset;
      font-size: 20px;
      box-shadow: unset;

    }

    #verification-wrapper .btn:hover {
      background-color: #60810d;
    }

    #verification-wrapper .form-control:focus {
      border-color: #96bf2e;
    }

    #verification-wrapper i {
      color: #96bf2e;
      font-size: 60px;
    }

    #verification-wrapper .v-icons {
      padding-bottom: 15px;
    }

    @media(max-width:576px) {
      #verification-wrapper .btn {
        padding-right: 30px;
        padding-left: 30px;
      }

      #verification-wrapper .verification {
        padding-right: 20px;
        padding-left: 20px;
      }
    }
  </style>

<?php
include('../reusable/connection.php');

if(isset($_GET['activation_code']))
{
    $message='';
    $count=0;
    $user_activation_code=$_GET['activation_code'];
    $query="SELECT * FROM SITE_USER
        WHERE user_activation_code= '$user_activation_code'
    ";
    $result=  oci_parse($connection,$query); 
    if (!$result) 
    {
        $error = oci_error($connection);    
        trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
    }
    $run = oci_execute($result); 
    if(!$run) 
    {    
        $error = oci_error($result);
        trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
    }
    while($row = oci_fetch_assoc($result)){
            $count++;
            $userid=$row["PK_USER_ID"];
                 if($row['USER_STATUS']=='N'){
                     
                    $updatequery="UPDATE SITE_USER SET USER_STATUS='Y' WHERE PK_USER_ID=$userid";
                    $updateresult=  oci_parse($connection,$updatequery); 
                    if (!$updateresult) 
                    {
                        $error = oci_error($connection);    
                        trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
                    }
                    $run = oci_execute($updateresult); 
                    if(!$run) 
                    {    
                        $error = oci_error($updateresult);
                        trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
                    }
                    else{
                        echo "
                            <section id='verification-wrapper'>
                                <div class='container'>
                                <div class='verification'>
                                    <div class='verification-logo'>
                                    <img src='../images/logo.png' alt='logo'>
                                    </div>
                                    <div class='card mb-3'>
                                    <div class='card-body'>
                                        <h3>Verification Process Complete. </h3>
                                        <div class='v-icons'>
                                        <i class='far fa-check-circle'></i>
                                        </div>
                                        <p>Welcome to Freshmart</p>
                                        <a href='../login_user/login_form.php'><button type='button' class='btn btn-success'>Login now</button></a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </section> ";
                    }
                 }

                 else{
                    echo "
                    <section id='verification-wrapper'>
                        <div class='container'>
                        <div class='verification'>
                            <div class='verification-logo'>
                            <img src='../images/logo.png' alt='logo'>
                            </div>
                            <div class='card mb-3'>
                            <div class='card-body'>
                                <h3>You were already verified. </h3>
                                <div class='v-icons'>
                                <i class='far fa-check-circle'></i>
                                </div>
                                <a href='../login_user/login_form.php'><button type='button' class='btn btn-success'>Go to Login</button></a>
                            </div>
                            </div>
                        </div>
                        </div>
                    </section> ";
                 }
            
    }

}
?>

  <!-- js file -->
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/internal.min.js"></script>
