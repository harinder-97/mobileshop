<?php
require_once("config.php");
require_once("db/dbconnect.php");
if(isset($_POST['contact_submit'])){ 
		$to = 'abc@gmail.com';
		$subject = 'Website Enquiry Message - Mobile Shop';

		$from = $_POST['email'];		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		
		$enquiry = $_POST['message'];	
		
		$sql = "INSERT into web_contacus (name, email, phone_no, address, updated_on) values('$name', '$email', '$phone', '$enquiry', NOW())";
			
		if (mysqli_query($conn,$sql)) {		
			$_SESSION['msg'] = 1;
			header( "location:contactus.php" );
		} 
		else{
			$_SESSION['msg'] = 0;
			header( "location:contactus.php" );
		}	
	
}else{
		header( "location:contactus.php" );
}
?>