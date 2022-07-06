<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../sass/main-2.css">

    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="../css/individualProduct.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</head>

<body>

 <!-- NAVBAR STARTS HERE -->
 <div class="navbar-container">
        <?php include '../reusable/new_customer_header.php'; ?>
</div>

<div class="container-fluid">
    <?php 

        include '../reusable/connection.php';


        //This piece of code retrieves Product ID from the URL.
        $productToDisplay = $_GET['productID'];

        //Storing current User_id into a variable
        $currentUserId = $_SESSION['user_id'];

        //Get shop name of this product_id
        $shopQuery = "SELECT S.SHOP_NAME, S.SHOP_TYPE FROM SHOP S INNER JOIN PRODUCT P ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE P.PK_PRODUCT_ID = $productToDisplay";
        $shopQueryResult=  oci_parse($connection,$shopQuery); 
        oci_execute($shopQueryResult); 


        while($shopRow = oci_fetch_assoc($shopQueryResult)){
            $shopName = $shopRow['SHOP_NAME'];
            $shopType = $shopRow['SHOP_TYPE'];
        }


        //Getting other details of product from product table.
        $sql_query = "SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID = $productToDisplay";
        $result=  oci_parse($connection,$sql_query); 
        oci_execute($result); 

        $resultCheck = oci_num_fields($result);



        if($resultCheck > 0){

            while($row = oci_fetch_assoc($result)){

                $rating = round($row['PRODUCT_RATING']);
                $i = 1; 

                echo "
                <!-- Product Information starts here -->
                <div class='product-container'>
                    <div class='product-image-container'>
                        <img src='../images/products/$row[PRODUCT_IMAGE]'/>
                    </div>
                

                    <div class='product-info-container'>
                        <div class='product-heading'>$row[PRODUCT_NAME]</div>
                        <div class='product-brand'>Sold by: $shopName</div>";

                        if($row['PRODUCT_QUANTITY'] != 0){ echo " <div><p class='product-stocks-success'> In Stock : <span id='product-stock'> $row[PRODUCT_QUANTITY] </span> </p></div>";  }
                        else{ echo "<div><p class='product-stocks-fail'> NOT IN STOCK </p> </div>"; }
                        
                        echo "
                        <div class='product-rating'>";
                            while($i <= 5){
                                    if( $i<=$rating){
                                        echo "<span class='fa fa-star checked'></span>";
                                        $i = $i +1;
                                    }

                                    else{                                
                                       echo "<span class='fa fa-star unchecked'></span>";
                                        $i = $i +1;
                                    }
                                }

                        echo "</div>

                        <div class='product-price'>Rs $row[PRODUCT_PRICE]</div>";
                        if($row['PRODUCT_ALLERGY_INFORMATION']!='') { echo " <div class='product-allergy-information'><p> <img src='images/icons/warning.png' style='height:20px'> $row[PRODUCT_ALLERGY_INFORMATION] </p></div> ";}

                        echo "
                        <div class='product-form'>

                            <form action='../cart/cart-work.php' method='POST'>";
                             if($row['PRODUCT_QUANTITY'] != 0){
                                echo "<div class='test'>
                                        <div class='subtract noselect' onclick='decrementValue()'> - </div>
                                        <div class='counter'><input type='number' name='quantity' min=1 id='quantity' value='1'></div>
                                        <div class='addition noselect' onclick='incrementValue()'> + </div>
                                    </div>
                                    <input type='hidden' name='productid' value='$row[PK_PRODUCT_ID]'>
                                    <input type='submit' name='submit' class='add-to-cart-button' value='Add to Cart'><br>";
                             }

                                if(!empty($_SESSION['cartLimitExceedMessage']) || !empty($_SESSION['ProductLimitExceedMessage'])){
                                    $message1 = $_SESSION['cartLimitExceedMessage'];
                                    $message2 = $_SESSION['ProductLimitExceedMessage'];
                                    echo "<div id='error-box'> 
                                       $message1 $message2
                                    </div>";
                                }

                                

                                   
                                echo "
                            </form>

                        </div>



                    </div>
                </div>    <!-- Product Container ends here -->

                <br>

                <div class='product-description'>
                    <h4>Product Description</h4>
                    <p>$row[PRODUCT_DESCRIPTION]</p>
                </div>";

                $currentShopID = $row['FK1_SHOP_ID'];
            }
        
        }

        else{
            echo "Product with $productToDisplay ID doesn't exist.";
        }
    ?>


                <div class='product-feedback-container'>
                    <div class="heading"><h4>What our customer says?</h4></div>

                    <div class="feedback" id="feedback-prompt" onclick=showDiv()>

                        <div id="sub-heading">Leave a comment </div>

                        <form action="" method="POST">
                            <input type="text" name="feedback-comment" id="feedback-comment" maxlength="149" placeholder="Leave a review">

                            <select name="feedback-rating" id="feedback-rating">
                                <option value="5">5 Star</option>
                                <option value="4">4 Star</option>
                                <option value="3">3 Star</option>
                                <option value="2">2 Star</option>
                                <option value="1">1 Star</option>
                            </select>

                            <input type="submit" value="Post it" name="feedback-button" id="feedback-button">
                        </form>
                    </div>

                    
                <?php 
                    /*  

                    This part is for comment posting. . 
                    
                    */
                    
                    header("Cache-Control: no cache");             //This statement clears all cache so page doesnt resubmit form in case of reloading the page. 
                
                    if(isset($_POST['feedback-button'])){

                        if(empty($_SESSION['currentTraderId'])){
                            $feedbackComment = filter_var(trim($_POST['feedback-comment'], FILTER_SANITIZE_SPECIAL_CHARS));
                            $feedbackRating = $_POST['feedback-rating'];
                            
                            // First rating is update in product table. As long 
                            if(!empty($_SESSION['user_id'])){

                                $fetchRatingQuery = "SELECT PRODUCT_RATING FROM PRODUCT WHERE PK_PRODUCT_ID = $productToDisplay ";
                                $fetchRatingResult=  oci_parse($connection, $fetchRatingQuery); 
                                oci_execute($fetchRatingResult); 

                                while($fetchRatingRow = oci_fetch_assoc($fetchRatingResult)){
                                    $currentRating = $fetchRatingRow['PRODUCT_RATING'];
                                }

                                //Calculating new updated rating before hand.
                                $newFeedbackRating = ($currentRating +$feedbackRating)/2;

                                // Inserting new updated rating into Feedback
                                $insertRatingQuery = "UPDATE PRODUCT SET PRODUCT_RATING=$newFeedbackRating WHERE PK_PRODUCT_ID = $productToDisplay";
                                $insertRatingResult=  oci_parse($connection, $insertRatingQuery); 
                                oci_execute($insertRatingResult); 

                                if(!empty($_POST['feedback-comment'])){

                                    $_SESSION['commentmaaayo'] = 'dosro ko part ma aayo';
    
                                    $feedbackPostQuery = "INSERT INTO FEEDBACK(PK_FEEDBACK_ID,FEEDBACK_ACTIVE,FK1_PRODUCT_ID,FK2_USER_ID,PRODUCT_COMMENT,PRODUCT_RATING) 
                                                        VALUES (FEEDBACK_ID_SEQ.NEXTVAL, 'Y', $productToDisplay, $currentUserId, '$feedbackComment', $feedbackRating )";
                                    $feedbackPostResult=  oci_parse($connection, $feedbackPostQuery); 
                                    oci_execute($feedbackPostResult); 
        
                                }

                            }

                            else{
                                echo '<p id="error-box-block"> You have to be logged in to comment on products. </p>';
                            }


                        }

                        else{
                            echo '<p id="error-box-block"> Trader cannot comment on products. </p>';
                        }

                    }

                    


                    /*

                    This part is shows comments of the product

                    */
                    $feedbackQuery = "SELECT F.PRODUCT_COMMENT, U.USER_NAME, F.PRODUCT_RATING FROM FEEDBACK F INNER JOIN SITE_USER U ON U.PK_USER_ID = F.FK2_USER_ID WHERE F.FK1_PRODUCT_ID = $productToDisplay AND F.FEEDBACK_ACTIVE = 'Y'";
                    $feedbackResult=  oci_parse($connection,$feedbackQuery); 
                    oci_execute($feedbackResult); 
 
                    $feedbackresultCheck = oci_num_fields($feedbackResult);

                    if($feedbackresultCheck > 0){

                        while($feedbackRow = oci_fetch_assoc($feedbackResult)){

                            $commentRating = $feedbackRow['PRODUCT_RATING'];
                            $i = 1;

                            echo "
                            <div class='feedback'>
                                <div class='rating'>";
                                    while($i <= 5){
                                        if( $i<=$commentRating){
                                            echo "<span class='fa fa-star checked'></span>";
                                            $i = $i +1;
                                        }

                                        else{                                
                                        echo "<span class='fa fa-star unchecked'></span>";
                                            $i = $i +1;
                                        }
                                    }

                                echo "
                                </div>

                                <div class='comment'> $feedbackRow[PRODUCT_COMMENT] </div>
                                <div class='user'>- $feedbackRow[USER_NAME]</div>
                            </div>";
                        }
                    }

                    else{
                        echo "<p> No comments found on this product. Be the first to write.</p>";
                    }

                ?>
                </div>
    


    <div class="more-product-container">
        <div class="heading"><h4>More products from this shop</h4></div>


        <?php
        echo "
            <section id='our-products' style='padding-top: 10px;'>
              <div class='container'>

                <div class='owl-slider'>
                  <div class='productsp owl-carousel owl-theme'>";

        $shopFetchQuery = "SELECT s.shop_type, p.PK_PRODUCT_ID, p.product_name ,p.product_price , p.product_quantity ,p.product_active,p.product_rating,p.PRODUCT_IMAGE FROM SHOP S INNER JOIN PRODUCT P ON p.fk1_shop_id = s.pk_shop_id WHERE shop_type='$shopType'";
        $shopFetchResult = oci_parse($connection, $shopFetchQuery);
        oci_execute($shopFetchResult); 


        while ($shopFetchRow = oci_fetch_assoc($shopFetchResult)){       
                    $productID =  $shopFetchRow['PK_PRODUCT_ID'];

                    echo "
                    <div class='item'>                    <a href='../customer/individualProduct.php?productID=$productID'>

                      <div class='card'>
                        <div class='sp-img'>
                          <img src='../images/products/".$shopFetchRow['PRODUCT_IMAGE']."' class='card-img-top' alt='img'></a>
                        </div>
                      <div>
                      ".$shopFetchRow['PRODUCT_NAME']."
                      </div>
                      </div>
                    </div>";
        }
                  echo "
                  </div>
                </div>
        
                <div class='views-all'>
                <a href='productSearchPage.php?category=$shopType'> <button type='button' class='btn btn-success'>View all</button></a>
                </div>
            </div>
          </section>";?>



            
        
    </div>

</div>  

<div class="footer">
    <?php include '../reusable/footer_customer.php'; 
    unset($_SESSION['ProductLimitExceedMessage']);
    unset($_SESSION['cartLimitExceedMessage']);
    ?>
</div>



<script>

    var inStock = parseInt(document.getElementById('product-stock').innerText)

    function showDiv() {
        document.getElementById('sub-heading').style.display = "none";
        document.getElementById('feedback-comment').style.display = "block";
        document.getElementById('feedback-rating').style.display = "inline-block";
        document.getElementById('feedback-button').style.display = "inline-block";
    }

    function incrementValue(){
        var value = parseInt(document.getElementById('quantity').value, 10);
        value = isNaN(value) ? 0 : value;

        if(inStock > 20 ){ var maxLimit = 20}
        else{var maxLimit = inStock}

        if(value === maxLimit){alert('You cannot buy more of this item at once.')}
        if(value<maxLimit){value++}



        

        document.getElementById('quantity').value = value;
    }

    function decrementValue(){
        var value = parseInt(document.getElementById('quantity').value, 10);
        value = isNaN(value) ? 0 : value;
        
        if(value>1){ value-- }

        document.getElementById('quantity').value = value;


        
    }

    setTimeout(function(){
    document.getElementById('error-box').style.visibility = 'hidden'; 
    }, 8000);



</script>

  <!-- js file -->
  <script src="../js/owl.carousel.min-1.js"></script>
  <script src="../js/main-1.js"></script>
  <script src="../js/popper.min-1.js"></script>
  <script src="../js/internal.min-1.js"></script>




    
</body>
</html>