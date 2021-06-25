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
                <form method='POST' action='updateProfileSuccess.php'>
                      <?php 

                      //This statement clears all cache so page doesnt resubmit form in case of reloading the page. 
                      header("Cache-Control: no cache");             


                      $profileQuery = "SELECT * FROM user WHERE user_id = 1";
                      $profileQueryResult = mysqli_query($connection, $profileQuery);

                      while($profileRow = mysqli_fetch_assoc($profileQueryResult)){

                        $full_name = filter_var($profileRow['user_fullname'],FILTER_SANITIZE_SPECIAL_CHARS);
                        $user_contact = filter_var($profileRow['user_phone_number'],FILTER_SANITIZE_SPECIAL_CHARS);
                        $user_address = filter_var($profileRow['user_address'],FILTER_SANITIZE_SPECIAL_CHARS);
                        $user_allergy = filter_var($profileRow['user_allergy_information'],FILTER_SANITIZE_SPECIAL_CHARS);
                      }
                      
                      ?>
                      <h4 class=""> Update Information </h4>

                      <label for="name">Full Name:</label>
                      <input name="fullname" type="name" class="form-control" value="<?php echo (isset($full_name))?$full_name:'';?>" required>

                      <label for="contact">Contact:</label>
                      <input name="contact" type="tel" class="form-control" value="<?php echo (isset($user_contact))?$user_contact:'';?>" required>

                      <label for="address">Address:</label>
                      <input name="address" type="text" class="form-control" value="<?php echo (isset($user_address))?$user_address:'';?>" required>

                      <label for="allergy-info">Allergy Information</label>
                      <input name="allergy" type="text" class="form-control" value="<?php echo (isset($user_allergy))?$user_allergy:'';?>">

                      <h4 class="heading"> Change Password </h4>

                      <label for="password">Old Password:</label>
                      <input name="old-pass" type="password" class="form-control">

                      <label for="password">New Password:</label>
                      <input name="new-pass" type="password" id="password" class="form-control">

                      <label for="password">Re-enter Password:</label>
                      <input name="re-pass" type="password" id="password" class="form-control"> <br>

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