<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>    
    <!-- <?php 
    if(isset($_POST['register_customer'])){
        
        include 'registration_customer.php';
    }
    
    
    ?> -->
    <img src="images/finalogo.png" class="logoimage" alt="">
    <div class="container">
        <div class="title">
            Register as Customer
        </div>
        <!-- customer form starts -->
        <form method="post" action="">
            <div class="row justify-content-around align-item-center input-group">
                <div class="col-xl-6 col-lg-5 col-md-6 d-flex flex-column bd-highlight">
                    <input type="text"   placeholder="Full Name" name="user_name"  required />
                    <input type="email"  placeholder="Email" name="user_email" required />
                    <input type="email"  placeholder="Re-enter Email" name="user_email_check"  required />
                    <input type="text"   placeholder="Password" name="user_password"  required />
                    <input type="text"   placeholder="Re-enter Password" name="user_password_check" required />
                    <br/>
                    <div class="check-box">
                        <input type="checkbox" required />
                        <span>I agree to the terms and conditions</span>
                    </div>
                    <input type="submit" name="register_customer"  value="Register" />
                    <p>Want to register as a trader instead? Click <a href="trader.php">here </a>
                </div>
            </div>
        </form> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>