<?php
require_once("config.php");
require_once("db/dbconnect.php");

$user_id = $_SESSION['user_id'];
if(isset($_POST["submit_order"])){
	
	$csql = "SELECT * from web_cart where user_id='".$user_id."' and porder=0";
	$crs = mysqli_query($conn,$csql);
	if(mysqli_num_rows($crs) >= 1)
	{
		while($crow = mysqli_fetch_assoc($crs)){
			$cart_id = $crow['id'];
			$product_id = $crow['product_id'];
			$product_price = $crow['product_price'];
			$product_qty = $crow['qty'];
			
			$sql = "INSERT into web_checkout (user_id, product_id, product_price, product_qty, updated_on) values('$user_id', '$product_id', '$product_price', '$product_qty', NOW())";
			
			$prs = mysqli_query($conn,$sql);
			if($prs)
			{
				$psql = "UPDATE web_cart SET porder=1 where user_id = '$user_id' and id='$cart_id'";
	
				$rs = mysqli_query($conn,$psql);
				if(isset($_POST['change_address']) && !empty($_POST['new_address'])){
					$new_address = $_POST['new_address'];
					echo $csql = "UPDATE web_customers SET address='$new_address' where id = '$user_id'";	
					$crs = mysqli_query($conn,$csql);
				}
				
				
				header("location:thankyou.php");
			}else{
				header("location:checkout.php");
			}
		}
	}	
}

?>