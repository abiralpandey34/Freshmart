<?php
include "../reusable/connection.php";
if(isset($_POST['register_trader'])){

    $user_email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
    $user_name=filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
    $user_email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
    $user_email_check=filter_var($_POST['user_email_check'],FILTER_SANITIZE_EMAIL);
    $user_password=filter_var($_POST['user_password'],FILTER_SANITIZE_STRING);
    $user_password_check=filter_var($_POST['user_password_check'],FILTER_SANITIZE_STRING);
    $user_type='trader';
    $user_status='N';
    $count=0;


    $query_select_email="SELECT * FROM SITE_USER WHERE user_email='$user_email'";
    $result_email= oci_parse($connection,$query_select_email);
    if (!$result_email) 
    {
        $error = oci_error($connection);    
        trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
    }
    $run = oci_execute($result_email); 
    if(!$run) 
    {    
        $error = oci_error($result_email);
        trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
    }
    // End of execution

    while($row = oci_fetch_assoc($result_email)){
        
        if($user_email==$row['USER_EMAIL'])
        {  
            $count++;
        }
    }

    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $user_name)|| 
        preg_match('~[0-9]~', $user_name)){
            $error="Name should not contain Numbers or Special Characters";
    }

    elseif(strlen($_POST['user_password'])<6 ){
        $error="Password Should be longer than 6 characters";
        if(1!==preg_match('~[0-9]~', $_POST['user_password']))
        {
            $error="Password Should Include numbers ";
        }
    }

            
    elseif ($count==0) {
        if($user_email!==$user_email_check){
        $error= "Email Does Not Match";
        }

        elseif($user_password!==$user_password_check){
            $error= "Password Does Not Match";
          }

        else{
            $trader_type=filter_var($_POST['trader_type'],FILTER_SANITIZE_STRING);
            $password = md5($user_password);

            $query="INSERT INTO SITE_USER (PK_USER_ID, user_name, user_password, trader_type, user_email, user_status, user_type) 
                    VALUES(PK_USER_ID_SEQ.NEXTVAL, '$user_name','$password','$trader_type', '$user_email', '$user_status', '$user_type' )";

           
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
            }else{
                $success= "User Registered Sucessfully.";
                }
            // End of execution
        }
    }



    else{
        $error= "Email already exists";
                    
    }
}

if(!empty($error)){
    $message2 = $error;
    echo "<div id='error-box'>
    $message2
    </div>";
} 
if(!empty($success)){
    $message2 = $success;
    echo "<div id='success-box'>
    $message2
    </div>";
} 
?>
