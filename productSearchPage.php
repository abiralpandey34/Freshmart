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


    <div class="container">

        <div class="section-container"> 

            <!-- Sidemenu-container starts here -->
            <form action="" method="POST">
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
                                <option value="PRODUCT_PRICE">Price</option>
                                <option value="PRODUCT_RATING">Rating</option>
                                <option value="PRODUCT_NAME">Alphabetical</option>
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

                    $query = "SELECT * FROM PRODUCT;";


                    //Checks if searchQuery is pressed from homepage and sidemenu button is not pressed yet.
                    if(isset($_GET['navbar-search-query']) && !isset($_POST['product-search'])){
                        $homepageSearchQuery = $_GET['navbar-search-query'];
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$homepageSearchQuery%';";
                    }

                    //Checks if Category is selected from homepage and sidemenu button is not pressed yet.
                    elseif(isset($_GET['category']) && !isset($_POST['product-search'])){
                        $categorySelected = $_GET['category'];
                        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$categorySelected%';";
                    }

                    //Checks if sidemenu button is pressed.
                    elseif(isset($_POST['product-search'])){

                        $searchText = $_POST['searchQuery'];
                        $sort = $_POST['sort'];
                        $order = $_POST['order'];
                        $minPrice = $_POST['min-price'];
                        $maxPrice = $_POST['max-price'];
                        $rating = $_POST['rating'];

                        $searchText = filter_var(trim($searchText), FILTER_SANITIZE_SPECIAL_CHARS);

                        $query = "SELECT * FROM PRODUCT";
                        
                        //EMPTY, EMPTY , EMPTY
                        if(empty($searchText) && empty($minPrice) && empty($maxPrice) ){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }

                        //EMPTY, EMPTY, NOT EMPTY
                        elseif(empty($searchText) && empty($minPrice) && !empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_PRICE BETWEEN 0 AND $maxPrice && PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }

                        //EMPTY, NOT EMPTY, EMPTY
                        elseif(empty($searchText) && !empty($minPrice) && empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_PRICE >= $minPrice && PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }

                        //EMPTY, NOT EMPTY, NOT EMPTY
                        elseif(empty($searchText) && !empty($minPrice) && !empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_RATING >= $rating && PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice  ORDER BY $sort $order;";
                        }

                        //NOT EMPTY , EMPTY , EMPTY
                        elseif(!empty($searchText) && empty($minPrice) && empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' && PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }
                        
                        //NOT EMPTY, EMPTY, NOT EMPTY
                        elseif(!empty($searchText) && empty($minPrice) && !empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' && PRODUCT_PRICE BETWEEN 0 AND $maxPrice && PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }

                        //NOT EMPTY, NOT EMPTY, EMPTY
                        elseif(!empty($searchText) && !empty($minPrice) && empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' && PRODUCT_PRICE >= $minPrice && PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }

                        //NOT EMPTY, NOT EMPTY, NOT EMPTY
                        elseif(!empty($searchText) && !empty($minPrice) && !empty($maxPrice)){
                            $query = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%$searchText%' && PRODUCT_PRICE BETWEEN $minPrice AND $maxPrice && PRODUCT_RATING >= $rating ORDER BY $sort $order;";
                        }

                        else{
                           echo 'Something error occured. Please try again.';
                        }
                    }
                    
                    else{
                        
                    }

                    
                    echo $query;
                    $result = oci_parse($connection, $query);
                    $result = oci_execute($result); 

                    if($result){
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
                                    <input type='submit' value='Add To Cart' style='margin-top: auto; background-color:rgb(129, 192, 34); color:white;' class='submit'>
                                </div>
                            </div>  
                            
                            <!-- INDIVIDUAL PRODUCT END -->";

                        }
                    }

                    else{
                        echo "Unable to find any products.";
                    }
                    
                ?>
           

            </div><!-- Product container ends here -->

        </div> <!--Section container ends here-->

    </div>


<script>


</script>
    
</body>
</html>