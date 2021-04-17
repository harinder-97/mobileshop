<?php
session_start();
include_once("db/dbconnect.php");
if(isset($_POST['submit_pass']) && (!empty($_POST['submit_pass'])))
{
	$oldpassword = $_POST['txtoldpassword'];
	$newpassword = $_POST['txtnewpassword'];
	$newpassword2 = $_POST['txtnewpassword2'];

if ($newpassword!=$newpassword2)
{
	header("location:changepassword.php?error_msg=Your New Password Does Not Match With Each Other");
	exit();
}

$sql = "SELECT * from web_usermaster where password='".md5($oldpassword)."'";
$rs = mysqli_query($conn,$sql);
if(mysqli_num_rows($rs) == 0)
{
	header("location:changepassword.php?error_msg=Your Old Password Is Incorrect.");
	exit();
}

$sql2 = "UPDATE web_usermaster set password='".md5($newpassword)."' where password='".md5($oldpassword)."'";
$rs = mysqli_query($conn,$sql2);
$_SESSION['success'] = 'Your Password Has Been Successfully Changed, Please Login Again';
header('location:index.php');
}else
{
	header("location:changepassword.php?msg=You are trying to make unauthorized access");
	exit();
}
?>