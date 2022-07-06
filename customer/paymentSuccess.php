
<?php

    include '../reusable/connection.php';

    //Storing Current Order and currentCart in a variable.
    $currentActiveOrder = $_SESSION['currentActiveOrder'];
    $currentActiveCart = $_SESSION['currentActiveCart'];
    $totalPrice = $_SESSION['currentTotalPrice'];
    $currentUserID = $_SESSION['user_id'];

    //Storing current Date into variable
    $date = date("Y/m/d H:i:s");
    $newDate = "'".$date."'";

    
    //Creating a new payment entry since payment was a success. 
    $addPaymentDetailQuery="INSERT INTO PAYMENT(PK_PAYMENT_ID, PAYMENT_METHOD, PAYMENT_AMOUNT, FK3_USER_ID, FK1_ORDER_ID, TRANSACTION_DATE) VALUES (PK_PAYMENT_ID.NEXTVAL, 'Paypal', $totalPrice, $currentUserID, $currentActiveOrder, TO_DATE($newDate, 'yyyy/mm/dd hh24:mi:ss') )";
    $addPaymentDetailResult=  oci_parse($connection,$addPaymentDetailQuery); 
    oci_execute($addPaymentDetailResult);
    
        
    


    //Modifying current order to be a success. 
    $modifyOrderQuery="UPDATE CUST_ORDER SET IS_SUCCESS = 'Y' WHERE PK_ORDER_ID = $currentActiveOrder";
    $modifyOrderResult=  oci_parse($connection,$modifyOrderQuery); 
    oci_execute($modifyOrderResult); 




    



    
    // First lets fetch data from product_cart
    $fetchCartDetailsQuery="SELECT * FROM PRODUCT_CART WHERE FK1_CART_NO = $currentActiveCart";
    $fetchCartDetailsResult=  oci_parse($connection,$fetchCartDetailsQuery); 
    oci_execute($fetchCartDetailsResult); 

    while (($fetchCartDetailsRow = oci_fetch_assoc($fetchCartDetailsResult))) {

    // Getting current Loop values to variable.
    $currentProductId = $fetchCartDetailsRow['FK2_PRODUCT_ID'];
    $currentProductQuantity = $fetchCartDetailsRow['ITEM_QUANTITY'];

    // Fetching Total stock quantity of that product.
    $fetchTotalStockQuery="SELECT PRODUCT_QUANTITY FROM PRODUCT WHERE PK_PRODUCT_ID = $currentProductId";
    $fetchTotalStockResult=  oci_parse($connection,$fetchTotalStockQuery); 
    oci_execute($fetchTotalStockResult); 

    while (($fetchTotalStockRow = oci_fetch_assoc($fetchTotalStockResult))) {
        $beforeTotalStock = $fetchTotalStockRow['PRODUCT_QUANTITY'];
    }

    $afterTotalStock = $beforeTotalStock - $currentProductQuantity;

    // This statement is going to update new stock quantity of that current product after the purchase.
    $updateProductStockQuery="UPDATE PRODUCT SET PRODUCT_QUANTITY = $afterTotalStock WHERE PK_PRODUCT_ID = $currentProductId";
    $updateProductStockResult=  oci_parse($connection,$updateProductStockQuery); 
    oci_execute($updateProductStockResult); 


    //INSERTING Product cart information into Order_details table for further processing.
    $modifyOrderQuery="INSERT INTO ORDER_DETAILS(FK1_ORDER_ID, FK3_PRODUCT_ID, PRODUCT_QUANTITY, IS_PLACED) VALUES ($currentActiveOrder, $currentProductId, $currentProductQuantity, 'N')";
    $modifyOrderResult=  oci_parse($connection,$modifyOrderQuery); 
    $modifyOrderRun = oci_execute($modifyOrderResult); 
    }



    $querySelectUser="SELECT user_email, user_name FROM SITE_USER WHERE PK_USER_ID=$currentUserID";
    echo $querySelectUser;
    $querySelectUserResult=oci_parse($connection,$querySelectUser); 
    oci_execute($querySelectUserResult); 
    while($querySelectUserResultRow = oci_fetch_assoc($querySelectUserResult))
    {
        $user_email = $querySelectUserResultRow['USER_EMAIL'];
        $user_name = $querySelectUserResultRow['USER_NAME'];
    }
    $baseurl='https://localhost/freshmart/register_user/';
    $to = $user_email;
    $subject = "Order Invoice";

    $message = 'Dear '.$user_name.',<br>';
    $message .= 'Your Invoice for the order ID: #'.$currentActiveOrder.' has been generated';
    ob_start();
        include "invoice_send.php";
    $message= ob_get_clean();
    $message .= "<p> Best Regards, FreshMart<br>";

    // // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // $header = "From: broshan18@tbc.edu.np";
    //         $header .= "MIME-Version: 1.0" . "\r\n";
    //         $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // // More headers
    $headers .= 'From: <freshmart@gmail.com>' . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";
    mail($to,$subject,$message,$headers);
    
    //Modifying current cart to be inactive now.. 
    $modifyCurrentCartQuery="UPDATE CART SET IS_ACTIVE = 'N' WHERE PK_CART_NO = $currentActiveCart";
    $modifyCurrentCartResult=  oci_parse($connection,$modifyCurrentCartQuery); 
    oci_execute($modifyCurrentCartResult); 

    $_SESSION['previousActiveCart'] = $currentActiveCart ;

    unset($_SESSION['currentActiveCart']);
    unset($_SESSION['currentActiveCartSize']);
    
    

    header('Location:invoice.php');


?>