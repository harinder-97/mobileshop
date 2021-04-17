<?php
require_once("db/dbconnect.php"); 

if(isset($_POST['add_img']) && !empty($_POST['add_img']))
{
	$product_name = $_POST['product_name'];
	$product_category = $_POST['product_category'];
	$product_price = $_POST['product_price'];
	$product_details = $_POST['product_detail'];	
	$is_featured = $_POST['is_featured'];	
    $status = $_POST['status'];
	
	$query="INSERT into web_products (`product_name`, `product_category`, `price`, `product_details`, `is_featured`, `created_on`, `updated_on`, `_status`) VALUES('$product_name', $product_category, '$product_price', '$product_details', $is_featured, NOW(), NOW(), $status)";	
	
	$sql_qry = mysqli_query($conn,$query);
	
	if($sql_qry){
		$product_id = mysqli_insert_id($conn);
		
		$errors= array();
		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
			$file_name = $key.$_FILES['files']['name'][$key];
			$name = preg_replace('/\s+/', '_', $file_name);
			$img_name = time().'.'.$name;
			$file_size =$_FILES['files']['size'][$key];
			$file_tmp =$_FILES['files']['tmp_name'][$key];
			$file_type=$_FILES['files']['type'][$key];	
			$extensions = array("jpeg","jpg","png",'JPG','gif','pjpeg'); 
			$file_ext=explode('.',$_FILES['files']['name'][$key])  ;
			$file_ext=end($file_ext);  
			$file_ext=strtolower(end(explode('.',$_FILES['files']['name'][$key])));  
			if(in_array($file_ext,$extensions ) === false){
				$errors[]="extension not allowed";
			}            
			
			$query = "INSERT into web_productpics (`pid`,`_img`) VALUES('$product_id','$img_name')";
		  
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"../uploads/productpics/".$img_name);
				$sql_qry = mysqli_query($conn,$query);
				
				if($sql_qry){
					$_SESSION['success'] = 'Product Added successfully!';	
				} else {
					$_SESSION['error'] = 'Error in adding Product';	
				}
			}else{
				$_SESSION['error'] = 'Invalid file upload!';
			}
		}	
	}

}

header("location:list_products.php");
?>