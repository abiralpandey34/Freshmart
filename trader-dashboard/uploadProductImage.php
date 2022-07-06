<?php
include "../reusable/connection.php" ;
include '../reusable/errorReporting.php';
 
if(isset($_POST['upload']) && isset($_FILES['productimage'])){
    $productid=$_GET['productid'];
    echo $productid;
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
            header("Location: editProduct.php?error=$error");
        }
        else{

            $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            if(in_array($img_ex_lc,$allowed_exs)){
                $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path = '../images/products/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                echo $new_img_name;
                $sql="UPDATE  PRODUCT SET PRODUCT_IMAGE='$new_img_name' WHERE  PK_PRODUCT_ID=$productid";
                echo $sql;
                $updateProfilePic = oci_parse($connection, $sql);
                if (!$updateProfilePic) 
              {
                  $error = oci_error($connection);    
                  trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
              }
              $run = oci_execute($updateProfilePic); 
              if(!$run) 
              {    
                  $error = oci_error($updateProfilePic);
                  trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
              }
            header("Location: editProduct.php?productID=$productid");
            }
            else{
                $error = "You cannot upload this type of file";
                header("Location: editProduct.php?error=$error");

            }

        }
}
else{
    $error = "Unknown error occoured!";
    header("Location: editProduct.php?error=$error");
}
}
else{
    $error = "No files Uploaded";
    header("Location: updateProfileTrader.php?error=$error");
}
?>
