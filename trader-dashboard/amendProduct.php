
<?php

include '../reusable/connection.php';

$_SESSION['productEditSuccessMessage'] = 'Updated Successfully';
header('Location:'.$_SERVER['HTTP_REFERER']);



?>