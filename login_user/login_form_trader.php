<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trader Sign in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/trader_signin.css">
</head>

<body>
<?php  
        include "../reusable/connection.php";
    ?>
    <a href="../customer/index.php"><img src="../images/finalogo.png" class="logoimage"></a>

    <!-- main container -->
    <div class="main row justify-content-center align-items-center my-5 mx-auto g-0">
        <!-- column for the image -->
        <div class="col-lg-6 col-md-6">
            <img class="d-block w-100" src="../images/signin.png" alt="">
        </div>
        <!-- column for the login content -->
        <div class="col-lg-6 col-md-6 py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h4> Sign in as Trader </h4>
                </div>
            </div>
            <!-- form starts -->
            <form method="POST" action="login_trader.php">
                <div class="form-group row justify-content-center">

                    <input type="hidden" name="user_id" value="" required />
                    <div class="col-lg-8">
                        <input type="email" placeholder="Email" name="user_email" required />
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-lg-8">
                        <input type="password" placeholder="Password" name="user_password" required />
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-lg-8">
                    
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
                <div class="form-group row justify-content-center">
                    <div class="col-lg-8">

                        <a href="forgot_password.php">Forgot Password</a>
                        <p>Don't have an account? <a href="../register_user/register_form_trader.php"></br>Register as Trader</a></p>
                    </div>
                </div>
            </form>
            <!-- form ends -->
        </div>
        <!--login content ends-->
    </div>
    <!--main container ends-->
    <?php unset($_SESSION['loginErrorMessage']); ?>
    <!-- connecting to javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>

</html>