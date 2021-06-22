<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <!-- <?php if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_email= $_POST['user_email'];
        $user_password= $_POST['user_password'];
            include "connection.php";
            $querySelect="SELECT * FROM USER where user_email ='$user_email' and user_password='$user_password'";
            echo $querySelect;
            $result=  mysqli_query($connection,$querySelect); 
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if($user_email==$row['user_email'] and $user_password==$row['user_password'] )
                {
                    $_SESSION['user_name']=$row['user_name'];
                    echo"<script> location.href='login.php'</script>";
                }
    
            }
            else{
                $error="Wrong Email or password";
                echo $error;
            } 
            
        }
            
    
    
    ?> -->
    <!-- logo image -->
    <img src="images/finalogo.png" class="logoimage">
    
    <!-- main container -->
            <div class="main row justify-content-center align-items-center my-5 mx-auto g-0">
                <!-- column for the slider -->
                <div class="col-lg-5 col-md-5">
                    <!-- slider starts -->
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block w-100" src="images/login1.jpg" alt="First slide">
                          </div>
                          <div class="carousel-item ">
                            <img class="d-block w-100" src="images/login2.jpg" alt="Second slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="images/login3.jpg" alt="Third slide">
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
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
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
                            <input type="submit" class="submit-btn mt-3 mb-5" value="Login" name="login">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-lg-7">
                        
                        <a href="forgot_password.php">Forgot Password</a>'
                            <p>Don't have an account? <a href="customer-registration.php">Register here</a></p>
                        </div>
                    </div>
                </form>
                </div>
            </div>

<!-- connecting to javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>    
</body>
</html>