<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/update.css">
</head>

<?php 
  include 'reuseable/connection.php';
  include 'reuseable/errorReporting.php';?>

<body>
  <div class="container">
    <!-- create new row -->
    <div class="row">
      <!-- first column starts -->
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <br>
        <!-- navigation tab starts -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#general" role="tab"
              aria-controls="Profile" aria-selected="true">Profile</a>
          </li>
        </ul>

        <div class="tab-content">
          <!-- general form details -->
          <div role="tabpanel" class="tab-pane fade active show" id="general">
            <div class="row justify-content-center">
              <div class="col-md-8  d-flex flex-column bd-highlight pt-5">
                <form>
                      <?php 

                      $profileQuery = "SELECT * FROM user WHERE user_id = 1";
                      $profileQueryResult = mysqli_query($connection, $profileQuery);

                      while($profileRow = mysqli_fetch_assoc($profileQueryResult)){

                        $fullname = $profileRow['user_fullname'];
                        $contact = $profileRow['user_phone_number'];
                        $address = $profileRow['user_address'];
                        $allergy = $profileRow['user_allergy_information'];

                      }
                      ?>
                      <h4 class=""> Update Information </h4>

                      <label for="name">Full Name:</label>
                      <input type="name" class="form-control" value="<?php echo (isset($fullname))?$fullname:'';?>" required>

                      <label for="contact">Contact:</label>
                      <input type="tel" class="form-control" value="<?php echo (isset($contact))?$contact:'';?>" required>

                      <label for="address">Address:</label>
                      <input type="text" class="form-control" value="<?php echo (isset($address))?$address:'';?>" required>

                      <label for="address">Allergy Information</label>
                      <input type="text" class="form-control" value="<?php echo (isset($allergy))?$allergy:'';?>">

                      <h4 class="heading"> Change Password </h4>

                      <label for="password">Old Password:</label>
                      <input type="password" class="form-control" required>

                      <label for="password">New Password:</label>
                      <input type="password" id="password" class="form-control" required>

                      <label for="password">Re-enter Password:</label>
                      <input type="password" id="password" value ="" class="form-control" required> <br>

                      <input type="submit" name="save" value="Save">
                      <input type="submit" name="discard" value="Discard">
                </form>
              </div>
              <div class=" col-md-4  d-flex flex-column bd-highlight mb-3">
                <img src="images/veg2.jpg" alt="...">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</body>

</html>