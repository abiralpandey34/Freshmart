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
if(isset($_POST['register_trader'])){
    include 'registration_trader.php';
}
?> -->

     <img src="images/finalogo.png" class="logoimage" alt="">
            <div class="container">
                <div class="title">
                    Register as Trader
                </div>
            <!-- trader form starts -->
                <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="row justify-content-around align-item-center input-group">
                            <div class="col-xl-6 col-lg-5 col-md-6 d-flex flex-column bd-highlight">
                                <input type="text"   placeholder="Full Name" name="user_name" value="<?php if(isset($_POST['user_name'])){echo ($_POST['user_name']);}?>" required />
                                <input type="email"  placeholder="Email" name="user_email" value="<?php if(isset($_POST['user_email'])){echo ($_POST['user_email']);}?>" required />
                                <input type="email"  placeholder="Re-enter Email" name="user_email_check" value="<?php if(isset($_POST['user_email_check'])){echo ($_POST['user_email_check']);}?>" required />
                                <select name="trader_type" class="trader-type" required>
                                    <option value="null" selected disabled>Trader Type</option>
                                    <option value="Greengrocer" <?php if(isset($_POST['trader_type']) && $_POST['trader_type'] == 'Greengrocer'){echo "selected";}?> > Greengrocer </option>
                                    <option value="Butcher"<?php if(isset($_POST['trader_type']) && $_POST['trader_type'] == 'Butcher'){echo "selected";}?>> Butcher </option>
                                    <option value="Fishmonger"<?php if(isset($_POST['trader_type']) && $_POST['trader_type'] == 'Fishmonger'){echo "selected";}?>> Fishmonger </option>
                                    <option value="Bakery"<?php if(isset($_POST['trader_type']) && $_POST['trader_type'] == 'Bakery'){echo "selected";}?>> Bakery </option>
                                    <option value="Delicatessen"<?php if(isset($_POST['trader_type']) && $_POST['trader_type'] == 'Delicatessen'){echo "selected";}?>> Delicatessen </option>
                                </select>                         
                                <br/>
                                <div class="check-box">
                                    <input type="checkbox" required />
                                    <span>I agree to the terms and conditions</span>
                                </div>
                                <input type="submit" name="register_trader"  value="Register" />
                            </div>
                        </div>
                </form>
        </div>
    <script src="js/register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>