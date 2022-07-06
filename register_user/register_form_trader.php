<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
</head>
<style>
    #error-box{
        color:white;
        background-color:#cc2121;
        font-weight:500;
        text-align:center;
        padding:10px;
    }
    #success-box{
        color:white;
        background-color:rgb(129,192,34);
        font-weight:500;
        text-align:center;
        padding:10px;
    }

</style>
<body>    

    <?php include 'registration_trader.php';?>

    <a href="../customer/index.php"><img src="../images/finalogo.png" class="logoimage" alt="Logo"></a>

     <div class="container">
     <div class="title">
            Register as a Trader
        </div>
                    <form method="post" action=" <?php htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
                        <div class="row justify-content-around align-item-center">
                            <div class="col-md-4  d-flex flex-column bd-highlight mb-3">
                                <input type="text"   placeholder="Full Name" name="user_name" value="<?php if(isset($_POST['user_name'])){echo ($_POST['user_name']);}?>" required />
                                
                                <input type="email"  placeholder="Email" name="user_email" value="<?php if(isset($_POST['user_email'])){echo ($_POST['user_email']);}?>" required />
                                <input type="email"  placeholder="Re-enter Email" name="user_email_check" value="<?php if(isset($_POST['user_email_check'])){echo ($_POST['user_email_check']);}?>" required />

                                <input type="password"   placeholder="Password" name="user_password"  required />
                                <input type="password"   placeholder="Re-enter Password" name="user_password_check" required />
                                
                                <label> Trader Type </label>
                                <select name="trader_type" style='padding:5px;' required>
                                    <option value="Greengrocer" > Greengrocer </option>
                                    <option value="Butcher" > Butcher </option>
                                    <option value="Fishmonger" > Fishmonger </option>
                                    <option value="Bakery" > Bakery </option>
                                    <option value="Delicatessen" > Delicatessen </option>
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