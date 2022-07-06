<?php
// Customer General Info

$error = '';
$successMessage = '';

$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

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


if (isset($_POST['save']))
{

    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);

    $updateProfileQuery = "UPDATE SITE_USER SET user_name='$fullname', user_ph='$contact', user_address='$address' WHERE pk_user_id=$user_id";
    $updateProfileResult = oci_parse($connection, $updateProfileQuery);
    $successMessage = 'Profile Updated Successfully';
    if(!empty($successMessage)){
        echo '<br><div id="success-box">';
            echo $successMessage;    
        echo '</div>';
    }

    if (!$updateProfileResult)
    {
        $error = oci_error($connection);
        trigger_error('Could not parse statement: ' . $error['message'], E_USER_ERROR);
    }
    $run = oci_execute($updateProfileResult);
    if (!$run)
    {
        $error = oci_error($updateProfileResult);
        trigger_error('Could not execute statement:' . $error['message'], E_USER_ERROR);
    }

    // Sending mail
    if(isset($updateProfileResult)){
        $baseurl='https://localhost/freshmart/register_user/';
        $to = $user_email;
        $subject = "Account Update Notice";

        $message = 'Dear '.$user_name.',<br>';
        $message .= 'Your profile has been updated successfully on date '.date("Y-m-d H:i:s");
        $message .= 'If you didnt make these changes. Please consider changing your password.';
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

// Customer Allergy Info
if (isset($_POST['save2']))
{
    $allergy = filter_var($_POST['allergy'], FILTER_SANITIZE_SPECIAL_CHARS);

    $updateProfileQuery = "UPDATE SITE_USER SET user_allergy_information='$allergy' WHERE pk_user_id=$user_id";
    $updateProfileResult = oci_parse($connection, $updateProfileQuery);
    $successMessage = 'Health Info Updated Successfully';
    if(!empty($successMessage)){
        echo '<br><div id="success-box">';
            echo $successMessage;    
        echo '</div>';
    }

    if (!$updateProfileResult)
    {
        $error = oci_error($connection);
        trigger_error('Could not parse statement: ' . $error['message'], E_USER_ERROR);
    }
    $run = oci_execute($updateProfileResult);
    if (!$run)
    {
        $error = oci_error($updateProfileResult);
        trigger_error('Could not execute statement:' . $error['message'], E_USER_ERROR);
    }

    // Sending mail
    if(isset($updateProfileResult)){
        $baseurl='https://localhost/freshmart/register_user/';
        $to = $user_email;
        $subject = "Account Update Notice";

        $message = 'Dear '.$user_name.',<br>';
        $message .= 'Your profile has been updated successfully on date '.date("Y-m-d H:i:s");
        $message .= 'If you didnt make these changes. Please consider changing your password.';
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

// Customer Password
if (isset($_POST['save3']))
{
    if (!empty($_POST['new-pass']) && !empty($_POST['re-pass']) && !empty($_POST['old-pass']))
    {
        $oldPass = md5($_POST['old-pass']);
        $newPass = $_POST['new-pass'];
        $rePass = $_POST['re-pass'];
        if (strlen($newPass) < 6)
        {
          $error= "Password Should be longer than 6 characters";
            if (1 !== preg_match('~[0-9]~', $newPass))
            {
                $error = "Password Should Include numbers ";
            }
        }

        elseif ($newPass != $rePass)
        {
          $error= "New Password and Re-entered Passwords didn't match.";
        }
        else
        {
            $passwordQuery = "SELECT user_password from SITE_USER where pk_user_id=$user_id";
            $passwordQueryResult = oci_parse($connection, $passwordQuery);
            if (!$passwordQueryResult)
            {
                $error = oci_error($connection);
                trigger_error('Could not parse statement: ' . $error['message'], E_USER_ERROR);
            }
            $run = oci_execute($passwordQueryResult);
            if (!$run)
            {
                $error = oci_error($passwordQueryResult);
                trigger_error('Could not execute statement:' . $error['message'], E_USER_ERROR);
            }
            while ($passwordQueryRow = oci_fetch_assoc($passwordQueryResult))
            {
                $currentPassword = $passwordQueryRow['USER_PASSWORD'];
            }

            if ($oldPass != $currentPassword)
            {
              $error= "Old Password you entered is wrong. ";
            }
            else
            {    
                $newPass = md5($newPass);
                $updateProfileQuery = "UPDATE SITE_USER SET user_password='$newPass' WHERE pk_user_id=$user_id";
                $updateProfileResult = oci_parse($connection, $updateProfileQuery);
                $successMessage = 'Update Successful';

                if(!empty($successMessage)){
                    echo '<br><div id="success-box">';
                        echo $successMessage;    
                    echo '</div>';
                }

                if (!$updateProfileResult)
                {
                    $error = oci_error($connection);
                    trigger_error('Could not parse statement: ' . $error['message'], E_USER_ERROR);
                }
                $run = oci_execute($updateProfileResult);
                if (!$run)
                {
                    $error = oci_error($updateProfileResult);
                    trigger_error('Could not execute statement:' . $error['message'], E_USER_ERROR);
                }
            }
        }

    }

    elseif (!empty($_POST['new-pass']) && !empty($_POST['re-pass']) && empty($_POST['old-pass']))
    {
        $error= "Old password missing. Make sure you entered your old password.";
    }

    elseif (!empty($_POST['new-pass']) && empty($_POST['re-pass']) && empty($_POST['old-pass']))
    {
      $error= "Please fill Old password and re-new password";
    }

    elseif (!empty($_POST['new-pass']) && empty($_POST['re-pass']) && empty($_POST['old-pass']))
    {
      $error= "Please fill Old password and re-new password";
    }

    elseif (empty($_POST['new-pass']) && empty($_POST['re-pass']) && empty($_POST['old-pass']))
    {
      $error= "Nothing to save";
    }

    else
    {
      $error= 'Please fill up all forms.';
    }

    
    if(!empty($error)){
        echo '<br><div id="error-box">';
            echo $error;    
        echo '</div>';
    }


    // Sending mail
    if(isset($updateProfileResult)){
        $baseurl='https://localhost/freshmart/register_user/';
        $to = $user_email;
        $subject = "Account Update Notice";

        $message = 'Dear '.$user_name.',<br>';
        $message .= 'Your profile has been updated successfully on date '.date("Y-m-d H:i:s");
        $message .= 'If you didnt make these changes. Please consider changing your password.';
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

?>
