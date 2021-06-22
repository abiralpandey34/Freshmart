<?php
include "connection.php";
$user_email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
$user_name=filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
$user_email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
$user_email_check=filter_var($_POST['user_email_check'],FILTER_SANITIZE_EMAIL);
$user_type='trader';
$user_status='active';


if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user_name)|| 
    preg_match('~[0-9]~', $user_name)){
        $error="Name should not contain Numbers or Special Characters";echo $error;
}

$query_select_email="SELECT * FROM USER WHERE user_email='$user_email'";
$count=0;
$result_email= mysqli_query($connection,$query_select_email);

    if (mysqli_num_rows($result_email) > 0) {
        $row = mysqli_fetch_assoc($result_email);
        if($user_email==$row['user_email'])
        {
            echo "Email already exists";
        }
    } 
    else{
        if($user_email!==$user_email_check){
            $error= "Email Does Not Match";echo $error;
        }
        else{
            if(empty($_POST['trader_type'])  || $_POST['trader_type']==='null'){
                
                $error= "Select Trader Type";echo $error;
            }
            else{
                $trader_type=filter_var($_POST['trader_type'],FILTER_SANITIZE_STRING);
                $query="INSERT INTO USER (user_name,trader_type,user_email, user_status, user_type) 
                        VALUES('$user_name','$trader_type','$user_email','$user_status','$user_type' )";
                if(mysqli_query($connection,$query)){
                $error= "User Registered Sucessfully.";
                echo $error;
                }
                else{
                $error= "Unknown Error occured";echo $error;
                }
            }
        }
                    
    }
?>
