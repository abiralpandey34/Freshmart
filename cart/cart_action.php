<?php 
if(isset($_POST["add_to_cart"])){
	$product_id=$_GET['id'];
	$item_price=$_POST["hidden_price"];
	$item_name=$_POST["hidden_name"];
	$item_quantity=$_POST["quantity"];
	$cart_id= $_SESSION['user_id'];
	if(!empty( $_SESSION['user_name']) and  $_SESSION['user_type']=='customer'){
		if(isset($_SESSION["shopping_cart"]))
		{	$_SESSION['product_active']='active';
			$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
			if(!in_array($_GET["id"], $item_array_id))
			{
				$count = count($_SESSION["shopping_cart"]);
				$item_array = array(
					'item_id'			=>	$_GET["id"],
					'item_name'			=>	$_POST["hidden_name"],
					'item_price'		=>	$_POST["hidden_price"],
					'item_quantity'		=>	$_POST["quantity"]
				);
				$_SESSION["shopping_cart"][$count] = $item_array;
				$query="INSERT INTO PRODUCT_CART (fk2_product_id,fk1_cart_no,item_price,item_quantity,item_name) 
						VALUES ($product_id,$cart_id,$item_price,$item_quantity,'$item_name')";
				$result=  oci_parse($connection,$query); 
             	if (!$result) 
             	{
                	$error = oci_error($connection);    
                	trigger_error('Could not parse statement: '. $error['message'], E_USER_ERROR); 
             	}
             	$run = oci_execute($result); 
             	if(!$run) 
             	{    
                	$error = oci_error($result);
                 	trigger_error('Could not execute statement:'. $error['message'], E_USER_ERROR); 
             	}
             // End of execution
				
			} 
			else
			{
				echo '<script>alert("Item Already Added")</script>';
			}
		}
		else{
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][0] = $item_array;
		}

	}
	else{
		echo "unregistered";
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{	$queryDelete="DELETE FROM PRODUCT_CART where fk2_product_id=$product_id and fk1_cart_no= $cart_id ";
				echo $queryDelete;
				// unset($_SESSION["shopping_cart"][$keys]);
				// echo '<script>alert("Item Removed")</script>';
				// echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>