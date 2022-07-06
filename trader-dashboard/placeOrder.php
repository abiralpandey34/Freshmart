<?php

include '../reusable/connection.php';

$orderId = $_GET['orderId'];
$productId = $_GET['productId'];

if(isset($orderId) && isset($productId)){

    $orderPlacedQuery="UPDATE ORDER_DETAILS SET IS_PLACED = 'Y' WHERE FK1_ORDER_ID = $orderId AND FK3_PRODUCT_ID = $productId";
    $orderPlacedResult=  oci_parse($connection,$orderPlacedQuery); 
    oci_execute($orderPlacedResult); 

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}



?>