<?php
require_once("config.php");
require_once("db/dbconnect.php");
/* Delete Cart value */

if(isset($_POST["user_id"]) && !empty($_POST["user_id"]) && !empty($_POST["cart_id"]) && !empty($_POST["product_qty"])){
	$user_id = $_POST["user_id"];
	$product_qty = $_POST["product_qty"];
	$cart_id = $_POST["cart_id"];
	$product_id = $_POST["product_id"];
	
	$pi_sql = "SELECT price from web_products WHERE id='".$product_id."'";
	$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
	$pi_row = mysqli_fetch_assoc($pi_execute_sql);	
	$product_price = $pi_row['price'];
	
	$new_price = $product_qty * $product_price;
	
	$psql = "UPDATE web_cart SET qty=$product_qty, product_price=$new_price where id = '$cart_id' and user_id = '$user_id'";
	
	$prs = mysqli_query($conn,$psql);
	if($prs)
	{
		echo "1";
	}else{
		echo "0";
	}
}

?>