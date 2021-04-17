<?php
require_once("config.php");
require_once("db/dbconnect.php");
if(isset($_POST["user_id"]) && !empty($_POST["user_id"])){
	
	$user_id = $_POST["user_id"];
	$qty = $_POST["qty"];
	$product_id = $_POST["product_id"];
	$product_name = $_POST["product_name"];
	$product_price = $_POST["pro_price"];
	$new_price = $qty * $product_price;
	
	$psql = "select * from web_cart where product_id = '$product_id' and user_id = '$user_id' and porder = 0";
	
	$prs = mysqli_query($conn,$psql);
	if(mysqli_num_rows($prs) >= 1)
	{
		$prow = mysqli_fetch_assoc($prs);
		$pqty = $prow['qty'];
		$new_qty = $pqty + $qty;
		$new_price = $new_qty * $product_price;
		$sql = "update web_cart set qty = '$new_qty', product_price='$new_price' where product_id = $product_id";
	}else{
		$sql = "INSERT into web_cart (user_id, product_id, product_name, product_price, qty, updated_on, porder) values('$user_id', '$product_id', '$product_name', '$new_price', '$qty', NOW(), '0')";
	}		
	if (mysqli_query($conn,$sql)) {
		$_SESSION['user_id'] = $user_id;
		/* $_SESSION['qty'] = $qty;
		$_SESSION['product_id'] = $product_id;	 */
		echo "1";
	} else {
		echo "0";
	}	
}



?>