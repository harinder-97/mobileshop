<?php
require_once("db/dbconnect.php");

if(isset($_POST["submit"]) && !empty($_POST["submit"])){
	$username = $_POST["txtusername"];
	$pass = $_POST["txtpassword"];

			$sql = "select * from web_usermaster where username='".$username."' and password = '".$pass."'";

			$rs = mysqli_query($conn,$sql) or die(mysqli_error());
			$row = mysqli_fetch_assoc($rs);
			$aid = $row['id'];
			if(mysqli_num_rows($rs) == 0)
			{
				$_SESSION['error'] = 'Invalid Login Credentials';
				header("location:index.php");
				exit();
			}
			else
			{
				$row = mysqli_fetch_assoc($rs);
				$_SESSION['uname'] = $username;
				$_SESSION['uid'] = $aid;
				$_SESSION['sess_id'] = session_id();
				$_SESSION['success'] = 'Login Successfully';
				header("location:panel.php");			
			}
	}
else{
	echo "<script>
			alert('Please Verify CAPTCHA');
			window.location.href='index.php';
		</script>";
}
?>