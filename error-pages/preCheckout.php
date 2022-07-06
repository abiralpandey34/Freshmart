
<!-- Fonts google -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">



<style>


    body{
    }

    .container{
        font-family: 'Lato', sans-serif;
        display:flex;
        flex-direction:column;

        margin: auto auto;
        margin-top:8%;
        height:400px;
        width:700px;
        text-align:center;
        align-items: center;
        justify-content: center;
    }

    

    .top-container{
        
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        align-items: center;
        justify-content: center;
    }

    .top-container .img{flex:2;}
    .top-container .text{flex:3;}

    .top-container img{
        width:90%;
        height:auto;
    }

    .top-container .text{
        text-align:left;
        color:gray;
        font-weight:600;
        font-size:2em;
    }

    .top-container p{
        display:inline-block;
        margin-top:110px;

    }

    .bottom-container{
        padding-top:10px;
        text-align:center;
        font-size:17px;
    }

    .bottom-container a{
        text-decoration:none;
        font-weight:600;
        color:rgb(129, 192, 34);
    }

    @media only screen and (max-width: 700px) {
        .container{
            width:80%;
        }

        .top-container{
            text-align:center;
            width:80%;
            flex-direction:column;
        }

        .top-container .img{ flex:2 }
        .top-container .text{ flex:5 }

        .top-container img{
        width:80%;
        height:auto;
        }

        .top-container p{
        position: relative;
        margin-top:10px;
        }

    }

</style>


<?php  
    include '../reusable/connection.php';
    include '../reusable/errorReporting.php';

$currentActiveCart = $_SESSION['currentActiveCart'];
$currentActiveUser = $_SESSION['user_id'];
$currentActiveCartSize = $_SESSION['currentActiveCartSize'];

$proceed = 'Y'; //Default is order going to proceed, unless set otherwise


//Checking if cart is empty or not.
if( !empty($_SESSION['user_id']) && $currentActiveCartSize == 0) { 
    echo "
    <body>
        <div class='container'>
            <div class='top-container'>
                <div class='img'>
                    <img src='../images/errorPages/emptyCart.png'>
                </div>

                <div class='text'>
                    <p>Your cart is currently empty. </p>
                </div>
            </div>

            <div class='bottom-container'>
                Click <a href='../login_user/login_form.php'>here</a> to login or You'll be automatically redirected to where you came from in <span id='countdowntimer'>5</span> seconds.
            </div>
        </div>
    </body>";
    $proceed = 'N';
    header('Refresh: 5; URL='. $_SERVER['HTTP_REFERER']);
}


//Checking if user-requested quantity is available in stock or not. 
// For that, first we are going to fetch, product_id from product_cart table.

$buyingStockQuery = "SELECT * FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
$buyingStockResult=  oci_parse($connection,$buyingStockQuery); 
oci_execute($buyingStockResult); 

while ($buyingStockRow = oci_fetch_assoc($buyingStockResult)) {

   $currentProduct = $buyingStockRow['FK2_PRODUCT_ID'];
   $currentItemQuantity = $buyingStockRow['ITEM_QUANTITY'];

    // now, lets compare user-buying product stock with our database stock quantity. 
    //To do that, we have to fetch data first from product table.
    $stockQuery = "SELECT PRODUCT_NAME, PRODUCT_QUANTITY FROM PRODUCT WHERE PK_PRODUCT_ID = $currentProduct";
    $stockResult=  oci_parse($connection,$stockQuery); 
    oci_execute($stockResult); 

    while ($stockRow = oci_fetch_assoc($stockResult)) {
        $stockCount = $stockRow['PRODUCT_QUANTITY'];
        $stockName = $stockRow['PRODUCT_NAME'];
    }

    if($stockCount < $currentItemQuantity ){
        echo "
        <body>
            <div class='container'>
                <div class='top-container'>
                    <div class='img'>
                        <img src='../images/errorPages/notFound.png'>
                    </div>

                    <div class='text'>
                        <p> We do not have $currentItemQuantity quantity of $stockName. <br>Stock Available: $stockCount</p>
                    </div>
                </div>

                <div class='bottom-container'>
                    Click <a href='../login_user/login_form.php'>here</a> to login or You'll be automatically redirected to where you came from in <span id='countdowntimer'>5</span> seconds.
                </div>
            </div>
        </body>";
        $proceed = 'N';
        header('Refresh: 5; URL='. $_SERVER['HTTP_REFERER']);
    }
}


// If user is logged in and proceed flag is Y
if(!empty($_SESSION['user_id']) && $proceed=='Y'){
    header('Location:../customer/checkout.php');
}


// Checking if person trying to go to checkout.php is trader or not.
elseif($_SESSION['user_type'] == 'trader' || $_SESSION['user_type'] == 'ADMIN'  ){
    echo "
    <body>
        <div class='container'>
            <div class='top-container'>
                <div class='img'>
                    <img src='../images/errorPages/lock.png'>
                </div>

                <div class='text'>
                    <p> For now, trader and admin are not allowed to buy items.  </p>
                </div>
            </div>

            <div class='bottom-container'>
                Click <a href='../login_user/login_form.php'>here</a> to login or You'll be automatically redirected to where you came from in <span id='countdowntimer'>5</span> seconds.
            </div>
        </div>
    </body>";
    header('Refresh: 5; URL='. $_SERVER['HTTP_REFERER']);
}



// Checking if user is logged in or not.
elseif(empty($_SESSION['user_id'])){
    echo "
    <body>
        <div class='container'>
            <div class='top-container'>
                <div class='img'>
                    <img src='../images/errorPages/lock.png'>
                </div>

                <div class='text'>
                    <p> You cannot proceed to checkout without logging in.  </p>
                </div>
            </div>

            <div class='bottom-container'>
                Click <a href='../login_user/login_form.php'>here</a> to login or You'll be automatically redirected to where you came from in <span id='countdowntimer'>5</span> seconds.
            </div>
        </div>
    </body>";
    header('Refresh: 5; URL='. $_SERVER['HTTP_REFERER']);
}


else{

}

?>



<script type="text/javascript">
    var timeleft = 5;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>