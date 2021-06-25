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

                    $product_name = $productRow['product_name'];
                    $product_price = $productRow['product_price'];
                    $product_description = $productRow['product_description'];
                    $product_allergy = $productRow['product_allergy'];
                    $product_stock = $productRow['product_stock'];

                  }
                ?>


                <form action="updateProductSuccess.php" method="POST">
                    
                    <label for="Name">Product Name:</label>
                    <input name="name" type="text" class="form-control"  value="<?php echo (isset($product_name))?$product_name:'';?>" max=30 required>

                    <Label for="type">Product Category:</Label>
                    <select name="product-type" class="form-control" required>

                      <option value="null" selected disabled>-</option>
                      <option value="Greengrocer"> Greengrocer </option>
                      <option value="Butcher"> Butcher </option>
                      <option value="Fishmonger"> Fishmonger </option>
                      <option value="Bakery"> Bakery </option>
                      <option value="Delicatessen"> Delicatessen </option>
                    </select><br>

                    <label for="Price">Price:</label>
                    <input name="price" type="number" class="form-control"  value="<?php echo (isset($product_price))?$product_price:'';?>" required>

                    <label for="quantity">Product Stock:</label>
                    <input name="stock" type="number" class="form-control"  value="<?php echo (isset($product_stock))?$product_stock:'';?>" required>

                    <label for="description">Description:</label>
                    <input name="description" type="text" class="form-control"  value="<?php echo (isset($product_description))?$product_description:'';?>" max=150 required>

                    <label for="allergy">Allergy Information:</label>
                    <input name="allergy" type="text" class="form-control"  value="<?php echo (isset($product_allergy))?$product_allergy:'';?>" max=30>
  
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