<?php
    include '../reusable/connection.php';
     $productid=$_GET['productID'];

     echo $productid;
     $productdelete='Y';
     $query="UPDATE PRODUCT SET PRODUCT_DELETE='$productdelete' WHERE PK_PRODUCT_ID = $productid ";
     $deleteproduct = oci_parse($connection, $query);
     oci_execute($deleteproduct); 
     
    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>