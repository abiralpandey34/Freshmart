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
    <link rel="stylesheet" href="css/productSearchPage.css">
</head>

<body>

    <div class="navbar-container">
        <?php include 'reusable/new_customer_header.php'; ?>
    </div>

    <div class="container">
    
        <div class="section-container"> 

            <!-- Sidemenu-container starts here -->
            <form action="" method="GET">
                <div class="sidemenu-container">
                        <div class="box box0">
                            <h2>Product Filter</h2>
                        </div>

                        <div class="box box1 ">
                            <span class="text-gray-small"> SEARCH HERE </span><br>
                            <input type="text" name="searchQuery" placeholder="Search Query" class="w-all"> 
                        </div>

                        <div class="box box2">
                            <span class="text-gray-small"> SORT BY </span><br>
                            <select name="sort" class="sidemenu-dropdown">
                                <option value="product_price">Price</option>
                                <option value="product_rating">Rating</option>
                                <option value="product_name">Alphabetical</option>
                            </select>
                        </div>

                        <div class="box box3">
                            <span class="text-gray-small"> ORDER </span><br>
                            <select name="order" class="sidemenu-dropdown">
                                <option value="ASC">Ascending</option>
                                <option value="DESC">Descending</option>
                            </select>
                        </div>

                        <div class="box box4">
                            <span class="text-gray-small"> PRICE </span><br>
                            <input type="text" name="min-price" placeholder="min"> to <input type="text" name="max-price" placeholder="max">
                        </div>

                        <div class="box box5">
                            <span class="text-gray-small"> RATING </span><br>
                            <select name="rating" class="sidemenu-dropdown">
                                <option value="4">4 stars +</option>
                                <option value="3">3 stars +</option>
                                <option value="2">2 stars +</option>
                                <option value="1" selected>1 stars +</option>
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

                include 'reusable/connection.php';

                if(isset($_GET['searchQuery']) && !isset($_GET['product-search'])){
                    $homepageSearchQuery= filter_var($_GET['searchQuery'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $homepageSearchQuery=strtoupper($homepageSearchQuery);
                    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$homepageSearchQuery%'";
                }

                //Checks if Category is selected from homepage and sidemenu button is not pressed yet.
                elseif(isset($_GET['category']) && !isset($_GET['product-search'])){
                    $categorySelected = $_GET['category'];
                    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$categorySelected%'";
                }


                elseif(isset($_GET['product-search'])){
                    $sort = $_GET['sort'];
                    $order = $_GET['order'];
                    $minPrice = $_GET['min-price'];
                    $maxPrice = $_GET['max-price'];
                    $rating = $_GET['rating'];
                    $searchText = filter_var($_GET['searchQuery'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $searchText=strtoupper($searchText);
                    $query = "SELECT * FROM PRODUCT";
                                    
                    
                    //EMPTY, EMPTY , EMPTY
                    if(empty($searchText) && empty($minPrice) && empty($maxPrice) ){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_RATING >= $rating ORDER BY $sort $order";
                    }

                    //EMPTY, EMPTY, NOT EMPTY
                    elseif(empty($searchText) && empty($minPrice) && !empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_PRICE BETWEEN 0 AND $maxPrice AND PRODUCT_RATING >= $rating ORDER BY $sort $order";
                    }
                    //EMPTY, NOT EMPTY, EMPTY
                    elseif(empty($searchText) && !empty($minPrice) && empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_PRICE >= $minPrice AND PRODUCT_RATING >= $rating ORDER BY $sort $order";
                    }
                    //EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(empty($searchText) && !empty($minPrice) && !empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_RATING >= $rating AND PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice  ORDER BY $sort $order";
                    }
                    //NOT EMPTY , EMPTY , EMPTY
                    elseif(!empty($searchText) && empty($minPrice) && empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_RATING >= $rating ORDER BY $sort $order";
                        
                    }
                    //NOT EMPTY, EMPTY, NOT EMPTY
                    elseif(!empty($searchText) && empty($minPrice) && !empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_PRICE BETWEEN 0 AND $maxPrice AND PRODUCT_RATING >= $rating ORDER BY $sort $order";
                        
                    }

                    //NOT EMPTY, NOT EMPTY, EMPTY
                    elseif(!empty($searchText) && !empty($minPrice) && empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_PRICE >= $minPrice AND PRODUCT_RATING >= $rating ORDER BY $sort $order";
                        
                    }
                    //NOT EMPTY, NOT EMPTY, NOT EMPTY
                    elseif(!empty($searchText) && !empty($minPrice) && !empty($maxPrice)){
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' AND PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice AND PRODUCT_RATING >= $rating ORDER BY $sort $order";

                    }

                    
                }

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

                        while($row = oci_fetch_array($result)){   
                            $i = 1; 
                            $rating = round($row['PRODUCT_RATING']);
                            echo "
                            <!-- INDIVIDUAL PRODUCT -->
                            
                                <div class='individual-card'>
                                    <a href='individualProduct.php?productID=$row[PK_PRODUCT_ID]'>
                                    <img class='card-top-img' src='images/$row[PRODUCT_IMAGE]'>
                                    <div class='card-bottom'>
                                    
                                        <p>$row[PRODUCT_NAME]</p> </a>

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

                                        <h5>$row[PRODUCT_PRICE]</h5>
                                        <a href='cart/cart-work.php?productid=$row[PK_PRODUCT_ID]'> <input type='submit' value='Add To Cart' style='margin-top: auto; background-color:rgb(129, 192, 34); color:white;' class='submit'> </a>
                                    </div>
                                </div>  
                            
                            <!-- INDIVIDUAL PRODUCT END -->";

                        }
                        ?>

    
           

            </div><!-- Product container ends here -->

        </div> <!--Section container ends here-->



    </div>

    <div class="footer">
            <?php include 'reusable/footer_customer.php'; ?>
        </div>


<script>


</script>
    
</body>
</html>