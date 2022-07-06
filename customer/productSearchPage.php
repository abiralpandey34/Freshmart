<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/productSearchPage.css">
</head>

<body>

    <div class="navbar-container">
        <?php include '../reusable/new_customer_header.php';   ?>

    </div>



    <div class="container" style="padding:0px;">
     <?php
        if(!empty($_SESSION['cartLimitExceedMessage']) || !empty($_SESSION['ProductLimitExceedMessage'])){
            $message1 = $_SESSION['cartLimitExceedMessage'];
            $message2 = $_SESSION['ProductLimitExceedMessage'];
            echo "<div id='error-box'> 
            $message1 $message2
            </div>";
        }
            ?>
    
        <div class="section-container"> 

       

            <!-- Sidemenu-container starts here -->
            <form action="" method="GET">
                <div class="sidemenu-container">
                        <div class="box box0">
                            <h2>Product Filter</h2>
                        </div>

                        <div class="box box1 ">
                            <span class="text-gray-small"> SEARCH HERE </span><br>
                            <input type="text" name="searchQuery" placeholder="Search Query" value = "<?php if(isset($_GET['searchQuery'])) {echo $_GET['searchQuery'];}?>" class="w-all"> 
                        </div>

                        <div class="box box7 ">
                            <span class="text-gray-small"> PRODUCT CATEGORY </span><br>
                            <select name="category" class="sidemenu-dropdown">
                                <option value="" selected>Any</option>
                                <?php

                                    $distinctShopQuery = "SELECT DISTINCT SHOP_TYPE FROM SHOP WHERE SHOP_ACTIVE='Y'";
                                    $distinctShopResult = oci_parse($connection, $distinctShopQuery);
                                    oci_execute($distinctShopResult); 

                                    while ($distinctShopRow = oci_fetch_assoc($distinctShopResult)){
                                        $currentDistinctShop = $distinctShopRow['SHOP_TYPE'];
                                        echo "<option value='$currentDistinctShop'"; if (isset($_GET['category']) && $_GET['category'] == $currentDistinctShop){echo "selected";} echo ">$currentDistinctShop</option>";
                                    }
                                ?>  
                            </select>
                        </div>

                        <div class="box box2">
                            <span class="text-gray-small"> SORT BY </span><br>
                            <select name="sort" class="sidemenu-dropdown">
                                <option value="product_price" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'product_price'){echo "selected";} ?>>Price</option>
                                <option value="product_rating" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'product_rating'){echo "selected";} ?>>Rating</option>
                                <option value="product_name" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'product_name'){echo "selected";} ?>>Alphabetical</option>
                            </select>
                        </div>

                        <div class="box box3">
                            <span class="text-gray-small"> ORDER </span><br>
                            <select name="order" class="sidemenu-dropdown">
                                <option value="ASC" <?php if (isset($_GET['order']) && $_GET['order'] == 'ASC'){echo "selected";} ?>>Ascending</option>
                                <option value="DESC" <?php if (isset($_GET['order']) && $_GET['order'] == 'DESC'){echo "selected";} ?>>Descending</option>
                            </select>
                        </div>

                        <div class="box box4">
                            <span class="text-gray-small"> PRICE </span><br>
                            <input type="text" name="min-price" placeholder="min" value="<?php if(isset($_GET['min-price'])) {echo $_GET['min-price'];}?>"> 
                            to 
                            <input type="text" name="max-price" placeholder="max" value="<?php if(isset($_GET['max-price'])) {echo $_GET['max-price'];}?>">
                        </div>

                        <div class="box box5">
                            <span class="text-gray-small"> RATING </span><br>
                            <select name="rating" class="sidemenu-dropdown">
                                <option value="0" <?php if (isset($_GET['rating']) && $_GET['rating'] == '0'){echo "selected";} ?>>All</option>
                                <option value="1" <?php if (isset($_GET['rating']) && $_GET['rating'] == '1'){echo "selected";} ?>>1 stars +</option>
                                <option value="2" <?php if (isset($_GET['rating']) && $_GET['rating'] == '2'){echo "selected";} ?>>2 stars +</option>
                                <option value="3" <?php if (isset($_GET['rating']) && $_GET['rating'] == '3'){echo "selected";} ?>>3 stars +</option>
                                <option value="4" <?php if (isset($_GET['rating']) && $_GET['rating'] == '4'){echo "selected";} ?>>4 stars +</option>
                            </select>
                        </div>

                        <div class="box box6">
                            <input type="submit" name="product-search" value="Search" class="search w-all" style="margin-top: auto; background-color:rgb(129, 192, 34); color:white;">
                        </div>
                </div>
            </form>
            <!-- Side-menu container ends here -->

            
            
            <!-- Product container starts here -->
            <div class="product-container">

            <?php

                include '../reusable/connection.php';

                if(isset($_GET['searchQuery']) && !isset($_GET['product-search'])){
                    $homepageSearchQuery= filter_var($_GET['searchQuery'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $homepageSearchQuery=ucfirst(strtolower($homepageSearchQuery));
                    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$homepageSearchQuery%' AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N'";

                }


                //Checks if Category is selected from homepage and sidemenu button is not pressed yet.
                elseif(isset($_GET['category']) && !isset($_GET['product-search'])){
                    $categorySelected = $_GET['category'];
                    $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE S.SHOP_TYPE = '$categorySelected'  AND P.PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N'";
                }



                elseif(isset($_GET['product-search'])){

                    $category = $_GET['category'];
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $minPrice = $_GET['min-price'];
                    $maxPrice = $_GET['max-price'];
                    $rating = $_GET['rating'];
                    $searchText = filter_var($_GET['searchQuery'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $searchText=ucfirst(strtolower($searchText));
                    
                    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N'";

                    //EMPTY, EMPTY , EMPTY, EMPTY
                    if(empty($searchText) && empty($minPrice) && empty($maxPrice) && empty($category)){
                        $query = "SELECT * FROM PRODUCT P WHERE PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order ";
                    }

                    //EMPTY, EMPTY , EMPTY, NOT EMPTY
                    if(empty($searchText) && empty($minPrice) && empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' AND SHOP_TYPE= '$category' ORDER BY $sort $order ";
                    }

                    //EMPTY, EMPTY, NOT EMPTY, EMPTY
                    elseif(empty($searchText) && empty($minPrice) && !empty($maxPrice) && empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_PRICE BETWEEN 0 AND $maxPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    } 

                    //EMPTY, EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(empty($searchText) && empty($minPrice) && !empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = FK1_SHOP_ID WHERE PRODUCT_PRICE BETWEEN 0 AND $maxPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' AND SHOP_TYPE= '$category' ORDER BY $sort $order";
                    } 

                    //EMPTY, NOT EMPTY, EMPTY, EMPTY
                    elseif(empty($searchText) && !empty($minPrice) && empty($maxPrice) && empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_PRICE >= $minPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }

                    //EMPTY, NOT EMPTY, EMPTY, NOT EMPTY
                    elseif(empty($searchText) && !empty($minPrice) && empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_PRICE >= $minPrice AND SHOP_TYPE= '$category' AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }

                    //EMPTY, NOT EMPTY, NOT EMPTY, EMPTY
                    elseif(empty($searchText) && !empty($minPrice) && !empty($maxPrice) && empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_RATING >= $rating AND PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }

                    //EMPTY, NOT EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(empty($searchText) && !empty($minPrice) && !empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_RATING >= $rating AND SHOP_TYPE= '$category' AND PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }

                    //NOT EMPTY , EMPTY , EMPTY, EMPTY
                    elseif(!empty($searchText) && empty($minPrice) && empty($maxPrice) &&  empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_RATING >= $rating AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";  
                    }

                    //NOT EMPTY , EMPTY , EMPTY, NOT EMPTY
                    elseif(!empty($searchText) && empty($minPrice) && empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_RATING >= $rating AND SHOP_TYPE= '$category' AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";  
                    }

                    //NOT EMPTY, EMPTY, NOT EMPTY, EMPTY
                    elseif(!empty($searchText) && empty($minPrice) && !empty($maxPrice) && empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_PRICE BETWEEN 0 AND $maxPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                        
                    }

                    //NOT EMPTY, EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(!empty($searchText) && empty($minPrice) && !empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_NAME LIKE '%$searchText%' AND SHOP_TYPE= '$category' AND PRODUCT_PRICE BETWEEN 0 AND $maxPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                        
                    }

                    //NOT EMPTY, NOT EMPTY, EMPTY, EMPTY
                    elseif(!empty($searchText) && !empty($minPrice) && empty($maxPrice) && empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_PRICE >= $minPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }

                    //NOT EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(!empty($searchText) && !empty($minPrice) && empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_NAME LIKE '%$searchText%' AND SHOP_TYPE= '$category' AND PRODUCT_PRICE >= $minPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";                       
                    }

                    //NOT EMPTY, NOT EMPTY, NOT EMPTY, EMPTY
                    elseif(!empty($searchText) && !empty($minPrice) && !empty($maxPrice)  && empty($category)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }
                    //NOT EMPTY, NOT EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(!empty($searchText) && !empty($minPrice) && !empty($maxPrice) && !empty($category)){
                        $query = "SELECT * FROM PRODUCT P INNER JOIN SHOP S ON S.PK_SHOP_ID = P.FK1_SHOP_ID WHERE PRODUCT_NAME LIKE '%$searchText%' AND SHOP_TYPE= '$category' AND PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice AND PRODUCT_RATING >= $rating  AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N' ORDER BY $sort $order";
                    }
                                        
                }
                else{}

                

                $result = oci_parse($connection, $query);
                        if (!$result) 
                        {
                        $error = oci_error($connection);    
                        trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
                        }
                        $run = oci_execute($result); 
                        if(!$run) 
                        {    
                        $error = oci_error($result);
                            trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
                        }

                        $productCount = 0;

                        while($row = oci_fetch_array($result)){   
                            $productCount = $productCount + 1;
                            $i = 1; 
                            $rating = round($row['PRODUCT_RATING']);
                            echo "
                            <!-- INDIVIDUAL PRODUCT -->
                            
                                <div class='individual-card'>
                                    <a href='individualProduct.php?productID=$row[PK_PRODUCT_ID]'>
                                    <img class='card-top-img' src='../images/products/$row[PRODUCT_IMAGE]'>
                                    <div class='card-bottom'>";
                                        if($row['PRODUCT_QUANTITY'] ==0 )
                                                {echo "<p class='product-stock-fail'>NOT IN STOCK</p>";}
                                        else    {echo "<p class='product-stock-success'>IN STOCK</p>";}
                                        
                                        echo "<p>$row[PRODUCT_NAME]</p> </a>

                                        <div>"; 

                                        while($i <= 5){
                                            if( $i<=round($row['PRODUCT_RATING'])){
                                                echo "<span class='fa fa-star checked'></span>";
                                                $i = $i +1;
                                            }

                                            else{                                
                                            echo "<span class='fa fa-star unchecked'></span>";
                                                $i = $i +1;
                                            }
                                        }
                                        
                                        echo "</div>

                                        <h5>Rs $row[PRODUCT_PRICE]</h5>";
                                        if($row['PRODUCT_QUANTITY'] != 0) { echo "<a href='../cart/cart-work.php?productid=$row[PK_PRODUCT_ID]'> <input type='submit' value='Add To Cart' style='margin-top: auto; background-color:rgb(129, 192, 34); color:white;' class='submit'> </a>"; }
                                    echo "</div>
                                </div>  
                                ";

                        }

                        if($productCount == 0){
                            echo "<h3>No products found</h3>";
                        }
                        ?>

    
           

            </div><!-- Product container ends here -->

        </div> <!--Section container ends here-->



    </div>

    <div class="footer">
            <?php include '../reusable/footer_customer.php'; 
                unset($_SESSION['ProductLimitExceedMessage']);
                unset($_SESSION['cartLimitExceedMessage']);
            ?>
        </div>


<script>
   setTimeout(function(){
    document.getElementById('error-box').style.visibility = 'hidden'; 
    }, 8000);


</script>
    
</body>
</html>