<?php include '../reusable/errorReporting.php'?>


<?php 

include '../reusable/connection.php';

$productApproveID = $_GET['productApproveID'];
$productDisableID = $_GET['productDisableID'];

$shopID = $_GET['shopID'];
$shopDisableID = $_GET['shopDisableID'];

$traderID = $_GET['traderID'];
$traderApproveID = $_GET['traderApproveID'];

$feedbackDelete = $_GET['feedbackDelete'];

echo $productApproveID;
// echo $shopID;
// echo $traderID;

if(isset($productApproveID)){
    $productApproveQuery="UPDATE PRODUCT SET PRODUCT_ACTIVE='Y' WHERE PK_PRODUCT_ID = $productApproveID";
    $productApproveResult=  oci_parse($connection,$productApproveQuery); 
    oci_execute($productApproveResult); 

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

elseif(isset($productDisableID)){
    $productDisableQuery="UPDATE PRODUCT SET PRODUCT_DELETE = 'Y', PRODUCT_ACTIVE = 'Y' WHERE PK_PRODUCT_ID = $productDisableID";
    $productDisableResult=  oci_parse($connection,$productDisableQuery); 
    oci_execute($productDisableResult); 

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


elseif(isset($shopID)){
    $shopApproveQuery="UPDATE SHOP SET SHOP_ACTIVE = 'Y' WHERE PK_SHOP_ID = $shopID";
    $shopApproveResult=  oci_parse($connection,$shopApproveQuery); 
    oci_execute($shopApproveResult); 
    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

elseif(isset($shopDisableID)){
    $shopDisableQuery="UPDATE SHOP SET SHOP_ACTIVE = 'N' WHERE PK_SHOP_ID = $shopDisableID";
    $shopDisableResult=  oci_parse($connection,$shopDisableQuery); 
    oci_execute($shopDisableResult); 
    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

elseif(isset($traderApproveID)){
    $traderApproveQuery="UPDATE SITE_USER SET USER_STATUS = 'Y' WHERE PK_USER_ID = $traderApproveID";
    $traderApproveResult=  oci_parse($connection,$traderApproveQuery); 
    oci_execute($traderApproveResult); 

    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

elseif(isset($feedbackDelete)){
    $feedbackDeleteQuery="DELETE FROM FEEDBACK WHERE PK_FEEDBACK_ID	 = $feedbackDelete";
    $feedbackDeleteResult=  oci_parse($connection,$feedbackDeleteQuery); 
    oci_execute($feedbackDeleteResult); 

    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

elseif(isset($traderID )){

    $_SESSION['currentTraderId'] = $traderID;
    echo 'in admin approval. currentTraderId session variable is set as: '. $_SESSION['currentTraderId'];
    header('Location: ../trader-dashboard/trader-dashboard.php');

}




?>