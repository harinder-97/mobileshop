<?php
session_start();
include_once("admincheck.php");
include_once("db/dbconnect.php"); 
include_once("../inc/functions.php");
if(isset($_POST['submit_cat']) && ($_SESSION['token_new_id_rand']==$_POST['new_token']))
{
$category_name = myAddSlashes($_POST['category_name']);
	$parent = myAddSlashes($_POST['parent']);
	$status = myAddSlashes($_POST['status']);
	
	echo $sql = "INSERT into web_category (category_name, _parent, _update, _status) values('$category_name', '$parent', NOW(), '$status')";
	die;		
   	if (mysqli_query($conn,$sql)) {
		$_SESSION['success'] = 'Category Added successfully!';	
	} else {
		$_SESSION['error'] = 'Category not Added';	
	}	
	
	//echo '<script>window.location = "list_category.php";</script>';
			  
}			 
header("location:list_postCategory.php?msg=".$msg);
exit();
?>