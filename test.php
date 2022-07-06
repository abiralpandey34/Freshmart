<?php

    session_start();
    echo "<h3> PHP List All Session Variables</h3>";
    foreach ($_SESSION as $key=>$val)
    echo $key." ".$val."<br/>";

    date_default_timezone_set('Asia/Kathmandu');

    echo '<br><br>';

    echo 'this cart is : '. empty($_SESSION['currentActiveCart']) .'<br>';


    //Tomorrow's timestamp

    //Print it out
    $selectedDayDate =  date("Y-m-d", strtotime("WEDNESday"));
    echo 'wednesday date is: '.$selectedDayDate.'<br>';




    $user_id = $_SESSION['user_id'];
    if($user_id == ''){
        echo 'this';
    }

    echo 'the user is :'.isset($_SESSION['user_id']);



    // $date = date("Y-m-d h:i:s");
    // $_SESSION['currentTraderId'] = 1;

    $day = date('w');
    $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
    $week_end = date('m-d-Y', strtotime('+'.(6-$day).' days'));


    echo 'week start :'.$week_start.'<br><br>';
    echo 'week end :'.$week_end.'<br><br>';



    // unset($_SESSION['currentTraderId']);

    echo '<br><br>the trader currently is '. $_SESSION['currentTraderId'];

    // echo !empty($_SESSION['currentTraderId']);



    // $count = 0;
    // $total = 0;


    //    unset($_SESSION['currentCart']);
    //    unset($_SESSION['guestCurrentCart']);

 
    // for($i=0;$i<sizeof($_SESSION['guestCurrentCart']);$i++){
    //     foreach($_SESSION['guestCurrentCart'][$i] as $cartProductId=>$cartProductQuantity){
    //         if($cartProductId==2){
    //             array_splice($_SESSION['guestCurrentCart'],$i,1);
    //         }
    //     }
    // }

        

?>

