<?php
    $hostname='localhost';
    $username='root';
    $password='';
    $dbname='freshmart';
    $connection=mysqli_connect($hostname,$username,$password,$dbname)
    or exit("Unable to connect to database!");
?>