<?php
$username = $_SESSION['uname'];
$uid = $_SESSION['uid'];
?>
<body class="dark">
		<div class="top-bar">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-4">
						<div class="logo">
							<img src="icons/logo_new.png" alt="Mobile Store" width="100px" /> 
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-8">					
						<div class="user-actions">
							<div class="welcome-msg">Welcome <?php echo $username;?></div>							
							<a href="logout.php">
								<button class="signout" type="button">Log Out <i class="fa fa-sign-out"></i></button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>