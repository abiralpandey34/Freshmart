<?php 

include 'reuseable/connection.php';

                      
//Fetching Trader Informations
$traderInfoQuery = "SELECT DISTINCT u.user_fullname, u.user_email, u.user_phone_number, u.user_address FROM shop s INNER JOIN user u ON s.user_id = u.user_id where u.user_username='ashik12'";
$traderInfoQueryResult = mysqli_query($connection, $traderInfoQuery);

$ShopNamesquery =  "SELECT s.shop_name FROM shop s WHERE u.user_username='ashik12'";
$ShopNamesqueryResult = mysqli_query($connection, $ShopNamesquery);


while($traderInfoQueryRow = mysqli_fetch_assoc($traderInfoQueryResult)){

  echo "
    <h5><span>Name:</span> $traderInfoQueryRow[user_fullname]</h5>
    <h5><span>Contact:</span> $traderInfoQueryRow[user_phone_number]</h5>
    <h5><span>Address:</span> $traderInfoQueryRow[user_address]</h5>
    <h5><span>Email:</span> $traderInfoQueryRow[user_email]</h5>
    <h5><span>Address:</span> $traderInfoQueryRow[user_address]</h5>";

    //Nested loop to fetch multiple shops 
    

    while($ShopNamesqueryRow = mysqli_fetch_assoc($ShopNamesqueryResult)){
      echo "<h5><span>Shops:</span> $ShopNamesqueryRow[shop_name]</h5>";
    }

}

?>