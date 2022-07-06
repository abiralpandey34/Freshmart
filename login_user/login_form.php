<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <?php  
        include "../reusable/connection.php";
    ?>

    <!-- PHP to redirect to login -->

    <!-- logo image -->
    <a href="../customer/index.php"><img src="../images/finalogo.png" class="logoimage"></a>
    
    <!-- main container -->
            <div class="main row justify-content-center align-items-center my-5 mx-auto g-0">
                <!-- column for the slider -->
                <div class="col-lg-5 col-md-5">
                    <!-- slider starts -->
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block w-100" src="../images/login1.jpg" alt="First slide">
                          </div>
                          <div class="carousel-item ">
                            <img class="d-block w-100" src="../images/login2.jpg" alt="Second slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="../images/login3.jpg" alt="Third slide">
                          </div>
                        </div>
                    </div>
                    <!-- slider ends -->
                </div>
                <!-- column for the login conte -->
                <div class="col-lg-7 col-md-7 px-5 py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <h4>Sign into your account</h4>
                    </div>
                </div>
                <form method="POST" action="login.php">
                    <div class="form-group row justify-content-center">
                    
                        <input type="hidden" name="user_id" value="<?php echo $row['productID']; ?>"  required />
                        <div class="col-lg-7">
                        <input type="email"  placeholder="Email" name="user_email"  required />
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">    
                        <div class="col-lg-7">
                        <input type="password"   placeholder="Password" name="user_password"  required />
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-lg-7">
                        <?php 
                                if(!empty($_SESSION['loginErrorMessage'])){
                                    $message2 = $_SESSION['loginErrorMessage'];
                                    echo "<div id='error-box' style='color:red'>
                                    $message2
                                    </div>";
                                }   
                            ?>
                            <input type="submit" class="submit-btn mt-3 mb-5" value="Login" name="login">
                        </div>
                    </div>

                   
                    <div class="form-group row justify-content-center">
                        <div class="col-lg-7">
                        
                        <a href="forgot_password.php">Forgot Password</a>
                            <p>Don't have an account? <a href="../register_user/register_form_customer.php">Register here</a></p>
                        </div>
                    </div>
                </form>
                </div>
            </div>

            <?php unset($_SESSION['loginErrorMessage']); ?>


            

<!-- connecting to javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
</body>
</html>
