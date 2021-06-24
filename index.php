<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="sass/main.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  
  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <title> Freshmart</title>
</head>

<body>

  <section id="logo-serch-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-12 col-lg-4">
          <div class="logo">
          <a href="index.php">
            <img src="images/logo.png" alt="logo" class="img-fluid">
          </a>
        </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-6">

          <!-- This form when submitted takes a user to productSearchPage.php -->
          <form class="search" method="GET" action="productSearchPage.php">
            <div class="form-row">
              <div class="col">
                <input type="text" name="product-name" class="form-control" placeholder="Search for product">
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>


        </div>
        <div class="col-md-2 col-sm-12 col-lg-2">
          <div class="user-cart-cover">
            <div class="user">
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-togglee" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="login.php">Login</a>
                  <a class="dropdown-item" href="customer-registration.php">Sign up</a>
                </div>
              </div>
            </div>
            <div class="cart">
              <span style="cursor: pointer;"> <i class="fas fa-shopping-cart my-cart-icon"></i>
              <div class="items">
                 <span class="badge badge-notify my-cart-badge"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
                <a class="dropdown-item" tabindex="-1" href="#">Meats and Eggs</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">Cake</a></li>
                  <li class="dropdown-item"><a href="#">Sweets</a></li>
                  <li class="dropdown-item"><a href="#">Jerry Hams</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">Bakery Items</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">Cake</a></li>
                  <li class="dropdown-item"><a href="#">Sweets</a></li>
                  <li class="dropdown-item"><a href="#">Jerry Hams</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">Sea Food</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">Cake</a></li>
                  <li class="dropdown-item"><a href="#">Sweets</a></li>
                  <li class="dropdown-item"><a href="#">Jerry Hams</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1" href="#">Vegetables</a>
                <ul class="dropdown-menu">
                  <li class="dropdown-item"><a tabindex="-1" href="#">Cake</a></li>
                  <li class="dropdown-item"><a href="#">Sweets</a></li>
                  <li class="dropdown-item"><a href="#">Jerry Hams</a></li>
                </ul>
              </li>
            </ul>

          </div>
        </div>
        <div class="col-md-9 col-md-7 col-lg-9">
          <div class="ads owl-carousel owl-theme">
            <div class="item">
              <h4><a href="#">Sea food 10% off</a></h4>
            </div>
            <div class="item">
              <h4><a href="#">Food items 20% off</a></h4>
            </div>
            <div class="item">
              <h4><a href="#">Bakery items 30% off</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="our-products">
    <div class="container">
      <div class="owl-slider">
        <div class="products owl-carousel owl-theme">
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="images/p1.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
              <a href="#">  <button type="button" class="btn btn-success">Shops</button></a>
            </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="images/p2.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#">  <button type="button" class="btn btn-success">Blogs</button></a>
            </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="images/p3.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#">  <button type="button" class="btn btn-success">Market</button></a>
            </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="images/p2.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#">  <button type="button" class="btn btn-success">Staff' pick</button></a>
            </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="images/p3.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#">  <button type="button" class="btn btn-success">New</button></a>
            </div>
            </div>
          </div>
          <div class="item">
            <div class="card">
              <div class="sp-img">
                <img src="images/p1.jpg" class="card-img-top" alt="img">
              </div>
              <div class="card-body">
                <a href="#">  <button type="button" class="btn btn-success">Types</button></a>
            </div>
            </div>
          </div>
          
         
        </div>
      </div>
    </div>
    </section>

    <section id="our-products" style="padding-top: 10px;">
      <div class="container">
        <h2>Meat and Eggs</h2>
        <div class="owl-slider">
          <div class="products owl-carousel owl-theme">
            <div class="item">
              <div class="card">
                <div class="sp-img">
                  <img src="images/egg1.jpg" class="card-img-top" alt="img">
                </div>
                <div class="card-body">
                 <span class="nm">Product-1</span>
                 <span><strong>Rs. 10/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
              </div>
              </div>
            </div>
            <div class="item">
              <div class="card">
                <div class="sp-img">
                  <img src="images/egg2.jpg" class="card-img-top" alt="img">
                </div>
                <div class="card-body">
                  <span class="nm">Product-2</span>
                  <span><strong>Rs. 15/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="2" data-name="product 2" data-summary="summary 2" data-price="15" data-quantity="1" data-image="images/egg2.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
              </div>
              </div>
            </div>
            <div class="item">
              <div class="card">
                <div class="sp-img">
                  <img src="images/meat1.jpg" class="card-img-top" alt="img">
                </div>
                <div class="card-body">
                  <span class="nm">Product-3</span>
                 <span><strong>Rs. 100/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="3" data-name="product 3" data-summary="summary 3" data-price="100" data-quantity="1" data-image="images/meat1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
              </div>
              </div>
            </div>
            <div class="item">
              <div class="card">
                <div class="sp-img">
                  <img src="images/meat2.jpg" class="card-img-top" alt="img">
                </div>
                <div class="card-body">
                  <span class="nm">Product-4</span>
                  <span><strong>Rs. 133/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="4" data-name="product 4" data-summary="summary 4" data-price="200" data-quantity="1" data-image="images/meat2.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
              </div>
              </div>
            </div>
            <div class="item">
              <div class="card">
                <div class="sp-img">
                  <img src="images/meat2.jpg" class="card-img-top" alt="img">
                </div>
                <div class="card-body">
                  <span class="nm">Product-5</span>
                  <span><strong>Rs. 1200/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="4" data-name="product 4" data-summary="summary 4" data-price="200" data-quantity="1" data-image="images/meat2.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
              </div>
              </div>
            </div>
          
           
          </div>
        </div>
        <div class="views-all">
        
          <!-- View all button 1 -->
          <form method="GET" action="productSearchPage.php">
            <button type="submit" name="category"  value="meat" class="btn btn-success" >View all</button>
          </form>

        </div>
      </div>
      </section>

      <section id="our-products" style="padding-top: 10px;">
        <div class="container">
          <h2>Green Veggies</h2>
          <div class="owl-slider">
            <div class="products owl-carousel owl-theme">
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg1.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                    <span><strong>Rs. 10/-</strong></span>
                    <br>
                    <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/p1.jpg">Add to Cart</button>
                    <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg2.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                    <span><strong>Rs. 500/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="2" data-name="product 2" data-summary="summary 2" data-price="15" data-quantity="1" data-image="images/p2.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg3.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                    <span><strong>Rs. 70/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg4.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                    <span><strong>Rs. 1120/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg1.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                 <span><strong>Rs. 300/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg2.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                 <span><strong>Rs. 58800/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
              <div class="item">
                <div class="card">
                  <div class="sp-img">
                    <img src="images/veg3.jpg" class="card-img-top" alt="img">
                  </div>
                  <div class="card-body">
                    <span class="nm">Product-1</span>
                 <span><strong>Rs. 800/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                </div>
                </div>
              </div>
            
             
            </div>
          </div>
          <div class="views-all">
            <form method="GET" action="productSearchPage.php">
              <button type="submit" name="category"  value="veggies" class="btn btn-success" >View all</button>
            </form>
          </div>
        </div>
        </section>

        <section id="our-products" style="padding-top: 10px;">
          <div class="container">
            <h2>Sea Foods</h2>
            <div class="owl-slider">
              <div class="products owl-carousel owl-theme">
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea1.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-1</span>
                 <span><strong>Rs. 120/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea2.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-6</span>
                 <span><strong>Rs. 800/-</strong></span>
                      <br>
                      <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                      <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea3.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-6</span>
                 <span><strong>Rs. 160/-</strong></span>
                      <br>
                      <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                      <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea4.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-1</span>
                 <span><strong>Rs. 900/-</strong></span>
                  <br>
                  <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                  <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea1.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-2</span>
                 <span><strong>Rs. 1300/-</strong></span>
                      <br>
                      <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                      <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea2.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-1</span>
                 <span><strong>Rs. 1500/-</strong></span>
                      <br>
                      <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                      <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea3.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-6</span>
                 <span><strong>Rs. 1800/-</strong></span>
                      <br>
                      <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                      <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="sp-img">
                      <img src="images/sea4.jpg" class="card-img-top" alt="img">
                    </div>
                    <div class="card-body">
                      <span class="nm">Product-3</span>
                 <span><strong>Rs. 1300/-</strong></span>
                      <br>
                      <button class="btn btn-danger my-cart-btn" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/egg1.jpg">Add to Cart</button>
                      <a href="#" class="btn btn-info">Details</a>
                  </div>
                  </div>
                </div>
                
               
              </div>
            </div>
            <div class="views-all">
              <form method="GET" action="productSearchPage.php">
                <button type="submit" name="category"  value="seafood" class="btn btn-success" >View all</button>
              </form>            
            </div>
          </div>
          </section>


          <section id="food-banner">
            <div class="container">
              <div class="buy-now">
                <button type="button" class="btn btn-success">Buy Now</button>
             <div class="img-banner">
               <img src="images/banner.jpg" class="img-fluid" alt="img">
             </div>
              </div>
            </div>
          </section>


          <section id="footer-wrapper">
            <div class="container">
              <div class="row">
                <div class="col-md-3">
                  <div class="cover-f">
                    <h4>MY ACCOUNT</h4>
                    <li><a href="updateProfile.php">Edit my Information</a></li>
                    <li><a href="#">My Cart</a></li>
                    <li><a href="#">Order History</a></li>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="cover-f">
                  	<h4>ABOUT US</h4>
                    <li><a href="#">Who are we?</a></li>
                    <li><a href="blog.html">Why us?</a></li>
                    <li><a href="#">Be a member</a></li>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="cover-f">
                  	<h4>CONTACT US</h4>
                    <li><i class="fa fa-phone"></i> <a href="tel:+9779849563456">(+977)9812345678</a></li>
                    <li><i class="fa fa-map-marker"></i> <a href="#">Thapathali, Kathmandu</a></li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:info@freshmart.com">info@freshmart.com</a></li>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="cover-f">
                  	<h4>SUPPORT US</h4>
                    <span><a href="#"><i class="fab fa-facebook"></i></a></span>
                    <span><a href="#"><i class="fab fa-instagram"></i></a></span>
                    <span><a href="#"><i class="fab fa-twitter"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </section>
  
  <!-- js file -->
  <script src="js/jquery-2.2.3.min.js"></script>
  <script type='text/javascript' src="js/bootstrap.min.js"></script>
  <script type='text/javascript' src="js/jquery.mycart.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/internal.min.js"></script>
  <script type="text/javascript">
    $(function () {
  
      var goToCartIcon = function($addTocartBtn){
        var $cartIcon = $(".my-cart-icon");
        var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
        $addTocartBtn.prepend($image);
        var position = $cartIcon.position();
        $image.animate({
          top: position.top,
          left: position.left
        }, 500 , "linear", function() {
          $image.remove();
        });
      }
  
      $('.my-cart-btn').myCart({
        currencySymbol: 'Rs',
        classCartIcon: 'my-cart-icon',
        classCartBadge: 'my-cart-badge',
        classProductQuantity: 'my-product-quantity',
        classProductRemove: 'my-product-remove',
        classCheckoutCart: 'my-cart-checkout',
        affixCartIcon: true,
        showCheckoutModal: true,
        numberOfDecimals: 2,
        // cartItems: [
        //   {id: 1, name: 'product 1', summary: 'summary 1', price: 10, quantity: 1, image: 'images/egg1.jpg'},
        //   {id: 2, name: 'product 2', summary: 'summary 2', price: 15, quantity: 2, image: 'images/egg2.jpg'},
        //   {id: 3, name: 'product 3', summary: 'summary 3', price: 100, quantity: 1, image: 'images/meat1.jpg'}
 
        // ],
        clickOnAddToCart: function($addTocart){
          goToCartIcon($addTocart);
        },
        afterAddOnCart: function(products, totalPrice, totalQuantity) {
          console.log("afterAddOnCart", products, totalPrice, totalQuantity);
        },
        clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
          console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
        },
        checkoutCart: function(products, totalPrice, totalQuantity) {
          var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
          checkoutString += "\n\n id \t name \t summary \t price \t quantity \t image path";
          $.each(products, function(){
            checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image);
          });
          alert(checkoutString)
          console.log("checking out", products, totalPrice, totalQuantity);
        },
        getDiscountPrice: function(products, totalPrice, totalQuantity) {
          console.log("calculating discount", products, totalPrice, totalQuantity);
          return totalPrice * 0.5;
        }
      });
  
      $("#addNewProduct").click(function(event) {
        var currentElementNo = $(".row").children().length + 1;
        $(".row").append('<div class="col-md-3 text-center"><img src="images/img_empty.png" width="150px" height="150px"><br>product ' + currentElementNo + ' - <strong>$' + currentElementNo + '</strong><br><button class="btn btn-danger my-cart-btn" data-id="' + currentElementNo + '" data-name="product ' + currentElementNo + '" data-summary="summary ' + currentElementNo + '" data-price="' + currentElementNo + '" data-quantity="1" data-image="images/img_empty.png">Add to Cart</button><a href="#" class="btn btn-info">Details</a></div>')
      });
    });
    </script>
</body>

</html>