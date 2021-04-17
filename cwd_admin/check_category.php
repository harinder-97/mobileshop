<?php
require_once("db/dbconnect.php");
if (!empty($_POST['cat_name'])){
	$cat_name = $_POST['cat_name'];
  $sql = "SELECT `category_name` FROM `web_category` where category_name='".$cat_name."' ORDER BY id ASC";
  $query = mysqli_query($conn,$sql); 
  if (mysqli_num_rows($query) >= 1) {
    $res= 1;
  }else{
	  $res = 0;
  }
  echo $res;
}


//get product by category

if (!empty($_POST['product_category'])){
	$product_category = $_POST['product_category'];
    $sql = "SELECT `id`, `product_name` FROM `web_products` where product_category='".$product_category."' and _status=0 ORDER BY id ASC";
  $query = mysqli_query($conn,$sql); 
  if (mysqli_num_rows($query) > 0) {
	  $res .= '<option value="">--SELECT PRODUCT NAME--</option>	';
	   while ($prow = mysqli_fetch_assoc($query) )
		{
			$res .= '<option value="'.$prow["id"].'">'.$prow["product_name"].'</option>';
		}    
  }else{
	  $res = '<option value=>No Product available</option>';
  }
  echo $res;
}


//get product price

if (!empty($_POST['product_id'])){
	$product_id = $_POST['product_id'];
   $sql = "SELECT `price` FROM `web_products` where id='".$product_id."' and _status=0 ORDER BY id ASC";
  $query = mysqli_query($conn,$sql); 
  if (mysqli_num_rows($query) > 0) {
	  $prrow = mysqli_fetch_assoc($query);
	   $pro_price = $prrow["price"];
	   
  }else{
	  $pro_price = '';
  }
  echo $pro_price;
}
?>