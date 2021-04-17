<?php
session_start();
error_reporting(0);
require_once("config.php");
require_once("db/dbconnect.php");

?>
<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mobile Shop</title>
    <meta name="description" content="">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" href="images/favicon.png" type="image/x-icon" /> -->

    <!--For Plugins css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sina-nav.css">
    <link rel="stylesheet" href="css/carouseller.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--link rel="stylesheet" href="css/fasthover.css"-->
</head>

<body>

    <div class="nav-container">
        <nav class="sina-nav mobile-sidebar navbar-transparent navbar-fixed" data-top="20" data-md-top="20" data-xl-top="20">
            <div class="container">
                <div class="extension-nav">
                    <ul>
                        <li class="dropdown">
						<?php
						if(isset($_SESSION['user_id'])){
							$uid = $_SESSION['user_id'];
							$usql = "SELECT * from web_cart where user_id='".$uid."' and porder=0";
							$urs = mysqli_query($conn,$usql);
							?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cart-plus"></i> 
							<?php
							if(mysqli_num_rows($urs) >= 1)
							{							
								while($urow = mysqli_fetch_assoc($urs)){
									$qqty += $urow['qty'];
								}								
							echo '<span class="shop-badge">'.$qqty.'</span>';
							}else{
								echo '<span class="shop-badge">0</span>';
							}	
							?>
							</a>
							<ul class="dropdown-menu product-details">
							<?php
							$urs = mysqli_query($conn,$usql);
							if(mysqli_num_rows($urs) >= 1)
							{
								while($urow = mysqli_fetch_assoc($urs)){
									$pid = $urow['product_id'];
								?>
									<li>
									<div class="container">
										<div class="row">
											<div class="col-md-12 head_pro">
												<div class="col-md-4 hpro_img">
												<?php
												$pi_sql = "SELECT * from web_productpics WHERE pid='".$pid."' order by id DESC LIMIT 1";
												$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
												$pcount = mysqli_num_rows($pi_execute_sql);
												if($pcount >= 1){ 
													$pi_row = mysqli_fetch_assoc($pi_execute_sql)?>
													<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $p_row['product_name'];?>" class="block__pic img-fluid">
												<?php } ?>
												</div>
												<div class="col-md-8 hpro_details">
													<p class="hp_name"><?php echo $urow['product_name']; ?></p>
													<p class="pqty"><b>Qty:</b> <?php echo $urow['qty']; ?></p>
													<a href="view.php?pid=<?php echo $pid; ?>">view details</a>
												</div>
											</div>
										</div>
									</div>
									</li>
							<?php }
							echo '<a href="cart.php" class="btn">Go to Cart</a>';
							}else{
								echo '<li><p>Your cart is empty</p></li>';
							}?>
							</ul>
						<?php }else{ ?>	
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cart-plus"></i> 
								<span class="shop-badge">0</span>
							</a>
							<ul class="dropdown-menu">
								<li><p>Your cart is empty</p></li>							
							</ul>
						<?php } ?>
						</li>
                    </ul>
                </div>
                <!-- .extension-nav -->


                <div class="sina-nav-header social-on">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
					<i class="fa fa-bars"></i>
				</button>
                    <a class="sina-brand" href="index.php">
                        <img src="images/ps3.png" alt="">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="sina-menu sina-menu-right">
                        <li><a href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Brands</a>
							<?php
							$cat_sql = "SELECT * FROM web_category WHERE _status='0' ORDER BY category_name";
							$cat_result = mysqli_query($conn,$cat_sql) or die(mysqli_error());

							if(mysqli_num_rows($cat_result) > 0)
							{ ?>
								<ul class="dropdown-menu" >
								<?php
								while($cat_row = mysqli_fetch_assoc($cat_result)){
								?>
									<li><a href="listing.php?cid=<?php echo $cat_row['id']?>"><?php echo $cat_row['category_name']?></a></li>
								<?php }  ?>
								</ul>
							<?php } ?>
                        </li>
                        <li><a href="sales.php">Sales</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="contactus.php">Contact Us</a></li>
						<?php
						if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
						?>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user_name']; ?></a>
								<ul class="dropdown-menu">
									<li><a href="sign_out.php">Sign Out</a></li>
								</ul>
							</a>
						</li>
						<?php } else{?>
						<li><a href="login_reg.php">Sign In</a></li>
						<?php }?>
                    </ul>
                </div>
            </div>
            <!-- .container -->
        </nav>
    </div>

<!-- End Header -->

