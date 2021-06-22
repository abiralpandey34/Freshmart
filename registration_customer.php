<?php
include "connection.php";
    $user_email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
    $user_name=filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
    $user_email_check=filter_var($_POST['user_email_check'],FILTER_SANITIZE_EMAIL);
    $user_password=filter_var($_POST['user_password'],FILTER_SANITIZE_STRING);
    $user_password_check=filter_var($_POST['user_password_check'],FILTER_SANITIZE_STRING);
    $user_type='customer';
    $user_status='active';

        if  (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['user_name'])
            || preg_match('~[0-9]~', $_POST['user_name'])){
            $error="Name should not contain Numbers or Special Characters";echo $error;
        }

        elseif(strlen($_POST['user_password'])<6 ){
            $error="Password Should be longer than 6 characters";
            if(1!==preg_match('~[0-9]~', $_POST['user_password'])){
            $error="Password Should Include numbers ";
        }
}

$query_select_email="SELECT * FROM USER WHERE user_email='$user_email'";
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
        if($user_password!==$user_password_check){
            $error= "Password Does Not Match";
        }
        
        else{
           
            $query="INSERT INTO USER (user_name,user_password,user_email, user_status, user_type) 
            VALUES('$user_name', '$user_password', '$user_email', '$user_status', '$user_type')";
            if(mysqli_query($connection,$query)){
                $error= "User Registered Sucessfully.";
            }
            else{
                $error= "Unknown Error occured";
            }
        }
    }
                
}

?>
