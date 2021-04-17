<?php
//session_start();
require_once("config.php");
require_once("db/dbconnect.php");
 if(isset($_POST['signup']) && !empty($_POST['signup'])){
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
	
	$sql = "SELECT * from web_customers where email='".$email."'";
	$rs = mysqli_query($conn,$sql);
	if(mysqli_num_rows($rs) >= 1)
	{
		$_SESSION['error'] = 'Email already exists. Please try with other email address';	
		header("location: login_reg.php");
	}
	else{
		$sql = "INSERT into web_customers (first_name, last_name, email, password, phone_no, address, updated_on, _status) values('$first_name', '$last_name', '$email', '$password', '$phone_number', '$address', NOW(), '1')";
			
		if (mysqli_query($conn,$sql)) {
			$_SESSION['success'] = 'You are registered successfully. Please Login.';	
		} else {
			$_SESSION['error'] = 'Customer not Added';	
		}		
		header("location: login_reg.php");
	}
}   


//login checkdate


if(isset($_POST['signin']) && !empty($_POST['signin'])){
	
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
	$sql = "SELECT * from web_customers where email='".$email."' and password='".$password."'";
	
	$rs = mysqli_query($conn,$sql);
	if(mysqli_num_rows($rs) == 1)
	{
		$row = mysqli_fetch_assoc($rs);
		$user_id = $row['id'];
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$user_name = $first_name." ".$last_name;
		$_SESSION['user_name'] = $user_name;	
		$_SESSION['user_id'] = $user_id;	
		if(isset($_SESSION['product_id']) && !empty($_SESSION['product_id'])){
			$product_id = $_SESSION['product_id'];
			header("location: view.php?pid=$product_id");
		}else{
			header("location: index.php");
		}		
	}
	else{
		$_SESSION['error'] = 'You are trying to Login with invalid Email or Password.';	
			
		header("location: login_reg.php");
	}
}   
?>