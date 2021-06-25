<?php 
        include 'reuseable/connection.php';

                    if(isset($_POST['save'])){

                      $name = filter_var( $_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $price = filter_var($_POST['price'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $description = filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $allergy = filter_var($_POST['allergy'],FILTER_SANITIZE_SPECIAL_CHARS);
                      $stock = filter_var($_POST['stock'],FILTER_SANITIZE_SPECIAL_CHARS);
  

                      $updateProductQuery = "UPDATE product SET product_name='$name', product_price=$price, product_description='$description', product_allergy='$allergy', product_stock = $stock WHERE product_id=1;";
                      $updateProductResult = mysqli_query($connection, $updateProductQuery);

                      if($updateProductResult){
                        header("Location:updateProduct.php");
                        }

                      else{
                        echo "Update wasn't successful. Try again";
                      }
                    }

                ?>
