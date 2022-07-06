<?php 
// $connection = oci_pconnect("FRESHMART_DB", "Roshan!12", "localhost/xe");  
$connection = oci_pconnect("ABIRAL", "abiral12", "localhost/xe");  
if (!$connection) {    
  $error =oci_error();    
  trigger_error('Could not connect to database: '.$error['message'],E_USER_ERROR); 
 }  
    ?>