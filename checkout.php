<?php
require_once("header.php");
if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
?>
    <div class="toolbag-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="C-inner">

                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home  &raquo;</a></li>
                        <li> Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="addtocart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>CHECKOUT</h1>
                </div>
                <div class="col-md-12">
					<form action="place_order.php" method="POST">
						<div class="row">
							<div class="col-md-6">
							<?php
							$csql = "SELECT * from web_customers where id='".$user_id."' and _status=1";
							$crs = mysqli_query($conn,$csql);
							if(mysqli_num_rows($crs) >= 1)
							{
								$crow = mysqli_fetch_assoc($crs); 
								$customer_name = $crow['first_name'].' '.$crow['last_name'];
							?>
							
								<div class="enquiry checkout">
									<label>Name</label>
									<input type="text" class="form-control" name="name" value="<?php echo $customer_name; ?>" readonly placeholder="Name">
								</div>
								<div class="enquiry checkout">
									<label>Email</label>
									<input type="text" class="form-control" name="email" value="<?php echo $crow['email']; ?>" placeholder="Email" readonly >
								</div>
								<div class="enquiry checkout">
									<label>Phone Number</label>
									<input type="text" class="form-control" name="contact_person" value="<?php echo $crow['phone_no']; ?>" placeholder="Contact Person" readonly />
								</div>
								<div class="enquiry checkout">
									<label>Address</label>
									<textarea name="address" class="form-control" rows="4" cols="50"><?php echo $crow['address']; ?></textarea>
								</div>
								<input type="checkbox" name="change_address" id="change_address" value="1" onchange="valueChanged()">
								<label for="change_address"> Change Address</label><br>
								<div class="enquiry checkout">
									<textarea name="new_address" class="form-control" id="new_address" rows="4" cols="50"></textarea>
								</div>
							<?php } ?>
							</div>
							<div class="col-md-6">
								<div class="product_data">
								<h6>Product Details</h6>
								<?php					
								$user_id = $_SESSION['user_id'];
								$csql = "SELECT * from web_cart where user_id='".$user_id."' and porder=0";
								$crs = mysqli_query($conn,$csql);
								if(mysqli_num_rows($crs) >= 1)
								{
									while($crow = mysqli_fetch_assoc($crs)){ 
									?>
									<div class="product_details">
									<?php
										$product_id = $crow['product_id'];
										$pro_qty += $crow['qty'];
										$product_price += $crow['product_price'];
										$pi_sql = "SELECT * from web_productpics WHERE pid='".$product_id."' order by id DESC LIMIT 1";
										$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
										$pcount = mysqli_num_rows($pi_execute_sql);
										if($pcount >= 1){ 
											$pi_row = mysqli_fetch_assoc($pi_execute_sql)?>
											<div class="row">
												<div class="col-md-3">
													<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $crow['product_name'];?>" cart_id="<?php echo $crow['id']; ?>" width="120px" >
												</div>
												<div class="col-md-9 hpro_details">
													<p class="hp_name"><?php echo $crow['product_name']; ?></p>
													<p class="hp_amt">$<?php echo $crow['product_price']; ?></p>
													<p class="hp_qty"><b>Qty:</b> <?php echo $crow['qty']; ?></p>
												</div>												
											</div>
									<?php } ?>
									</div>
								<?php } ?>
								<div class="col-md-12 total">
									<div class="row">
										<div class="col-md-6">
											<p><b>Total amount: $<?php echo $product_price; ?></b></p>
										</div>
										<div class="col-md-6">
											<p><b>Total Qty: <?php echo $pro_qty; ?></b></p>
										</div>
									</div>
								</div>
								<?php									
								}
								?>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-md-12">
								<h4>Select Payment Method</h4>
								<input type="radio" value="1" name="pay_method" required> Cash On Delivery
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">								
								<input type="submit" class="btn" value="Place Order" name="submit_order" />
							</div>
						</div>
					</form>			
                </div>
            </div>
        </div>
    </div>

<?php
}else{
	header("location:index.php");
}
require_once("footer.php");
?>
<script>
$(document).ready(function(){
	$("#new_address").hide();
})
	
function valueChanged()
{
	if($('#change_address').is(":checked"))   
		$("#new_address").show();
	else
		$("#new_address").hide();
}

</script>