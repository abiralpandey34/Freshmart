<?php


$error = '';
$successMessage = '';

// Customer General Info
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

}

// Customer Allergy Info
if (isset($_POST['save2']))
{                   $shop_id=filter_var($_POST['hiddenshopid'],FILTER_SANITIZE_SPECIAL_CHARS);
                    $shop_name = filter_var($_POST['shopname'],FILTER_SANITIZE_SPECIAL_CHARS);
                  $shop_address = filter_var($_POST['shopaddress'],FILTER_SANITIZE_SPECIAL_CHARS);
    $updateShopQuery = "UPDATE SHOP SET shop_name='$shop_name',shop_addr='$shop_address' WHERE fk4_user_id=$user_id and pk_shop_id=$shop_id";
    $updateShopResult = oci_parse($connection, $updateShopQuery);
    $successMessage = ' Shop Info Updated Successfully';
    if(!empty($successMessage)){
        echo '<br><div id="success-box">';
            echo $successMessage;    
        echo '</div>';
    }

    if (!$updateShopResult)
    {
        $error = oci_error($connection);
        trigger_error('Could not parse statement: ' . $error['message'], E_USER_ERROR);
    }
    $run = oci_execute($updateShopResult);
    if (!$run)
    {
        $error = oci_error($updateShopResult);
        trigger_error('Could not execute statement:' . $error['message'], E_USER_ERROR);
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

}
?>
