<?php
  require_once("db/dbconnect.php");
  require_once("includes/top.php");
  require_once("includes/header.php");
  require_once("inc_navigation.php");
  
?>
<section class="right-panel">
	<div class="breads">Home / Dashboard</div>

	<div class="page-title">
		<h1>Dashboard</h1>
	</div>

	<div class="main-content">
   <?php    
      if (isset($_SESSION['success']) && $_SESSION['success'] <>"") {?>
         <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>
         <?php echo trim($_SESSION['success']);?></div>
      <?php  } ?>
		<h3>Welcome to Mobile Shop Website Admin Panel</h3>
	</div>

</section>

<?php require_once("includes/footer.php"); ?>   

            
    

   