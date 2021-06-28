<?php 
// $hostname= 'localhost';
// $username='root';
// $password='';
// $databaseName='freshmart';

// $connection = mysqli_connect($hostname, $username, $password, $databaseName) or exit("Unable to connect to database!");

// session_start();

$connection = oci_pconnect("ABIRAL", "abiral12", "localhost/xe");  
if (!$connection) {    
  $error =oci_error();    
  trigger_error('Could not connect to database: '.$error['message'],E_USER_ERROR); 
 }  

 session_start();

?>


