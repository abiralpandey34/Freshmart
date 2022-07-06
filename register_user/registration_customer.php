<?php
if(isset($_POST['register_customer'])){
    include "../reusable/connection.php";
    $user_email=filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
    $user_name=filter_var($_POST['user_name'],FILTER_SANITIZE_STRING);
    $user_email_check=filter_var($_POST['user_email_check'],FILTER_SANITIZE_EMAIL);
    $user_password=filter_var($_POST['user_password'],FILTER_SANITIZE_STRING);
    $user_password_check=filter_var($_POST['user_password_check'],FILTER_SANITIZE_STRING);
    $user_type='customer';
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
                $error= "Email Already Exists";

            }
        }


        if  (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['user_name'])
            || preg_match('~[0-9]~', $_POST['user_name'])){
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
            else{
                if($user_password!==$user_password_check){
                    $error= "Password Does Not Match";
                }
        
                else{
                    $user_encrypted_password = md5($user_password);
                    $user_activation_code=md5(rand());
                    $query="INSERT INTO SITE_USER(PK_USER_ID, USER_NAME,USER_PASSWORD,USER_EMAIL,USER_ACTIVATION_CODE, USER_STATUS, USER_TYPE) 
                    VALUES(PK_USER_ID_SEQ.NEXTVAL, '$user_name', '$user_encrypted_password', '$user_email','$user_activation_code', '$user_status', '$user_type')";
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
             // End of execution
                    if(isset($result)){
                            $baseurl='https://localhost/freshmart/register_user/';
                            $to = $user_email;
                            $subject = "Email Verification";

                            $message = 'Dear '.$user_name.',<br>';
                            $message .= 'Open this link to verify your email address ';
                            $message .= $baseurl.'verificationpage.php?activation_code='.$user_activation_code;
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
                                header('Location:emailConfirmation.php');
                            }
                            

                    }
                }

            }
        } 
}



if(!empty($error)){
    $message2 = $error;
    echo "<div id='error-box'>
    $message2
    </div>";
} 
?>
