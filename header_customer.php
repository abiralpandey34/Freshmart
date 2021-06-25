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

            <!-- Search Bar Code  -->
            <form class="search" method="GET" action="./productSearchPage.php">
               <div class="form-row">
                  <div class="col">
                     <input type="text" name="navbar-search-query" class="form-control"  placeholder="Search for product">
                  </div>
                  <div class="col-2">
                     <button type="submit" class="btn btn-primary" ><i class="fas fa-search"></i></button>
                  </div>
               </div>
            </form>

         </div>
         <div class="col-md-2 col-sm-12 col-lg-2">
            <div class="user-cart-cover">
               <div class="user">
               <!-- Edit This Line -->
                        
                  <div class="dropdown">
                     <a class="btn btn-secondary dropdown-togglee" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="far fa-user"></i>
                     <?php 
                        if( !empty($_SESSION['user_name'])){
                          $arr = explode(' ',trim($_SESSION['user_name']));
                          echo'<p>'.$arr[0].'</p>';
                          }
                        else{
                          echo'<p> Login/Signup </p>';
                        }
                       ?>
                     </a>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php
                        
                        if( !empty($_SESSION['user_name'])){
                          echo'<a class="dropdown-item" href="#">Profile</a>';
                          echo'<a class="dropdown-item" href="./login_user/logout.php">Logout</a>';
                        }
                        else{
                          echo '<a class="dropdown-item" href="./login_user/login_form.php">Login</a>
                          <a class="dropdown-item" href="./register_user/register_form_customer.php">Sign up</a>';
                        }

                        ?>
                      
                        
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