<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="sass/main.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  <title> Freshmart</title>
</head>

<body>

  <section id="logo-serch-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12 col-lg-3">
          <div class="logo">
            <a href="index.html">
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
          <div class="user-cart-cover2">
            <div class="user-dbord">
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="far fa-envelope"></i>
                </a>
              </div>
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cog"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Account Setting</a>
                </div>
              </div>
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

  <section id="dashboard-wrapper">
    <div class="container">
      <div class="dashboard-cover">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dashboard</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Traders</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="dh-details">
             <div class="row">
               <div class="col-md-2">
                <form>
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option selected disabled>Sort by</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                  </select>
                </form>
               </div>
             </div>
             <div class="card">
              <div class="card-header">
              New Messages
              </div>
              <div class="card-body">
               <li>Items 1</li>
               <li>Items 2</li>
               <li>Items 3</li>
               <li>Items 4</li>
               <li>Items 5</li>
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
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="dh-details">
              <div class="row">
                <div class="col-md-2">
                 <form>
                   <select class="form-control" id="exampleFormControlSelect1">
                     <option selected disabled>Sort by</option>
                     <option>1</option>
                     <option>2</option>
                     <option>3</option>
                     <option>4</option>
                   </select>
                 </form>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-4">
                  <form>
                    <input class="form-control" type="text" placeholder="Search...">
                  </form>
                 </div>
              </div>
              <div class="card">
               <div class="card-header">
               Traders List
               </div>
               <div class="card-body">
                <li>Items 1</li>
                <li>Items 2</li>
                <li>Items 3</li>
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
             <div class="d-products">
               <div class="row">
                 <div class="col-md-3 col-md-6 col-lg-3">
                  <div class="card">
                    <img src="images/p2.jpg" class="card-img-top" alt="img">
                    <div class="card-body">
                      <a href="#" class="btn btn-primary">Top</a>
                    </div>
                  </div>
                 </div>
                 <div class="col-md-3 col-md-6 col-lg-3">
                  <div class="card">
                    <img src="images/p1.jpg" class="card-img-top" alt="img">
                    <div class="card-body">
                      <a href="#" class="btn btn-primary">Top</a>
                    </div>
                  </div>
                 </div>
                 <div class="col-md-3 col-md-6 col-lg-3">
                  <div class="card">
                    <img src="images/p3.jpg" class="card-img-top" alt="img">
                    <div class="card-body">
                      <a href="#" class="btn btn-primary">Top</a>
                    </div>
                  </div>
                 </div>
                 <div class="col-md-3 col-md-6 col-lg-3">
                  <div class="card">
                    <img src="images/p2.jpg" class="card-img-top" alt="img">
                    <div class="card-body">
                      <a href="#" class="btn btn-primary">Top</a>
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