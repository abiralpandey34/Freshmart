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

<div class="container-fluid">

  <!-- NAVBAR STARTS HERE -->
    <div class="navbar-container">
         <a href="index.php">NAVBAR GOES HERE</a>
    </div>

    <?php 

        include 'reuseable/connection.php';

        //This piece of code retrieves Product ID from the URL.
        $productToDisplay = $_GET['productID'];

        //Storing current User_id into a variable
        $currentUserId = 1;

        //Get shop name of this product_id
        $shopQuery = "SELECT s.shop_name FROM shop s INNER JOIN product p ON s.shop_id = p.shop_id WHERE p.product_id = $productToDisplay";
        $shopQueryResult = mysqli_query($connection, $shopQuery);

        while($shopRow = mysqli_fetch_assoc($shopQueryResult)){
            $shopName = $shopRow['shop_name'];
        }


        //Getting other details of product from product table.
        $sql_query = "SELECT * FROM product WHERE product_id = $productToDisplay";
        $result = mysqli_query($connection, $sql_query);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){

            while($row = mysqli_fetch_assoc($result)){

                $rating = round($row['product_rating']);
                $i = 1; 

                echo "
                <!-- Product Information starts here -->
                <div class='product-container'>
                    <div class='product-image-container'>
                        <img src='images/$row[product_image]'/>
                    </div>
                

                    <div class='product-info-container'>
                        <div class='product-heading'>$row[product_name]</div>
                        <div class='product-brand'>Sold by: $shopName</div>
                        <div> In Stock : <span id='product-stock'> $row[product_stock] </span> </div>

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

                        <div class='product-price'>Rs $row[product_price]</div>

                        
                        <div class='product-form'>
                            <form action='' method=''>
                                   <div class='test'>
                                        <div class='subtract noselect' onclick='decrementValue()'> - </div>
                                        <div class='counter'><input type='number' min=1 id='quantity' value='1'></div>
                                        <div class='addition noselect' onclick='incrementValue()'> + </div>
                                   </div>


                                    <input type='submit' class='add-to-cart-button' value='Add to Cart'>
                            </form>
                        </div>

                        <div class='product-rate-prompt'>Rate this product</div>


                    </div>
                </div>    <!-- Product Container ends here -->

                <br>

                <div class='product-description'>
                    <h4>Product Description</h4>
                    <p>$row[product_description]</p>
                </div>";
            }
        
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

                    This part is for comment posting. It is not working completely fine. . 
                    
                    */
                    
                    header("Cache-Control: no cache");             //This statement clears all cache so page doesnt resubmit form in case of reloading the page. 
                
                    if(isset($_POST['feedback-button'])){

                        $feedbackComment = filter_var(trim($_POST['feedback-comment'], FILTER_SANITIZE_SPECIAL_CHARS));
                        $feedbackRating = $_POST['feedback-rating'];
                        

                        $feedbackPostQuery = "INSERT INTO feedback(feedback_active,user_id, product_id, product_comment, product_rating) VALUES (1, $currentUserId, $productToDisplay, '$feedbackComment', $feedbackRating)";
                        $feedbackPostResult = mysqli_query($connection, $feedbackPostQuery);

                    }


                    /*

                    This part is shows comments of the product. Few tasks are still incomplete:
                    
                    2. Check if comment_active is true or not. 

                    */
                    $feedbackQuery = "SELECT f.product_comment, u.user_fullname, f.product_rating FROM feedback f INNER JOIN user u ON u.user_id = f.user_id WHERE f.product_id = $productToDisplay AND f.feedback_active = 1 ";
                    $feedbackResult = mysqli_query($connection, $feedbackQuery);
                    $feedbackresultCheck = mysqli_num_rows($feedbackResult);

                    if($feedbackresultCheck > 0){

                        while($feedbackRow = mysqli_fetch_assoc($feedbackResult)){

                            $commentRating = $feedbackRow['product_rating'];
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

                                <div class='comment'> $feedbackRow[product_comment] </div>
                                <div class='user'>- $feedbackRow[user_fullname]</div>
                            </div>";
                        }
                    }
                    else{
                        echo "<p>No comments found on this product. Be the first to write.</p>";
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
    Place footer here
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