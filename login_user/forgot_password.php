<?php include "../reusable/connection.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
        }

        img{
            width:200px;
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

        
       
        #error-box{
            display:block; 
            padding:10px; 
            border-radius:5px;
            background-color:#e64545; 
            color:white; 
            font-weight:500;
            text-align:center;
        }

    </style>
</head>
<body>
<div class="main-container">
    <div class='image-container'><img src="../images/errorPages/lockkey.png" alt=""></div>
    <div class="container">
        <form action="" class='form' method="POST">
            <div style='text-align:center;'> <h2> Account Recovery </h2></div><br><br>
            <label for="Email">Enter Email for your account :</label>
            <input type="email" name="findemail" placeholder="Email address" value="">
            <input type="submit" name="submit">
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $count=0;
        $user_name='';
        $user_email=filter_var($_POST['findemail'],FILTER_SANITIZE_EMAIL);
        
            $querySelect="SELECT * FROM SITE_USER where user_email ='$user_email' and user_status='Y'";
            // connect to OCI and checks if any error during parse or execution of SQL
            $result=  oci_parse($connection,$querySelect); 
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
            // End of execution

            while ($row = oci_fetch_assoc($result)){
                $count++;
                $user_id= $row['PK_USER_ID'];
                $user_name=$row['USER_NAME'];
              }
            if($count==0){
                    echo '<div id="error-box">';
                       echo "Sorry, we're unable to find any accounts associated with this email.";
                    echo '</div>';
            }
            elseif($count==1){
                $user_reset_code=md5(rand());
                
                $queryUpdate="UPDATE SITE_USER SET user_activation_code ='$user_reset_code' where PK_USER_ID=$user_id";
                   
                // connect to OCI and checks if any error during parse or execution of SQL
                    $result=  oci_parse($connection,$queryUpdate); 
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
                    // End of execution



                $baseurl='https://localhost/freshmart/login_user/';
                $to = $user_email;
                $subject = "Account Password Reset";

                $message = 'Dear '.$user_name.',<br>';
                $message .= 'Open this link to reset your passwoed ';
                $message .= $baseurl.'resetpassword.php?reset_code='.$user_reset_code;
                $message .= "<p> Best Regards, FreshMart<br>";

                // // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // $header = "From: broshan18@tbc.edu.np";
                //         $header .= "MIME-Version: 1.0" . "\r\n";
                //         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                // // More headers
                $headers .= 'From: <freshmart@gmail.com>' . "\r\n";
                // $headers .= 'Cc: myboss@example.com' . "\r\n";
                if(mail($to,$subject,$message,$headers)){
                    header('Location: emailConfirmation.php');
                }
            }
        }
?>
</body>