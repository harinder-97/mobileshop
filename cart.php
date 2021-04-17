<?php
require_once("header.php");
if(isset($_SESSION['user_id'])){
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
                        <li> Add to Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="addtocart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>ENQUIRY CART</h1>
                </div>
                <div class="col-md-12">
					<?php					
					$user_id = $_SESSION['user_id'];
					$csql = "SELECT * from web_cart where user_id='".$user_id."' and porder=0";
					$crs = mysqli_query($conn,$csql);
					if(mysqli_num_rows($crs) >= 1)
					{
					?>
                    <table class="table table-bordered table-responsive" id="table">
                        <tr>
                            <th width="8%">Sr. No.</th>                            
                            <th>Image</th>
							<th width="30%">Product Name</th>
							<th width="30%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="15%">&nbsp;</th>
                        </tr>
						<?php
						$count = 1;
						while($crow = mysqli_fetch_assoc($crs)){ 
							$product_id = $crow['product_id'];
						?>
                        <tr>
                            <td><?php echo $count; ?>.</td>
                            <td>
							<?php
								$pi_sql = "SELECT * from web_productpics WHERE pid='".$product_id."' order by id DESC LIMIT 1";
								$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
								$pcount = mysqli_num_rows($pi_execute_sql);
								if($pcount >= 1){ 
									$pi_row = mysqli_fetch_assoc($pi_execute_sql);?>
									<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $crow['product_name'];?>" cart_id="<?php echo $crow['id']; ?>" width="120px" >
								<?php } ?>
							</td>
                            <td><?php echo $crow['product_name']; ?></td>
                            <td>$<?php echo $crow['product_price']; ?></td>
                            <td><input type="text" min="1" value="<?php echo $crow['qty']; ?>" class="product_qty" product_id="<?php echo $crow['product_id']; ?>" cart_id="<?php echo $crow['id']; ?>" style="width: 50px;"> </td>
                            <td><i class="fa fa-times delete_product" cart_id="<?php echo $crow['id']; ?>"></i></td>
                        </tr>
						<?php 
						$count++; } ?>
                    </table>
					<?php }else{
						echo "<h4>Your cart is empty.</h4>";
					} ?>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">
							<a href="index.php" class="btn">Continue shopping</a> 
							<a href="checkout.php" class="btn">Checkout</a>                    
                        </div>
                    </div>
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
$(document).ready(function() {
	
	$(".product_qty").keyup(function(){ 
		var cart_id = $(this).attr("cart_id");	
		var product_id = $(this).attr("product_id");	
		var user_id = "<?php echo $_SESSION['user_id']; ?>";	
		var qty_value = $(this).val();
		
		if(qty_value != ''){
			$.ajax({    //create an ajax request to check_category.php
				type: "POST",
				url: "update_cart.php",             
				data: {user_id:user_id, cart_id:cart_id, product_id:product_id, product_qty:qty_value },               
				success: function(response){
					if(response == 1){		
						alert("Your cart is updated");
						window.location.href = "cart.php";
					}else{
						alert("Something went wrong.");
					}  
				}

			}); 
		} 
	});
	
		
	$(".delete_product").click(function() {                
		
		var cart_id = $(this).attr("cart_id");
		var user_id = "<?php echo $_SESSION['user_id']; ?>";		
		
		if(cart_id != ''){
			$.ajax({    //create an ajax request to check_category.php
				type: "POST",
				url: "delete_cart.php",             
				data: {user_id:user_id, cart_id:cart_id },               
				success: function(response){
					alert(response);
					if(response == 1){						
						window.location.href = "cart.php";
					}else{
						alert("Something went wrong.");
					}  
				}

			}); 
		} 
		
	});
});
</script>