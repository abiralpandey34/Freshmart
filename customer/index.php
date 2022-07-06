<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../sass/main-2.css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Google fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <title> Freshmart</title>
</head>

<body>
  <div class="top-wrap">
    <div class="container">
      <a id="top"><i class="fas fa-angle-up"></i></a>
    </div>
  </div>

  <div class="header-main">
    <?php include '../reusable/new_customer_header.php'?>
  </div>

  <section id="categories-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-md-5 col-lg-3">
          <div class="dropdown">
            <button class="btn btn-success dropdown-togglee" type="button" id="dropdownMenu1" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bars"></i> Shop by Category
            </button>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="productSearchPage.php?category=meat">Meats and Egg</a>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="productSearchPage.php?category=bakery">Bakery Items</a>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="productSearchPage.php?category=fish">Sea Food</a>
              </li>

              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="productSearchPage.php?category=vegetables">Vegetables</a>
              </li>
            </ul>

          </div>
        </div>
        <div class="col-md-9 col-md-7 col-lg-9">
          <div class="ads owl-carousel owl-theme">
            <div class="item">
              <h4><a href="productSearchPage.php?category=">Sea food 10% off</a></h4>
            </div>
            <div class="item">
              <h4><a href="productSearchPage.php?category=">Food items 20% off</a></h4>
            </div>
            <div class="item">
              <h4><a href="productSearchPage.php?category=">Bakery items 30% off</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!------------------ PASTE HERE SLIDER IMAGES-------------->
  <section id="slider-hero-img">
    <div class="owl-slider">
      <div class="hero-img owl-carousel owl-theme">
        <div class="item">
          <img src="../images/s4.jpg" class="img-fluid" alt="slider">
        </div>
        <div class="item">
          <img src="../images/s1.jpg" class="img-fluid" alt="slider">
        </div>
        <div class="item">
          <img src="../images/s2.jpg" class="img-fluid" alt="slider">
        </div>
        <div class="item">
          <img src="../images/banner.png" class="img-fluid" alt="slider">
        </div>
        
      </div>
    </div>
  </section>

  <!------------------ END PASTE HERE SLIDER IMAGES-------------->

  <!-- START PRODUCT SERVICES -->
  <section id="product-services">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="icons">
              <img src="../images/truck.svg" alt="img" class="img-fluid">
            </div>
            <div class="card-body">
              <h5 class="card-title">Quality Assured</h5>
              <p class="card-text">Verified by Food Inspector</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="icons">
              <img src="../images/cabbages.svg" alt="img" class="img-fluid">
            </div>
            <div class="card-body">
              <h5 class="card-title">Always Fresh</h5>
              <p class="card-text">Product are sustainable</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="icons">
              <img src="../images/premium.svg" alt="img" class="img-fluid">
            </div>
            <div class="card-body">
              <h5 class="card-title">Superior Quality</h5>
              <p class="card-text">Quality Products</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="icons">
              <img src="../images/customer-service.svg" alt="img" class="img-fluid">
            </div>
            <div class="card-body">
              <h5 class="card-title">Support</h5>
              <p class="card-text">24/7 Support</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- END PRODUCT SERVICES -->
  <!-- <section id="our-products">
    <div class="container">
      <div class="owl-slider">
        <div class="products owl-carousel owl-theme">
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="../images/p1.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#"> <button type="button" class="btn btn-success">Order now</button></a>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="../images/p2.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#"> <button type="button" class="btn btn-success">Order now</button></a>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="../images/p3.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#"> <button type="button" class="btn btn-success">Order now</button></a>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="../images/p2.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#"> <button type="button" class="btn btn-success">Order now</button></a>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="../images/p3.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#"> <button type="button" class="btn btn-success">Order now</button></a>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="../images/p1.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#"> <button type="button" class="btn btn-success">Order now</button></a>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </section> -->

  <!-- PRODUCTS STARTS FROM HERE -->
  <br>

  <?php

    $distinctShopQuery = "SELECT DISTINCT SHOP_TYPE FROM SHOP WHERE SHOP_ACTIVE='Y'";
    $distinctShopResult = oci_parse($connection, $distinctShopQuery);
    oci_execute($distinctShopResult); 

    while ($distinctShopRow = oci_fetch_assoc($distinctShopResult)){

        $shopType = $distinctShopRow['SHOP_TYPE'];

        $productCountQuery = "SELECT COUNT(P.PK_PRODUCT_ID) FROM PRODUCT P INNER JOIN SHOP S ON p.fk1_shop_id = s.pk_shop_id WHERE shop_type='$shopType' AND PRODUCT_ACTIVE='Y' AND PRODUCT_DELETE='N'";
        $productCountResult = oci_parse($connection, $productCountQuery);
        oci_execute($productCountResult); 

        while ($productCountRow = oci_fetch_assoc($productCountResult)){
          $productCount = $productCountRow['COUNT(P.PK_PRODUCT_ID)'];
        }

        if($productCount>=1){
          echo "
          <section id='our-products' style='padding-top: 10px;'>
            <div class='container'>
              <h2>$shopType</h2>

              <div class='owl-slider'>
                <div class='productsp owl-carousel owl-theme'>";

      $shopFetchQuery = "SELECT s.shop_type, p.pk_product_id, p.product_name ,p.product_price , p.product_quantity ,p.product_active,p.product_rating,p.PRODUCT_IMAGE FROM SHOP S INNER JOIN PRODUCT P ON p.fk1_shop_id = s.pk_shop_id WHERE shop_type='$shopType'";
      $shopFetchResult = oci_parse($connection, $shopFetchQuery);
      oci_execute($shopFetchResult); 

      while ($shopFetchRow = oci_fetch_assoc($shopFetchResult)){        
                  echo "
                  <div class='item'>
                    <div class='card'>
                      <div class='sp-img'>
                        <img src='../images/products/".$shopFetchRow['PRODUCT_IMAGE']."' class='card-img-top' alt='img'>
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
        </section>";
        }

    }

   
  ?>


 
  <!-- SALE TIMMER---- -->
  <section id="sale-time">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
          <h5>Best price for you</h5>
          <h1 id="headline">Inauguration of Freshmart </h1>
          <p>On the occasion of our Freshmart startup, we are giving off huge discount on all of our products. </p>
          <h5>Freshmart</h5>
          <div id="countdown">
            <ul>
              <li><span id="days"></span>days</li>
              <li><span id="hours"></span>Hours</li>
              <li><span id="minutes"></span>Minutes</li>
              <li><span id="seconds"></span>Seconds</li>
            </ul>
          </div>
          <div id="content" class="emoji">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <form class="search" action="productSearchPage.php" method="GET" >

          <a href="productSearchPage.php?searchQuery="> <button type='button' class='btn btn-success'>View all</button></a>
          
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- SALE TIMMER END -->
  <!-- <section id="food-banner">
    <div class="container">
      <div class="buy-now">
        <button type="button" class="btn btn-success">Buy Now</button>
        <div class="img-banner">
          <img src="../images/banner.jpg" class="img-fluid" alt="img">
        </div>
      </div>
    </div>
  </section> -->
  <!-- TESTIMONIAL WRAPPER -->
  <section id="testimonial-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="testimonial-slider" class="owl-carousel">
            <div class="testimonial">
              <div class="pic">
                <img src="../images/img-1.jpg" alt="img">
              </div>
              <div class="testimonial-content">
                <p class="description">
                  The people are really nice to and all the products are really fresh. It is the best. Thanks Freshmart. 
                </p>
                <h3 class="testimonial-title">Luis Gutirrez</h3>
              </div>
            </div>
            <div class="testimonial">
              <div class="pic">
                <img src="../images/img-2.jpg" alt="img">
              </div>
              <div class="testimonial-content">
                <p class="description">
                  Wow ! They provide everything right here and the best part is, It is easy to shop and collect goods. Thanks freshmart Team. 
                </p>
                <h3 class="testimonial-title">Ben Dover</h3>
              </div>
            </div>
            <div class="testimonial">
              <div class="pic">
                <img src="../images/img-3.jpg" alt="img">
              </div>
              <div class="testimonial-content">
                <p class="description">
                Very inviting atmosphere where the beautiful patio with staffs that are warm and friendly and make you feel like family. 
                </p>
                <h3 class="testimonial-title">Joya Singh</h3>
              </div>
            </div>
            <div class="testimonial">
              <div class="pic">
                <img src="../images/img-4.jpg" alt="img">
              </div>
              <div class="testimonial-content">
                <p class="description">
                  Honestly this site is great! It was my best online shopping experience. Period.
                </p>
                <h3 class="testimonial-title">Micheal Oxmaul</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include '../reusable/footer_customer.php';?>

  <!-- js file -->
  <script src="../js/owl.carousel.min-1.js"></script>
  <script src="../js/main-1.js"></script>
  <script src="../js/popper.min-1.js"></script>
  <script src="../js/internal.min-1.js"></script>

</body>

</html>