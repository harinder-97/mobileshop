<?php 
require_once("db/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8">
<title>Mobile Store</title
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Basic Styles -->
<link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" media="screen" href="css/font-awesome.css">
<link rel="stylesheet" href="css/sidebar-menu.css">
<link rel="stylesheet" media="screen" href="css/style.css">
</head>
<?php
if (isset($_SESSION['error']) && $_SESSION['error'] <>"") {?>
      <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> 
          <?php echo trim($_SESSION['error']);?></div>
      <?php   }
        ?>
    <?php 
    if (isset($_SESSION['success']) && $_SESSION['success'] <>"") {?>
     <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>
          <?php echo trim($_SESSION['success']);?></div>
    <?php } ?>
    <div class="parent">          
        <div class="login-box">
         <div class="white-bg">
             <h1>Please Login</h1>
                    <form method="POST" action="verify.php" id="login-form">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" name="txtusername" placeholder="Username" required="required">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="txtpassword" placeholder="Password" required="required">
                        </div>
                                               
                        <div class="row">
                            <div class="col-sm-6">                               
                                <input type="submit" name="submit" value="Login" class="true-btn" >
                            </div>
                            
                        </div>      
                    </form>
                </div>
            </div>
      </div>

<?php include_once('includes/footer.php');?>

<?php
if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	unset($_SESSION['error']);
}
?>