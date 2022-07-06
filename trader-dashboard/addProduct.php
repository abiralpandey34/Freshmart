<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../sass/main-2.css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- Google fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- js -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <title> Freshmart</title>
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

<body>

<header> 
    <?php 
    
    include '../reusable/new_customer_header.php'; 
    include '../reusable/errorReporting.php';
    ?>
</header>

<?php
// Customer General Info
if (isset($_POST['save']))
{   
    $shop_id=$_GET['shopID'];
    $productname = filter_var($_POST['productname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $productname =ucfirst(strtolower($productname));
    $productDescription = filter_var($_POST['productDescription'], FILTER_SANITIZE_SPECIAL_CHARS);
    $productprice = filter_var($_POST['productprice'], FILTER_VALIDATE_FLOAT);
    $productquantity=filter_var($_POST['productquantity'], FILTER_VALIDATE_INT);
    $productactive='N';

    $success = 'Product Added Successfully';
    
    if (isset($_FILES['productimage']))
    { 

        $img_name =$_FILES['productimage']['name'];
        $img_size =$_FILES['productimage']['size'];
        $tmp_name =$_FILES['productimage']['tmp_name'];
        $em    =$_FILES['productimage']['error'];
    
    
     if($em === 0){
        if($img_size > 1250000){
            $error = "Sorry, your file is too large.";
        }
        else{
            $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            if(in_array($img_ex_lc,$allowed_exs)){
                $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = '../images/products/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $query = "INSERT INTO PRODUCT(PK_PRODUCT_ID,PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_QUANTITY,PRODUCT_ACTIVE,FK1_SHOP_ID,PRODUCT_DESCRIPTION,PRODUCT_IMAGE,PRODUCT_RATING, PRODUCT_DELETE)
                VALUES(PK_PRODUCT_ID.NEXTVAL,'$productname',$productprice,$productquantity,'$productactive',$shop_id,'$productDescription','$new_img_name',0,'N')";
                $addproduct = oci_parse($connection, $query);
                 oci_execute($addproduct); 
            }
            else{
                $error = "You cannot upload this type of file";
            }
        }
    }
    }

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
          if(!empty($success)){
            $message = $success;

            echo '<div id="success-box">';
            echo $message;
            echo '</div>';
          }
        ?>
           
          <!-- product- update- form -->
          <div role="tabpanel" class="tab-pane fade active show" id="health">
            <div class="row justify-content-center">
              <div class="col-md-7  d-flex flex-column bd-highlight pt-5">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="Name">Product Name:</label>
                        <input type="text"   placeholder="Product Name" name="productname" value="" class="form-control"   required/>  <br>

                        <label for="Product Description">Product Description:</label>
                        <textarea class="form-control"  name="productDescription" id="" cols="3" rows="5" required></textarea><br>

                        <label for="Price">Price:</label>
                        <input class="form-control"  type="number"   placeholder="Product Price" name="productprice" value=""  required /> <br>

                        <label for="quantity">Quantity:</label>
                        <input class="form-control"  type="number"   placeholder="Product Quantity" name="productquantity" value=""  required/>  <br>
                        
                        <label for="quantity">Image:</label><br>
                        <input type="file"    name="productimage" required/>  <br><br>
                        
                        <input type="submit" name="save" class='btn btn-primary' style='background-color:rgb(129, 192, 34); width:50%; border-radius:30px; padding:10px 10px; border:none;' value="Save">
                        <a href="trader-dashboard.php"><div class="cancel">Cancel</div></a>
                        </form>
                


              </div>
              <div class=" col-md-5  d-flex flex-column bd-highlight mb-3">
              <br>
              <!-- Product image
                <form action="" method="POST" enctype="multipart/form-data">
                  <input type="file"    name="productimage" required/>  
                  <input type="submit" name="upload" value="Save">
                </form> -->
              </div>
          </div>  
      </div>
    </div>
    
  </div>
</div>



  <!-- js file -->
  <script src="../js/owl.carousel.min-1.js"></script>
  <!-- <script src="../js/main-1.js"></script> -->
  <script src="../js/popper.min-1.js"></script>
  <script src="../js/internal.min-1.js"></script>


<script>
      setTimeout(function(){
      document.getElementById('success-box').style.visibility = 'hidden'; 
      document.getElementById('success-box').style.display = 'none';
      }, 8000);
   </script>



</body>
</html>

