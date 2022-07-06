<?php include '../reusable/errorReporting.php'?>


<?php 

    if(isset($_POST['login'])){

            $user_email=filter_var(trim($_POST['user_email']),FILTER_SANITIZE_EMAIL);
            $user_password=filter_var($_POST['user_password'],FILTER_SANITIZE_STRING);
            $user_password = md5($user_password);
            $user_type='';
            $count=0;

            include "../reusable/connection.php";
            $querySelect="SELECT * FROM SITE_USER where user_email ='$user_email' and user_password='$user_password'";
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
                if($user_email==$row['USER_EMAIL'] and $user_password==$row['USER_PASSWORD'] and $row['USER_STATUS']=='Y')
                {     
                    //Resetting error message.
                    unset($_SESSION['loginErrorMessage']); 

                    if($row['USER_TYPE']=='customer'){
                        $_SESSION['loginErrorMessage'] = 'This portal is only for Admin.';
                        header('Location:'. $_SERVER['HTTP_REFERER']);
                    }

                    elseif($row['USER_TYPE']=='trader'){
                        $_SESSION['loginErrorMessage']="Traders are not allowed to use this login portal.";
                        header('Location:'. $_SERVER['HTTP_REFERER']);
                     }

                     elseif(strtoupper($row['USER_TYPE'])=='ADMIN'){
                         $_SESSION['currentAdminId'] = $row['PK_USER_ID'];
                         $_SESSION['user_name']=$row['USER_NAME'];
                         $_SESSION['user_type']=$row['USER_TYPE'];
                         echo"<script> location.href='../admin/admin-dashboard.php'</script>";    
                     }

                
                    else{   }  
                }
            
                elseif($user_email==$row['USER_EMAIL'] and $user_password==$row['USER_PASSWORD'] and $row['USER_STATUS']=='N'){
                    $_SESSION['loginErrorMessage']="You are not verified yet.";
                    header('Location:'. $_SERVER['HTTP_REFERER']);
                }

                else{
                    $_SESSION['loginErrorMessage']="Something went wrong.";  
                    header('Location:'. $_SERVER['HTTP_REFERER']);
                }
            }

            if($count == 0){
                $_SESSION['loginErrorMessage'] = "Wrong username or password.";
                header('Location:'. $_SERVER['HTTP_REFERER']);
            }


}

    
            
    
?> 