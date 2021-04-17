<?php
require_once("config.php");
require_once("db/dbconnect.php");
/* Delete Cart value */

if(isset($_POST["user_id"]) && !empty($_POST["user_id"]) && !empty($_POST["cart_id"])){
	$user_id = $_POST["user_id"];
	$cart_id = $_POST["cart_id"];
	
	$psql = "Delete from web_cart where id = '$cart_id' and user_id = '$user_id' and porder = 0";
	
	$prs = mysqli_query($conn,$psql);
	if($prs)
	{
		echo "1";
	}else{
		echo "0";
	}
}

?>