<?php include '../reusable/errorReporting.php'?>


<?php 

    include '../reusable/connection.php';

    // Retrieving Product_ID from ProductSearchPage.php 
    $newAddProduct = $_GET['productid'];
    $newAddQuantity = 1;

    // Retrieving Product_ID and Quantity from individualProductPage.php 
    if(isset($_POST['submit'])){
        $newAddProduct = $_POST['productid'];
        $newAddQuantity = $_POST['quantity'];
    }

    //JUst in case we have to change cart limit later on.
    $cartLimit = 30;

 
    // If User logged in.
    if(isset($_SESSION['user_id'])){

        $currentUserID = $_SESSION['user_id'];

        // //Query to count any current Cart for currentUser.
        // $cartInfoQuery="SELECT COUNT(PK_CART_NO) FROM CART where FK1_USER_ID = $currentUserID AND IS_ACTIVE='Y'";
        // $cartInfoResult=  oci_parse($connection,$cartInfoQuery); 
        // $cartInfoRun = oci_execute($cartInfoResult); 

        // while (($cartInfoRow = oci_fetch_assoc($cartInfoResult))) {
        //     $cartFoundCount = $cartInfoRow['COUNT(PK_CART_NO)'];
        // }

        if(empty($_SESSION['currentActiveCart'])){

            // Generating a new cart for the user, since we didn't found any active cart.
            $createCartQuery="INSERT INTO CART(PK_CART_NO,FK1_USER_ID,IS_ACTIVE) VALUES (CART_ID_SEQ.NEXTVAL, $currentUserID, 'Y')";

            // connect to OCI and checks if any error during parse or execution of SQL
            $createCartResult=  oci_parse($connection,$createCartQuery); 
            oci_execute($createCartResult); 

            // Fetching cart_ID to store it in a session variable.
            $retrieveCartQuery="SELECT PK_CART_NO FROM CART WHERE FK1_USER_ID = $currentUserID AND IS_ACTIVE = 'Y'";
            $retrieveCartResult=  oci_parse($connection,$retrieveCartQuery); 
            oci_execute($retrieveCartResult); 

            while (($retrieveCartRow = oci_fetch_assoc($retrieveCartResult))) {
                $_SESSION['currentActiveCart'] = $retrieveCartRow['PK_CART_NO'];
            }

            //Since cart is recently created. Cart size is going to be zero.
            $_SESSION['currentActiveCartSize'] = 0; 
        }

        $currentActiveCart = $_SESSION['currentActiveCart'];

        //Counting Total Products in current Cart
        $quantityQuery = "SELECT SUM(ITEM_QUANTITY) FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart ";
        $quantityResult=  oci_parse($connection,$quantityQuery); 
        oci_execute($quantityResult); 

        while (($quantityRow = oci_fetch_assoc($quantityResult))) {
            $oldProductCount = $quantityRow['SUM(ITEM_QUANTITY)'];
        }

        $wouldBeTotalQuantity = $oldProductCount+ $newAddQuantity;

        if($wouldBeTotalQuantity <= $cartLimit){

            // Now lets check if the current Product user is trying to insert is already in cart or not. 
            $currentProductPresentQuery = "SELECT ITEM_QUANTITY FROM PRODUCT_CART WHERE FK2_PRODUCT_ID = $newAddProduct AND FK1_CART_NO = $currentActiveCart";
            $currentProductPresentResult=  oci_parse($connection,$currentProductPresentQuery); 
            oci_execute($currentProductPresentResult); 

            while (($currentProductPresentRow = oci_fetch_assoc($currentProductPresentResult))) {
                $currentProductPresentCount = $currentProductPresentRow['ITEM_QUANTITY'];
            }

            // Just in case if there are exactly 20 products, [ 20+ more condition is added to find out about errors]
            if($currentProductPresentCount >= 20){
                $_SESSION['ProductLimitExceedMessage'] = 'You cannot add more than 20 of the same product.';
            }

             // When the current Product was found in a cart
            elseif($currentProductPresentCount > 0) {

                echo 'There are '.$currentProductPresentCount.' products found of '.$newAddProduct;

                // New total would be quantity is calculated first,
                $newProductCount = $currentProductPresentCount+ $newAddQuantity;

                echo '<br><br>This will be new product count '. $newProductCount;

                // and if, total quantity would be more less than 20, then we add those products to database. 
                if($newProductCount <= 20){
                    $updateQuantityQuery = "UPDATE PRODUCT_CART SET ITEM_QUANTITY = $newProductCount WHERE FK1_CART_NO = $currentActiveCart AND FK2_PRODUCT_ID = $newAddProduct";
                    $updateQuantityResult=  oci_parse($connection,$updateQuantityQuery); 
                    oci_execute($updateQuantityResult); 

                    $_SESSION['currentActiveCartSize'] = $wouldBeTotalQuantity;
                    $_SESSION['ProductLimitExceedMessage'] = '';
                }

                // In case when add new quantity will exceed the 20 item of same product limit. 
                else{
                    $_SESSION['ProductLimitExceedMessage'] = 'You cannot add more than 20 of the same product.';
                }

            }

            //Else condition when the current Product as not found in a cart. And INSERT statement is used. 
            else{
            $addQuantityQuery = "INSERT INTO PRODUCT_CART(FK1_CART_NO, FK2_PRODUCT_ID, ITEM_QUANTITY) VALUES ($currentActiveCart, $newAddProduct, $newAddQuantity)";
            $addQuantityResult=  oci_parse($connection,$addQuantityQuery); 
            oci_execute($addQuantityResult); 

            $_SESSION['currentActiveCartSize'] = $wouldBeTotalQuantity;
            $_SESSION['cartLimitExceed'] = 'N';
            $_SESSION['cartLimitExceedMessage'] = '';
            $_SESSION['ProductLimitExceedMessage'] = '';

            }
        }

        else{
            $_SESSION['cartLimitExceed'] = 'Y';
            $_SESSION['cartLimitExceedMessage'] = 'Cart cannot hold more than 30 items at a time.';
        }



        
        // Redirecting user back
        // header("Location: ../productSearchPage.php?product-search=$searchQuery");

        header('Location: ' . $_SERVER['HTTP_REFERER']);


        // header('Location: ' . $lastURL);





       
    }

    // Else case for when User is not logged in
    else{
        
        $wouldBeTotalQuantity= 0;
        
        // Checking if cart array is created or not
        if(isset($_SESSION['guestCurrentCart'])){

                //Counting Total Products in current Cart
            foreach($_SESSION['guestCurrentCart'] as $cart){
                foreach($cart as $productId => $productQuantity){
                    $totalItems  = $productQuantity + $totalItems;
                }
            }

            $wouldBeTotalQuantity = $totalItems + $newAddQuantity;

            echo 'your would be total quantity is '.$wouldBeTotalQuantity.' ';

            // This condition ensures that cart user wont be adding products more than cart-limit itself.
            if($wouldBeTotalQuantity <= $cartLimit){

                $arrayProductFound = 0;
                $arrayProductQuantity = 0;

                //Checking if a product already exists in an array, also, couting quantity in case, product was found.
                foreach($_SESSION['guestCurrentCart'] as $cart){
                    foreach($cart as $productId => $productQuantity){
                        if($newAddProduct == $productId){
                            $arrayProductFound++;
                            $arrayProductQuantity = $productQuantity;
                        }
                    }
                }

                echo ' product found : '.$arrayProductFound;
                echo ' quantity found : '.$arrayProductQuantity;


                

                // If the product is already present in a cart array.
                if($arrayProductFound>=1){

                    //calculating would be total quantity. 
                    $arrayNewProductCount = $arrayProductQuantity + $newAddQuantity;

                    echo '<br><br> Your cart would have this many items of this product: '.$arrayNewProductCount;

                    //if adding new quantity will not result in more than 20 items, we add it to the currentArray.
                    if($arrayNewProductCount>20){
                        echo 'Sorry you cannot add more than 20 items of same product.';
                    }

                    elseif($arrayNewProductCount<=20){

                        // This piece of code deletes newly going to be added product first
                        for($i=0;$i<sizeof($_SESSION['guestCurrentCart']);$i++){
                            foreach($_SESSION['guestCurrentCart'][$i] as $cartProductId=>$cartProductQuantity){
                                if($cartProductId==$newAddProduct){
                                    array_splice($_SESSION['guestCurrentCart'],$i,1);
                                }
                            }
                        }

                        // and again new updated value is added to it.
                        array_push($_SESSION['guestCurrentCart'],array($newAddProduct=>$arrayNewProductCount));

                    }

                    else{
                        echo 'Sorry you cannot add more than 20 items of same product.';
                    }

                }

                else{
                    array_push($_SESSION['guestCurrentCart'],array($newAddProduct=>$newAddQuantity));
                }

            }

            else{

                echo 'Your cart connot hold more than '.$cartLimit.' items.';
                // $_SESSION['unregisteredCartLimitExceed'] = 'Y';
                // $_SESSION['unregisteredCartLimitExceedMessage'] = 'Cart cannot hold more than 20 items at a time.';
            }

        }
        
        //else, create a new array and add items to it. 
        else{
            $_SESSION['guestCurrentCart']=array();
            array_push($_SESSION['guestCurrentCart'],array($newAddProduct=>$newAddQuantity));
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
?>