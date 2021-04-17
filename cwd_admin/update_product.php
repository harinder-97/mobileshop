<?php
require_once("db/dbconnect.php"); 
if(isset($_POST['edit_img']) && (!empty($_POST['edit_img'])))
{
	$product_id = $_POST['pid'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
	$product_category = $_POST['product_category'];
	$product_details = $_POST['product_detail'];
	$is_featured = $_POST['is_featured'];
    $status = $_POST['status'];
	
	$sql='UPDATE web_products set product_name="'.$product_name.'", price="'.$product_price.'", product_category="'.$product_category.'", product_details="'.$product_details.'", is_featured="'.$is_featured.'", `updated_on`=NOW(), _status="'.$status.'"';	
	
	$sql.=' where id="'.(int)$product_id.'"';

	$sql_qry = mysqli_query($conn,$sql);
	
	if($sql_qry){
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
						$_SESSION['success'] = 'Product Image  Added successfully!';	
					} else {
						$_SESSION['error'] = 'Error in adding Product Image';	
					}
				}
			}
		
		$_SESSION['success'] = 'Product updated successfully!';	
		
	} else {
		$_SESSION['error'] = 'Error in updating Product';	
	}

	
	
	header("location:list_products.php");

}

header("location:list_products.php");
exit();
?>