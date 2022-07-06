<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../css/update.css">
</head>
<style>


#success-box {
  display: block;
  padding: 10px;
  border-radius: 5px;
  background-color: rgb(129, 192, 34);
  color: white;
  font-weight: 500;

}
.image-container{
    height:350px;
    width:350px;
    border-radius:50%;
    overflow:hidden;

  }

  .image-container img{
    height:100%;
    width:100%;
    object-fit:cover;
  }

  .cancel{
    display:inline-block;
    text-align:center;
    width:49%;
    padding:10px;
    border-radius:50px;
    border:none;
    background-color:#cc2121;
    font-weight:600;
    color:white;
  }

  input[type=file]{
    border: 1px solid #dedede;
    padding:10px;
    display:inline;
  }

  .upload-container{
    text-align:center;
    margin-top:10px;
  }
</style>

<?php

include '../reusable/connection.php';

if (isset($_POST['save']))
{   
  $productid = $_GET['productID'];

  $productname = filter_var($_POST['productname'], FILTER_SANITIZE_SPECIAL_CHARS);
  $productname =ucfirst(strtolower($productname));
  $productDescription = filter_var($_POST['productDescription'], FILTER_SANITIZE_SPECIAL_CHARS);
  $productprice = filter_var($_POST['productprice'], FILTER_VALIDATE_FLOAT);
  $productquantity=filter_var($_POST['productquantity'], FILTER_VALIDATE_INT);
  $productactive='N';

  // $_SESSION['productEditSuccessMessage'] = 'Updated Successfully';


              $query = "  UPDATE PRODUCT 
                          SET PRODUCT_NAME= '$productname', 
                          PRODUCT_PRICE ='$productprice', 
                          PRODUCT_QUANTITY='$productquantity',
                          PRODUCT_ACTIVE='$productactive', 
                          PRODUCT_DESCRIPTION='$productDescription' 
                          WHERE PK_PRODUCT_ID=$productid "; 

              $addproduct = oci_parse($connection, $query);
              oci_execute($addproduct); 

              header('Location:amendProduct.php');
              

}

?>       


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
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#health" role="tab" aria-controls="Product_update" aria-selected="true">Product Update</a>
          </li>
        </ul>
        
        <div class="tab-content">

        <?php 
          if(isset($_SESSION['productEditSuccessMessage'])){
            $message = $_SESSION['productEditSuccessMessage'];

            echo '<div id="success-box">';
            echo $message;
            echo '</div>';

            // unset($_SESSION['productEditSuccessMessage']);
          }
        ?>
           
          <!-- product- update- form -->
          <div role="tabpanel" class="tab-pane fade active show" id="health">
            <div class="row justify-content-center">
              <div class="col-md-7  d-flex flex-column bd-highlight pt-5">
              <?php 

                $productid=$_GET['productID'];

                $query="SELECT * FROM PRODUCT WHERE PK_PRODUCT_ID=$productid";
                $editproduct = oci_parse($connection, $query);
                oci_execute($editproduct); 
                while (($editproductRow = oci_fetch_assoc($editproduct))) {
                    echo'

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="Name">Product Name:</label>
                        <input type="text"   placeholder="Product Name" name="productname" value="'.$editproductRow['PRODUCT_NAME'] .'" class="form-control"   required/>  <br>

                        <label for="Product Description">Product Description:</label>
                        <textarea class="form-control"  name="productDescription" id="" cols="3" rows="5" required>';echo $editproductRow['PRODUCT_DESCRIPTION']; echo'</textarea><br>

                        <label for="Price">Price:</label>
                        <input class="form-control"  type="number"   placeholder="Product Price" name="productprice" value="'. $editproductRow['PRODUCT_PRICE'] .'"  required /> <br>

                        <label for="quantity">Quantity:</label>
                        <input class="form-control"  type="number"   placeholder="Product Quantity" name="productquantity" value="'.$editproductRow['PRODUCT_QUANTITY'].'""   required/>  <br>
                        
                        <input type="submit" name="save" value="Save">
                        <a href="trader-dashboard.php"><div class="cancel">Cancel</div></a>
                        </form>
                


              </div>
              <div class=" col-md-5  d-flex flex-column bd-highlight mb-3">
              <br>
              <!-- Product image -->
                <form action="uploadProductImage.php?productid='.$productid.'" method="POST" enctype="multipart/form-data">
                <div class="image-container"><img src="../images/products/'.$editproductRow['PRODUCT_IMAGE'].'" alt="'. $editproductRow['PRODUCT_IMAGE'] .'"></div>
                  <input type="file"    name="productimage" required/>  
                  <input type="submit" name="upload" value="Save">
                </form>
              </div>';}?>
          </div>  
      </div>
    </div>
    
  </div>
</div>




<script>
      setTimeout(function(){
      document.getElementById('success-box').style.visibility = 'hidden'; 
      document.getElementById('success-box').style.display = 'none';
      }, 8000);
   </script>


<!-- jQuery first, then Bootstrap JS. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
</body>
</html>




