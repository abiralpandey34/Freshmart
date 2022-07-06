<!-- This file is created to check and update CUST_ORDER table whenever trader dashboard is visited. 

    CUST_ORDER contains information about order like, order_id, who placed it, when and at what time it was ordered and what collection slot was choosen.
    The important thing it, it contains, two flags. IS_SUCCESS and IS_DELIVERED

    IS_SUCCESS is turned 'Y' when payment by user is a success
    IS_DELIVERED is turned 'Y' when all items are delivered associated with that order.

    ORDER_DETAILS contains a flag named IS_PLACED which turns 'Y' when trader delivers a item. 

    So, when all items of an order  is IS_PLACED ='Y', then IS_DELIVERED from CUST_ORDER has to be set as IS_DELIVERED = 'Y'.
    ----------------------------------------------------------------------------------------------------------------------------------------------
    This page checks if all items are placed, if found all placed, then turns IS_DELIVERED = 'Y'

-->

<?php


    $OrderQuery = "SELECT PK_ORDER_ID FROM CUST_ORDER WHERE IS_SUCCESS = 'Y' AND IS_DELIVERED='N'";
    $OrderQueryResult = oci_parse($connection, $OrderQuery);
    oci_execute($OrderQueryResult); 

    while($OrderQueryRow = oci_fetch_assoc($OrderQueryResult)){  
        $proceed = 'Y';

        $currentOrder = $OrderQueryRow['PK_ORDER_ID'];

        $isPlacedQuery = "SELECT IS_PLACED FROM ORDER_DETAILS WHERE FK1_ORDER_ID = $currentOrder";
        $isPlacedQueryResult = oci_parse($connection, $isPlacedQuery);
        oci_execute($isPlacedQueryResult); 

        while($isPlacedQueryRow = oci_fetch_assoc($isPlacedQueryResult)){ 

            if($isPlacedQueryRow['IS_PLACED'] == 'N'){
                $proceed = 'N';
            }

        }

        if($proceed == 'Y'){
            $updateOrderQuery = "UPDATE CUST_ORDER SET IS_DELIVERED = 'Y' WHERE PK_ORDER_ID = $currentOrder";
            $updateOrderQueryResult = oci_parse($connection, $updateOrderQuery);
            oci_execute($updateOrderQueryResult); 
        }

        
    }





?>