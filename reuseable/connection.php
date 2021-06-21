<?php 
$hostname= 'localhost';
$username='root';
$password='';
$databaseName='freshmart';

$connection = mysqli_connect($hostname, $username, $password, $databaseName) or exit("Unable to connect to database!");

session_start();
?>
