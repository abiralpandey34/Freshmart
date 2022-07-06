<?php 

                        

    // Storing currentUserID to a variable.
    $currentUserID = $_SESSION['user_id'];      

    // Checking if Guest Cart was created or not. 
    if(isset($_SESSION['guestCurrentCart']) && sizeof($_SESSION['guestCurrentCart']) >=1){

        //Query to count any current Cart for currentUser.
        $cartInfoQuery="SELECT COUNT(PK_CART_NO) FROM CART where FK1_USER_ID = $currentUserID AND IS_ACTIVE='Y'";
        $cartInfoResult=  oci_parse($connection,$cartInfoQuery); 
        $cartInfoRun = oci_execute($cartInfoResult); 

        while (($cartInfoRow = oci_fetch_assoc($cartInfoResult))) {
            $cartFoundCount = $cartInfoRow['COUNT(PK_CART_NO)'];
            }


        //If condition when cart is found
        if( $cartFoundCount==1){

            

            $retrieveCartQuery="SELECT PK_CART_NO FROM CART WHERE FK1_USER_ID = $currentUserID AND IS_ACTIVE = 'Y'";
            $retrieveCartResult=  oci_parse($connection,$retrieveCartQuery); 
            oci_execute($retrieveCartResult); 

            //Storing current cart ID in session variable.
            while (($retrieveCartRow = oci_fetch_assoc($retrieveCartResult))) {
                $_SESSION['currentActiveCart'] = $retrieveCartRow['PK_CART_NO'];
            }

            $currentActiveCart = $_SESSION['currentActiveCart'];

            // Cart is present for user. But we still don't know if it has some items in it. So, we do this
            $productFoundCountQuery = "SELECT SUM(FK2_PRODUCT_ID) FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
            $productFoundCountResult=  oci_parse($connection,$productFoundCountQuery); 
            oci_execute($productFoundCountResult); 

            while ($productFoundCountRow = oci_fetch_assoc($productFoundCountResult)) {
                $productFoundCount = $productFoundCountRow['SUM(FK2_PRODUCT_ID)'];
            }

            if($productFoundCount >= 1){

                //Array loop starts.
                foreach($_SESSION['guestCurrentCart'] as $cart){
                    foreach($cart as $productId => $productQuantity){
                    
                        $productFoundQuery = "SELECT * FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
                        $productFoundResult=  oci_parse($connection,$productFoundQuery); 
                        oci_execute($productFoundResult); 

                        while ($productFoundRow = oci_fetch_assoc($productFoundResult)) {



                            
                            // If Product found in database and array is same, then
                            if($productFoundRow['FK2_PRODUCT_ID'] == $productId){

                                //Total count is made to check if Add quantity will get it greater than 20 or not
                                $newProductCount = $productFoundRow['ITEM_QUANTITY'] + $productQuantity;
                                $currentProduct = $productFoundRow['FK2_PRODUCT_ID'];

                                // If adding wont increase product Quantity to more than 20
                                if($newProductCount<=20){
                                    $productUpdateQuery = "UPDATE PRODUCT_CART SET ITEM_QUANTITY = $newProductCount WHERE FK1_CART_NO = $currentActiveCart AND FK2_PRODUCT_ID = $currentProduct";
                                    $productUpdateResult=  oci_parse($connection,$productUpdateQuery); 
                                    oci_execute($productUpdateResult); 
                                }

                                // else, product quantity of max 20 is added. 
                                else{
                                    $productUpdateQuery = "UPDATE PRODUCT_CART SET ITEM_QUANTITY = 20 WHERE FK1_CART_NO = $currentActiveCart AND FK2_PRODUCT_ID = $currentProduct";
                                    $productUpdateResult=  oci_parse($connection,$productUpdateQuery); 
                                    oci_execute($productUpdateResult); 
                                }

                            }

                            else{

                                    $productUpdate2Query = "INSERT INTO PRODUCT_CART(FK1_CART_NO, FK2_PRODUCT_ID, ITEM_QUANTITY) VALUES ($currentActiveCart, $productId, $productQuantity)";
                                    $productUpdate2Result=  oci_parse($connection,$productUpdate2Query); 
                                    oci_execute($productUpdate2Result); 
                            }


                        }



                    }
                }

            }

            else{

                //no product inside that cart. so now just add
                foreach($_SESSION['guestCurrentCart'] as $cart){
                    foreach($cart as $productId => $productQuantity){
                        $productUpdate2Query = "INSERT INTO PRODUCT_CART(FK1_CART_NO, FK2_PRODUCT_ID, ITEM_QUANTITY) VALUES ($currentActiveCart, $productId, $productQuantity)";
                        $productUpdate2Result=  oci_parse($connection,$productUpdate2Query); 
                        oci_execute($productUpdate2Result); 
                    }
                }
            }


                

                //We are again going to get currentCartSize and store it in session variable
                $quantityQuery = "SELECT SUM(ITEM_QUANTITY) FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
                $quantityResult=  oci_parse($connection,$quantityQuery); 
                oci_execute($quantityResult); 
                
                while (($quantityRow = oci_fetch_assoc($quantityResult))) {
                    $_SESSION['currentActiveCartSize'] = $quantityRow['SUM(ITEM_QUANTITY)'];
                }

        }

        else{
        
            // Generating a new cart for the user, since we didn't found any active cart.
            $createCartQuery="INSERT INTO CART(PK_CART_NO,FK1_USER_ID,IS_ACTIVE) VALUES (CART_ID_SEQ.NEXTVAL, $currentUserID, 'Y')";

            // connect to OCI and checks if any error during parse or execution of SQL
            $createCartResult=  oci_parse($connection,$createCartQuery); 
            $createCartResult = oci_execute($createCartResult); 

            if($createCartResult){


                // Fetching cart_ID to store it in a session variable.
                $retrieveCartQuery="SELECT PK_CART_NO FROM CART WHERE FK1_USER_ID = $currentUserID AND IS_ACTIVE = 'Y'";
                $retrieveCartResult=  oci_parse($connection,$retrieveCartQuery); 
                oci_execute($retrieveCartResult); 

                while (($retrieveCartRow = oci_fetch_assoc($retrieveCartResult))) {
                    $_SESSION['currentActiveCart'] = $retrieveCartRow['PK_CART_NO'];
                }

                //Storing active cart in a variable
                $currentActiveCart = $_SESSION['currentActiveCart'];

                //Array loop starts.
                foreach($_SESSION['guestCurrentCart'] as $cart){
                    foreach($cart as $productId => $productQuantity){

                    
                        $productUpdateQuery = "INSERT INTO PRODUCT_CART(FK1_CART_NO, FK2_PRODUCT_ID, ITEM_QUANTITY) VALUES ($currentActiveCart, $productId, $productQuantity)";
                        $productUpdateResult=  oci_parse($connection,$productUpdateQuery); 
                        oci_execute($productUpdateResult); 

                    }

                }      

                //We are again going to get currentCartSize and store it in session variable
                $quantityQuery = "SELECT SUM(ITEM_QUANTITY) FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
                $quantityResult=  oci_parse($connection,$quantityQuery); 
                oci_execute($quantityResult); 

                while (($quantityRow = oci_fetch_assoc($quantityResult))) {
                    $_SESSION['currentActiveCartSize'] = $quantityRow['SUM(ITEM_QUANTITY)'];
                }

            }

            else{
                echo 'unsuccessful at inserting data';
            }

        }

        unset($_SESSION['guestCurrentCart']);
    }

    else{


        /* This part is going to check if user-contains any active cart or not, 
        if not then assign a cart to user. And store that into session variables.
        */

        //Query to count any current Cart for currentUser.
        $cartInfoQuery="SELECT COUNT(PK_CART_NO) FROM CART where FK1_USER_ID = $currentUserID AND IS_ACTIVE='Y'";
        $cartInfoResult=  oci_parse($connection,$cartInfoQuery); 

        if (!$cartInfoResult){
            $error = oci_error($connection);    
            trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
        }

        $cartInfoRun = oci_execute($cartInfoResult); 
        if(!$cartInfoRun){    
            $error = oci_error($cartInfoResult);
            trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
        }
        // End of execution

        while (($cartInfoRow = oci_fetch_assoc($cartInfoResult))) {
            $cartFoundCount = $cartInfoRow['COUNT(PK_CART_NO)'];
            }


        //If condition when cart is found
        if( $cartFoundCount==1){
            
            $retrieveCartQuery="SELECT PK_CART_NO FROM CART WHERE FK1_USER_ID = $currentUserID AND IS_ACTIVE = 'Y'";
            $retrieveCartResult=  oci_parse($connection,$retrieveCartQuery); 
            oci_execute($retrieveCartResult); 

            //Storing current cart ID in session variable.
            while (($retrieveCartRow = oci_fetch_assoc($retrieveCartResult))) {
                $_SESSION['currentActiveCart'] = $retrieveCartRow['PK_CART_NO'];
            }

            //Storing active cart in a varible to use in line 78
            $currentActiveCart = $_SESSION['currentActiveCart'];

            //We are again going to get currentCartSize and store it in session variable
            $quantityQuery = "SELECT SUM(ITEM_QUANTITY) FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
            $quantityResult=  oci_parse($connection,$quantityQuery); 
            oci_execute($quantityResult); 

            while (($quantityRow = oci_fetch_assoc($quantityResult))) {
                $_SESSION['currentActiveCartSize'] = $quantityRow['SUM(ITEM_QUANTITY)'];
            }
        }

        // Else condition when cart is not found
        else{
            
            // Generating a new cart for the user, since we didn't found any active cart.
            $createCartQuery="INSERT INTO CART(PK_CART_NO,FK1_USER_ID,IS_ACTIVE) VALUES (CART_ID_SEQ.NEXTVAL, $currentUserID, 'Y')";

            // connect to OCI and checks if any error during parse or execution of SQL
            $createCartResult=  oci_parse($connection,$createCartQuery); 
            $createCartResult = oci_execute($createCartResult); 

            if($createCartResult){

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

            else{echo 'unsuccessful at inserting data';}

        }

        // Cart Assigning part ends here


        }
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
            
                    




?>