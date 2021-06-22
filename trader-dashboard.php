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

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <title> Freshmart</title>
</head>

<body>
  <?php 
      include 'reuseable/connection.php';
      include 'reuseable/errorReporting.php';
  ?>

  <section id="logo-serch-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12 col-lg-3">
          <div class="logo">
            <a href="index.php">
              <img src="images/logo.png" alt="logo" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="col-md-5 col-sm-12 col-lg-5">
          <form class="search">
            <div class="form-row">
              <div class="col">
                <input type="text" class="form-control" placeholder="Search for product">
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2">
          <div class="top-categories">
            <div class="dropdown">
              <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Categories
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
                  <a class="dropdown-item" href="#">Login</a>
                  <a class="dropdown-item" href="#">Sign up</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="products-details">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
              aria-controls="v-pills-home" aria-selected="true">Dashboard</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
              aria-controls="v-pills-profile" aria-selected="false">Orders</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
              aria-controls="v-pills-messages" aria-selected="false">Products</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
              aria-controls="v-pills-settings" aria-selected="false">Shop</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settingv" role="tab"
              aria-controls="v-pills-settingv" aria-selected="false">Reviews</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settingss" role="tab"
              aria-controls="v-pills-settings" aria-selected="false">Traders</a>

          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content" id="v-pills-tabContent">

            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <div class="p-details">
                <div class="card">
                  <div class="card-header">
                    Pending Order
                  </div>
                  <div class="card-body">
                    <li>Items-1</li>
                    <li>Items-2</li>
                    <li>Items-3</li>
                  </div>
                </div>
                <div class="views">
                  <span><a href="#">Views all</a></span>
                </div>
                <div class="sort-list">
                  <div class="row">
                    <div class="col-md-2">
                      <form class="srt">
                        <select id="inputState" class="form-control">
                          <option selected>Sort by</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                      </form>
                    </div>
                    <div class="col-md-10">
                      <form class="srt">
                        <input type="text" class="form-control" id="inputSearch4" placeholder="Search">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card" style="margin-top: 0;">
                  <div class="card-header">
                    Unseen Messages
                  </div>
                  <div class="card-body">
                    <li>Items-1</li>
                    <li>Items-2</li>
                    <li>Items-3</li>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="p-details">
                <div class="card">
                  <div class="card-header">
                    Pending Order
                  </div>
                  <div class="card-body">
                    <li>Items-1</li>
                    <li>Items-2</li>
                    <li>Items-3</li>
                  </div>
                </div>
                <div class="views">
                  <span><a href="#">Views all</a></span>
                </div>
                <div class="sort-list">
                  <div class="row">
                    <div class="col-md-2">
                      <form class="srt">
                        <select id="inputState" class="form-control">
                          <option selected>Sort by</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                      </form>
                    </div>
                    <div class="col-md-10">
                      <form class="srt">
                        <input type="text" class="form-control" id="inputSearch4" placeholder="Search">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card" style="margin-top: 0;">
                  <div class="card-header">
                    Order history
                  </div>
                  <div class="card-body">
                    <li>Items-1</li>
                    <li>Items-2</li>
                    <li>Items-3</li>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              <div class="p-list">
                <div class="card">
                  <div class="card-header" style="text-align: left;">
                    <div class="row">

                      <div class="col-md-6">
                        <h6>Products List</h6>
                      </div>
                      
                      <div class="col-md-6">
                        <form class="search">
                          <div class="form-row">
                            <div class="col">
                              <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-2">
                              <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>

                  
                  <!-- Product -->
                  <div class="card-body">

                    <table style="width:100%">
                      <tbody>
                        <tr>
                          <td><b>Name</b></td>
                          <td><b>Price</b></td>
                          <td><b>Rating</b></td>
                        </tr>

                    <?php

                      // Search Box is hard to implement because, searching reloades page and it goes back to dashboard-submenu 

                      $productByTraderQuery = "SELECT * FROM product p INNER JOIN shop s ON s.shop_id = p.shop_id WHERE p.shop_id=1";
      
                      $productByTraderResult = mysqli_query($connection, $productByTraderQuery);

                      $productByTraderResultCount = mysqli_num_rows($productByTraderResult);


                      if($productByTraderResultCount > 0){
                        while($shopRow = mysqli_fetch_assoc($productByTraderResult)){

                          echo "
                              <tr>
                                <td>$shopRow[product_name]</td>
                                <td>$shopRow[product_price]</td>
                                <td>$shopRow[product_rating]</td>
                                <td> <a href='editProduct.php?productID=$shopRow[product_id]'> EDIT </a> </td>

                              </tr>
                              ";
                        }

                        echo "</tbody>
                        </table>";
                      }

                      else{
                        echo "No products found.";
                      }

                      

                    ?>

                  </div>

                </div>
                <div class="views">
                  <span><a href="#" name="productListViewAll">View all</a></span>
                </div>
                <div class="product-img">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card">
                        <img src="images/p2.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                          <a href="#" class="btn btn-primary">Top</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card">
                        <img src="images/p3.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                          <a href="#" class="btn btn-primary">New</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card">
                        <img src="images/p1.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                          <a href="#" class="btn btn-primary">Popular</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="add-more">
                    <button type="button" class="btn btn-success" id="expander"><i class="fas fa-plus"></i></button>
                    <div id="ex-content">
                      <div class="card">
                        <div class="card-body" style="text-align: left;">
                          <div class="row">
                            <div class="col-md-6">
                              <h5><span>Product id:</span> Unkhown</h5>
                              <h5><span>Products name:</span> Unkhown</h5>
                              <h5><span>Type:</span> Unkhown</h5>
                              <h5><span>Images:</span> Unkhown</h5>
                              <h5><span>Quantity:</span> Unkhown</h5>
                            </div>
                            <div class="col-md-6">
                              <div class="edit">
                                <button type="button" class="btn btn-outline-success"
                                  style="color: #fff; padding-left: 60px; padding-right: 60px;">Edit</button>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="p-list">
                <div class="card">
                  <div class="card-header">
                    <h6>Shop Details (not required)</h6>
                  </div>
                  <div class="card-body">
                    <li>Items-1</li>
                    <li>Items-2</li>
                    <li>Items-3</li>
                  </div>
                </div>
                <div class="views">
                  <span><a href="#">Views all</a></span>
                </div>
                <div class="shop">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-8">
                          <?php 

                          $shopQuery = "SELECT s.shop_name, s.shop_address, s.no_of_staff, u.username FROM shop s INNER JOIN user u ON s.trader_id=u.user_id WHERE u.user_id=3;";
          
                          $shopResult = mysqli_query($connection, $shopQuery);
                          while($shopRow = mysqli_fetch_assoc($shopResult)){
                      

                            echo "
                              <h5><span>Shop name:</span> $shopRow[shop_name]</h5>
                              <h5><span>Shop A:</span> $shopRow[shop_name]</h5>
                              <h5><span>Contact no:</span> $shopRow[shop_address]</h5>
                              <h5><span>Shop owner:</span> $shopRow[username]</h5>
                              <h5><span>No. of staff:</span> $shopRow[no_of_staff]</h5>";
                          }

                          ?>

                        </div>
                        <div class="col-md-4">
                          <div class="shop-img">
                            <img src="images/p1.jpg" alt="img" class="img-fluid">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="v-pills-settingv" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="p-list">
                <div class="card">
                    
                    <!-- Table hasnt been created so, commenting this out. 

                    $commentQuery = "SELECT * FROM FEEDBACK WHERE user_id = 3;";

                    $commentResult = mysqli_query($connection, $commentQuery);
                    while($commentRow = mysqli_fetch_assoc($commentResult)){


                      echo "
                        <div class='card-body'>
                          <p>$commentRow[feedback_description]</p>
                        </div>
                        "
                    } -->

                    
                  <div class="card-body">
                    <p>code is generated but table hasnt  been created so, code is commented for now. </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="v-pills-settingss" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              <div class="p-list">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-8">
                        <?php 

                        // $query =  "SELECT * FROM user WHERE user_type = 'trader';";

                        $query = "SELECT u.username, u.password, u.user_type, s.shop_name FROM shop s INNER JOIN user u ON s.trader_id = u.user_id where u.username='ashik';";
                        // $shop_name = mysqli_query($connection, $query2);
                        // mysqli_close($connection);
                        

                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($result)){

                          echo "
                            <h5><span>Name:</span> $row[username]</h5>
                            <h5><span>Contact:</span> $row[username]</h5>
                            <h5><span>Address:</span> $row[username]</h5>
                            <h5><span>Email:</span> $row[password]</h5>
                            <h5><span>Shop:</span> $row[shop_name]</h5>";
                        }

                        ?>
                      </div>

                      <div class="col-md-4">
                        <div class="shop-img">
                          <img src="images/p1.jpg" alt="img" class="img-fluid">
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
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
            <li><a href="#">Edit my Information</a></li>
            <li><a href="#">My Cart</a></li>
            <li><a href="#">Order History</a></li>
          </div>
        </div>
        <div class="col-md-3">
          <div class="cover-f">
            <h4>ABOUT US</h4>
            <li><a href="#">Who are we?</a></li>
            <li><a href="#">Why us?</a></li>
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
            <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
            <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
            <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- js file -->

  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/internal.min.js"></script>

</body>

</html>