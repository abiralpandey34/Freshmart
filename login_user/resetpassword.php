<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">

    <style>
        .main-container{
            display:flex;
            flex-direction:row;
            justify-content:center;
            align-items:center;
            box-shadow:none;

            margin:auto auto;
            margin-top:10%;

        }

        .image-container{
            text-align:center;
            align-self:center;
            margin-right:20px;
        }

        .heading{
            text-align:center;
        }

        img{
            width:150px;
        }

        .container{
            width:40%;
            margin:0px !important;
            padding:20px;
            box-shadow:none;
            border-radius:5px;
            transition:0.4s;
        }

        .main-container:hover{
            /* box-shadow: 5px 10px 10px 5px silver; */
        }

        .container label{
            font-weight:600;
            font-size:1.2em;
        }

        input[type=submit]{
            padding:10px 5px;
            margin:0px;
        }

        @media only screen and (max-width: 750px) {
           .main-container{
               flex-direction:column;
           }

           img{
            width:150px;
            }   

           .container{
            width:80%;}
        }

        @media only screen and (max-width: 400px) {

           .container{
            width:100%;}
        }

       
        .error-box{
            display:block; 
            padding:10px; 
            border-radius:5px;
            background-color:#e64545; 
            color:white; 
            font-weight:500;
            text-align:center;
        }

        .success-box{
            display:block; 
            padding:10px; 
            border-radius:5px;
            background-color:rgb(129, 192, 34);
            color:white; 
            font-weight:500;
            text-align:center;
        }

    </style>

</head>
<body>
<?php

include('../reusable/connection.php');


if(isset($_GET['reset_code']))
{
    $message='';
    $count=0;
    $user_activation_code=$_GET['reset_code'];
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
            $user_password=$row["USER_PASSWORD"];
                 
            
    }
    if($count==0){
        echo '<div id="error-box">';
            echo 'Something went wrong.';
        echo '</div>';
    }
    elseif($count==1){
        echo'
        <!-- Add CSS here -->
        <div class="main-container">
            <div class="image-container"> <img src="../images/errorPages/unlock.png" alt=""></div>

            <div class="container">
                <form method="POST" action="">
                    <div class="heading"><h2>Account Reset</h2></div><br>
                    <input name="old-pass" type="hidden" value='.$user_password.' class="form-control">
                            <label for="password">New Password:</label>
                    <input name="new-pass" type="password" id="password" class="form-control">

                    <label for="password">Re-enter Password:</label>
                    <input name="re-pass" type="password" id="password" class="form-control"> <br>
                
                    <input type="submit" name="submitnew" value="Save">
                </form>
            </div>
        </div>

        ';
        if(isset($_POST['submitnew'])){
            if(strlen($_POST['new-pass'])<6 ){
                $error="Password Should be longer than 6 characters";
                if(1!==preg_match('~[0-9]~', $_POST['new-pass']))
                {
                    $error="Password Should Include numbers ";
                }
            }
            elseif($_POST['new-pass']!=$_POST['re-pass'])
            {  
                $error= "New Password and reentered password did not match";

            }
            elseif(md5($_POST['new-pass'])==$_POST['old-pass'])
            {  
                $error= "New Password cannot be same as old password";

            }
            else{
            $updated_password= filter_var($_POST['new-pass'],FILTER_SANITIZE_STRING);
            $updated_password = md5($updated_password);
            $updatequery="UPDATE SITE_USER SET USER_PASSWORD='$updated_password' WHERE PK_USER_ID=$userid";
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
                echo '<div class="success-box">';
                    echo "Password reset successfully. You will get redirected shortly";
                    header('Refresh: 4; URL=../customer/index.php');
                echo '</div>';
            }
        }
        }

    }
    echo '<br><br>';

    if(!empty($error)){
        echo '<div class="error-box">';
            echo $error;    
            // echo 'This is a test';
        echo '</div>';
    }

}
?>
</body>
</html>

