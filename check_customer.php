<?php
require_once("config.php");
require_once("db/dbconnect.php");
if (!empty($_POST['user_email'])){
  $user_email = $_POST['user_email'];
  $sql = "SELECT `email` FROM `web_customers` where email='".$user_email."' ORDER BY id ASC";
  $query = mysqli_query($conn,$sql); 
  if (mysqli_num_rows($query) >= 1) {
    $res= 1;
  }else{
	  $res = 0;
  }
  echo $res;
}

?>