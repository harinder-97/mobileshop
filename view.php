<?php
if(!empty($_GET['pid']) && isset($_GET['pid'])){
require_once("header.php");

$pid = $_GET['pid'];
$_SESSION['product_id'] = $pid;
$pro_sql = "SELECT * from web_products WHERE _status=0 and id='".(int)$pid."' order by id DESC";
$pro_execute_sql = mysqli_query($conn, $pro_sql) or die("sql error");									
$pcount = mysqli_num_rows($pro_execute_sql);
if($pcount >= 1){
	$p_row = mysqli_fetch_assoc($pro_execute_sql);
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
						<?php
						$cid = $p_row['product_category'];
						$cat_sql = "SELECT * from web_category WHERE _status=0 and id='".(int)$cid."'";
						$cat_execute_sql = mysqli_query($conn, $cat_sql) or die("sql error");	
						$cat_row = mysqli_fetch_assoc($cat_execute_sql);
						if($cat_row >0){
							?>
                        <li><a href="listing.php?cid=<?php echo $cat_row['id']?>"><?php echo $cat_row['category_name']?>  &raquo;</a></li>
						<?php } ?>
						<li> <?php echo $p_row['product_name'];?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5">
                    <div class="box">
                        <div class="preview-pic tab-content">
							<?php
							$pi_sql = "SELECT * from web_productpics WHERE pid='".$p_row['id']."' order by id DESC";
							$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
							$pcount = mysqli_num_rows($pro_execute_sql);
							if($pcount >= 1){	
								$pres = 1;
								while($pi_row = mysqli_fetch_assoc($pi_execute_sql)){
								?>
								<div class="tab-pane <?php if($pres == 1){ echo 'active';} ?>" id="pic-<?php echo $pi_row['id']?>">
									<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $p_row['product_name'];?>" class="block__pic img-fluid">
								</div>                            
							<?php $pres++; } 
							} ?>
                        </div>
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
					<?php 
					$pi_sql = "SELECT * from web_productpics WHERE pid='".$p_row['id']."' order by id DESC";
					$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
					if($pcount >= 1){ 
					$pres =1;
						while($pi_row = mysqli_fetch_assoc($pi_execute_sql)){
							
					?>
                        <li <?php if($pres == 1){ echo 'class=active';} ?>>
                            <a data-target="#pic-<?php echo $pi_row['id']?>" data-toggle="tab"><img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="re-exc" /></a>
                        </li>
					<?php $pres++; }
					}	?>                        
                    </ul>
                </div>
                <div class="col-md-7 col-lg-7">
                    <div class="detail-inner">						
                        <h2><?php echo $p_row['product_name'];?></h2>
                        <h4>$<?php echo $p_row['price'];?></h4>
                        <p><?php echo $p_row['product_details'];?></p>
						<form>	
							<input type="hidden" id="pro_name" value="<?php echo $p_row['product_name'];?>" />						
							<input type="hidden" id="pro_price" value="<?php echo $p_row['price'];?>" />						
							<div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
							<input type="number" id="number" value="1" min="1" />
							<div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
							<p><a href="#" class="btn" id="add_cart">Add to Cart</a>
                        </form>
						
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-product related">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3> YOU MAY ALSO LIKE</h3>
                </div>
            </div>
            <div id="prods" class="carouseller">
                <a href="javascript:void(0)" class="carousel-button-left">‹</a>
                <div class="carousel-wrapper">
                    <div class="carousel-items">
					<?php
					$new_sql = "SELECT * from web_products WHERE _status=0 order by created_on DESC LIMIT 12";
					$n_execute_sql = mysqli_query($conn,$new_sql) or die("sql error");
					$count_records = mysqli_num_rows($n_execute_sql);
					if($count_records > 0){
						while($products = mysqli_fetch_assoc($n_execute_sql)){						
					?>
                        <div class="span3 carousel-block">
                            <div class="product">
                                <a href="view.php?pid=<?php echo $products['id']; ?>">
                                    <div class="clearfix">
										<?php
										$pi_sql = "SELECT * from web_productpics WHERE pid='".(int)$products['id']."' order by id DESC LIMIT 1";
										$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
										$pi_row = mysqli_fetch_assoc($pi_execute_sql);
										?>
										<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $products['product_name']; ?>" class="img-fluid">
                                        <p class="title"><?php echo $products['product_name']; ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
					<?php } 
					} ?>
                    </div>
                </div>
                <a href="javascript:void(0)" class="carousel-button-right">›</a>
            </div>
        </div>
    </div>
<?php
require_once("footer.php");
?>
<script>
$(function() {
	$('#prods').carouseller({
		scrollSpeed: 800,
		autoScrollDelay: 2600,
		easing: 'linear'
	});
});

function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0: value;
  value <= 1 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}


//add to cart
$(document).ready(function() {
	$("#add_cart").click(function() {                
		var user_id =  "<?php echo $_SESSION['user_id']; ?>";
		
		var qty = $("#number").val();
		var pro_name = $("#pro_name").val();
		var pro_price = $("#pro_price").val();
		var product_id = "<?php echo $pid; ?>";
		
		if(user_id  == ''){
			alert("Please Login First");
			window.location.href= "login_reg.php";
		}else{
			if(user_id != ''){
				$.ajax({    //create an ajax request to check_category.php
					type: "POST",
					url: "ajax_check.php",             
					data: {user_id:user_id, qty:qty, product_id:product_id, product_name:pro_name, pro_price: pro_price },               
					success: function(response){ 
						if(response == 1){						
							window.location.href = "cart.php";
						}else{
							alert("You are not able to add this product");
						}  
					}

				}); 
			} 
		}
	});
});

</script>
<?php }else{
	header("location: index.php");
}
}else{
	header("location: index.php");
}
?>