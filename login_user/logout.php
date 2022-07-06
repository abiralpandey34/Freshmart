<?php
session_start();

if($_SESSION['user_type']=='customer'){
    session_unset();
    session_destroy();
    header('Location: ../customer/index.php');
}


elseif($_SESSION['user_type']=='trader'){
    session_unset();
    session_destroy();
    header('Location:../customer/index.php');
}

elseif(strtoupper($_SESSION['user_type'])=='ADMIN'){
    session_unset();
    session_destroy();
    header('Location: ../customer/index.php');

}


?>