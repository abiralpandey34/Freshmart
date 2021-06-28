<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/individualProduct.css">

</head>

<body>

 <!-- NAVBAR STARTS HERE -->
 <div class="navbar-container">
        <?php include 'reusable/new_customer_header.php'; ?>
</div>

<div class="container-fluid">
    <?php 

        include 'reusable/connection.php';


        //This piece of code retrieves Product ID from the URL.
        $productToDisplay = $_GET['productID'];

        //Storing current User_id into a variable
        $currentUserId = 1;

        //Get shop name of this product_id
        $shopQuery = "SELECT S.SHOP_NAME FROM SHOP S INNER JOIN PRODUCT P ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE P.PK_PRODUCT_ID = $productToDisplay";
        $shopQueryResult=  oci_parse($connection,$shopQuery); 
        oci_execute($shopQueryResult); 


        while($shopRow = oci_fetch_assoc($shopQueryResult)){
            $shopName = $shopRow['SHOP_NAME'];
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
                        <img src='images/$row[PRODUCT_IMAGE]'/>
                    </div>
                

                    <div class='product-info-container'>
                        <div class='product-heading'>$row[PRODUCT_NAME]</div>
                        <div class='product-brand'>Sold by: $shopName</div>
                        <div> In Stock : <span id='product-stock'> $row[PRODUCT_QUANTITY] </span> </div>

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

                        <div class='product-price'>Rs $row[PRODUCT_PRICE]</div>

                        
                        <div class='product-form'>

                            <form action='cart/cart-work.php' method='POST'>
                                   <div class='test'>
                                        <div class='subtract noselect' onclick='decrementValue()'> - </div>
                                        <div class='counter'><input type='number' name='quantity' min=1 id='quantity' value='1'></div>
                                        <div class='addition noselect' onclick='incrementValue()'> + </div>
                                   </div>
                                   <input type='hidden' name='productid' value='$row[PK_PRODUCT_ID]'>
                                   <input type='submit' name='submit' class='add-to-cart-button' value='Add to Cart'>
                            </form>

                        </div>

                        <div class='product-rate-prompt'>Rate this product</div>


                    </div>
                </div>    <!-- Product Container ends here -->

                <br>

                <div class='product-description'>
                    <h4>Product Description</h4>
                    <p>$row[PRODUCT_DESCRIPTION]</p>
                </div>";
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
                            <input type="text" name="feedback-comment" id="feedback-comment" placeholder="Leave a review">

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

                        $feedbackComment = filter_var(trim($_POST['feedback-comment'], FILTER_SANITIZE_SPECIAL_CHARS));
                        $feedbackRating = $_POST['feedback-rating'];
                        

                        $feedbackPostQuery = "INSERT INTO FEEDBACK(PK_FEEDBACK_ID,FEEDBACK_ACTIVE,FK1_PRODUCT_ID,FK2_USER_ID,PRODUCT_COMMENT,PRODUCT_RATING) VALUES (FEEDBACK_ID_SEQ.NEXTVAL, 'Y', $productToDisplay, $currentUserId, '$feedbackComment', $feedbackRating )";
                        $feedbackPostResult=  oci_parse($connection, $feedbackPostQuery); 
                        oci_execute($feedbackPostResult); 

                    }


                    /*

                    This part is shows comments of the product. Few tasks are still incomplete:
                    
                    2. Check if comment_active is true or not. 

                    */
                    $feedbackQuery = "SELECT F.PRODUCT_COMMENT, U.USER_FULLNAME, F.PRODUCT_RATING FROM FEEDBACK F INNER JOIN SITE_USER U ON U.PK_USER_ID = F.FK2_USER_ID WHERE F.FK1_PRODUCT_ID = $productToDisplay AND F.FEEDBACK_ACTIVE = 'Y'";
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
                                <div class='user'>- $feedbackRow[USER_FULLNAME]</div>
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
            <div class="products">
                Simran ko wala carousel here.
            </div>
        
    </div>

</div>  

<div class="footer">
    <?php include 'reusable/footer_customer.php'; ?>
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



</script>



    
</body>
</html>