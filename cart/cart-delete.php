
<?php 
    include '../reusable/connection.php';

    $toDeleteProduct = $_GET['productID'];


    if(isset($_SESSION['user_id'])){

        //Current Cart
        $currentActiveCart = $_SESSION['currentActiveCart'];

        // Current User
        $currentActiveUser = $_SESSION['user_id'];


        //Deleting Products.
        $deleteProductQuery = "DELETE FROM PRODUCT_CART WHERE FK2_PRODUCT_ID = $toDeleteProduct AND FK1_CART_NO	= $currentActiveCart";
        $deleteProductResult=  oci_parse($connection,$deleteProductQuery); 
        oci_execute($deleteProductResult); 


        //Counting Total Products in current Cart after deleting.
        $quantityQuery = "SELECT SUM(ITEM_QUANTITY) FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart ";
        $quantityResult=  oci_parse($connection,$quantityQuery); 
        oci_execute($quantityResult); 

        while (($quantityRow = oci_fetch_assoc($quantityResult))) {
            $_SESSION['currentActiveCartSize'] = $quantityRow['SUM(ITEM_QUANTITY)'];
        }

    }
    
    else{


        for($i=0;$i<sizeof($_SESSION['guestCurrentCart']);$i++){
            foreach($_SESSION['guestCurrentCart'][$i] as $ProductId=>$ProductQuantity){
                if($ProductId==$toDeleteProduct){
                    array_splice($_SESSION['guestCurrentCart'],$i,1);
                }
            }
        }

    }



    

    header('Location: ' . $_SERVER['HTTP_REFERER']);


?>