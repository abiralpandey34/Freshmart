<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap -->
      <link rel="stylesheet" type="text/css" href="../css/internal.min.css">
      <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
      <link rel="stylesheet" type="text/css" href="../css/owl.theme.default.css">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="../sass/main.css">
      <link rel="stylesheet" type="text/css" href="../css/traderDashboard.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <!-- js -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <title> Freshmart</title>
   </head>
   <body>
      <?php 
         include '../reusable/connection.php';
         include '../reusable/errorReporting.php';
         
         if(empty($_SESSION['currentTraderId'])){
           echo 'You are not a trader.';
           header('Location: ../error-pages/notATraderError.php');
         }
         
         else{
           $currentTraderId = $_SESSION['currentTraderId'];
           include 'ordersInit.php';
         }
         ?>


<!-- start popup -->
<div class="edt-btn">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Add Products
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method='POST' enctype="multipart/form-data">
      <div class="modal-body">
     <div class="row">
       <div class="col-md-6">
          <div class="form-group">
            <label for="Product Name">Product Name</label>
            <input type="text"  class="form-control" id="exampleFormControlInput1"   placeholder="Product Name" name="productname" value="<?php if(isset($_POST['productname'])){echo ($_POST['productname']);}?>"   required>
          </div>
          <div class="form-group">
            <label for="Description">Product Description</label>
            <textarea name="productDescription" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php if(isset($_POST['productDescription'])){echo ($_POST['productDescription']);}   ?> </textarea>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput2">Stock Quantity</label>
                <input type="number" class="form-control" id="exampleFormControlInput2"  placeholder="Product Quantity" name="productquantity" value="<?php if(isset($_POST['productquantity'])){echo ($_POST['productquantity']);}?>"   required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput3">Price</label>
                <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="Product Price" name="productprice" value="<?php if(isset($_POST['productprice'])){echo ($_POST['productprice']);}?>"  required >
              </div>
            </div>
          </div>

       </div>
       <div class="col-md-6">
                 
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile"name="productimage" required />
            <label class="custom-file-label" for="customFile">Upload product image</label>
          </div>
        
      </div>
    </div>
    <div class="edt-btn">
      <input type="submit"class="btn btn-primary" name="save" value="Save">
      <input type="clear"class="btn btn-primary" name="discard" value="Discard">
    </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end popup -->
<?php
// Customer General Info
if (isset($_POST['save']))
{   
    $shop_id=$_GET['shopid'];
    $productname = filter_var($_POST['productname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $productDescription = filter_var($_POST['productDescription'], FILTER_SANITIZE_SPECIAL_CHARS);
    $productprice = filter_var($_POST['productprice'], FILTER_VALIDATE_FLOAT);
    $productquantity=filter_var($_POST['productquantity'], FILTER_VALIDATE_INT);
    $productactive='N';

    if (isset($_FILES['productimage']))
    { 
    
        echo"<pre>";
        print_r($_FILES['productimage']);
        echo"</pre>";
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
                echo 'Image Uploaded Sucessfully';
                $query = "INSERT INTO PRODUCT(PK_PRODUCT_ID,PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_QUANTITY,PRODUCT_ACTIVE,FK1_SHOP_ID,PRODUCT_DESCRIPTION,PRODUCT_IMAGE)
                VALUES(PK_PRODUCT_ID.NEXTVAL,'$productname',$productprice,$productquantity,'$productactive',$shop_id,'$productDescription','$new_img_name')";
               echo $query;
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

<!-- <img src="images/<?=$user_profile_img?>" alt="images/<?=$user_profile_img?>"/> -->
 
<?php
// Customer General Info

?>


      <!-- js file -->
      <script src="../js/owl.carousel.min.js"></script>
      <script src="../js/main.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/internal.min.js"></script>
   </body>
</html>