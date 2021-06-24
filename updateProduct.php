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
              aria-controls="Profile" aria-selected="true">Product Update</a>
          </li>
        </ul>

        <div class="tab-content">
          <!-- general form details -->
          <div role="tabpanel" class="tab-pane fade active show" id="general">
            <div class="row justify-content-center">
              <div class="col-md-8  d-flex flex-column bd-highlight pt-5">

                <?php 
                  $productQuery = "SELECT * FROM product WHERE product_id = 1";
                  $productQueryResult = mysqli_query($connection, $productQuery);

                  while($productRow = mysqli_fetch_assoc($productQueryResult)){

                    $name = $productRow['product_name'];
                    $price = $productRow['product_price'];
                    $description = $productRow['product_description'];
                    $allergy = $productRow['product_allergy'];
                    $stock = $productRow['product_stock'];

                  }
                ?>


                <form action=" ">
                    
                    <label for="Name">Product Name:</label>
                    <input type="text" class="form-control"  value="<?php echo (isset($name))?$name:'';?>" required>

                    <Label for="type">Product Type:</Label>
                    <select name="trader_type" class="form-control" required>

                      <option value="null" selected disabled>Trader Type</option>
                      <option value="Greengrocer"> Greengrocer </option>
                      <option value="Butcher"> Butcher </option>
                      <option value="Fishmonger"> Fishmonger </option>
                      <option value="Bakery"> Bakery </option>
                      <option value="Delicatessen"> Delicatessen </option>
                    </select><br>

                    <label for="Price">Price:</label>
                    <input type="number" class="form-control"  value="<?php echo (isset($price))?$price:'';?>" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control"  value="<?php echo (isset($stock))?$stock:'';?>" max=20 required>

                    <label for="quantity">Description:</label>
                    <input type="number" class="form-control"  value="<?php echo (isset($description))?$description:'';?>" max=20 required>

                    <label for="quantity">Allergy Information:</label>
                    <input type="number" class="form-control"  value="<?php echo (isset($allergy))?$allergy:'';?>" max=20 required>
  
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