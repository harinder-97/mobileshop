<?php
require_once("db/dbconnect.php");
if (!empty($_POST['pr_imgid'])){
	$pr_imgid = $_POST['pr_imgid'];
  $sql = "SELECT `id` FROM `web_productpics` where id='".$pr_imgid."' ORDER BY id ASC";
  $query = mysqli_query($conn,$sql); 
  if (mysqli_num_rows($query) >= 1) {
	$qury = "DELETE FROM web_productpics where id='".(int)$pr_imgid."'";	 
	
		if(mysqli_query($conn,$qury)) {
			$res = 1;
		}
		else{
			$res= 0;
		}
  }else{
	  $res = 2;
  }
  echo $res;
}


?>