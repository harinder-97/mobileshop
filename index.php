<?php
require_once("header.php");
?>
    <div class="banner">
        <div class="carousel slide carousel-fade" id="myslider" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item  active">
                    <img src="images/gh1.jpg" alt="Banner 1" width="100%">
                </div>
                <div class="carousel-item">
                    <img src="images/f.jpg" alt="Banner 2" width="100%">
                </div>
                <div class="carousel-item">
                    <img src="images/high1.jpg" alt="Banner 3" width="100%">
                </div>
            </div>
            <a class="carousel-control-prev" href="#myslider" data-slide="prev">
                <span><i class="fa fa-angle-left"></i> </span>
            </a>
            <a class="carousel-control-next" href="#myslider" data-slide="next">
                <span><i class="fa fa-angle-right"></i> </span>
            </a>
        </div>
    </div>
    <!--about us-->

    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Welcome To Mobile Shop</h1>
                    <p>The Phones You've Always Wanted You'll Love the Prices.
You shouldn't have to spend a fortune on a new phone. Take a look at our most recent specials.We'll keep you connected.
We're still striving to provide Canadians with what they want: affordable access to a fast network.<p>
                    <a href="aboutus.php" class="btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
	
	
	<div class="new-products">
		<div class="container">
			<div class="new-products-inner">
				<div class="row">
					<div class="col-md-12 text-center">
						 <h3>New Products</h3>				  
					</div>			
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
								<div class="clearfix pro_img">									
									<a href="view.php?pid=<?php echo $products['id']; ?>">
										<?php
										$pi_sql = "SELECT * from web_productpics WHERE pid='".(int)$products['id']."' order by id DESC LIMIT 2";
										$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
										$pi_count = mysqli_num_rows($pi_execute_sql);
										if($pi_count >=1){
											$pic_count = 1;
											while($pi_row = mysqli_fetch_assoc($pi_execute_sql)){
											?>
											
												<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $products['product_name']; ?>" class="img-fluid <?php if($pic_count == 2){echo 'hover_img';}else{echo 'main_img';}?>">
												<?php
												if($pic_count == 2){ ?>
													<style>
													.pro_img:hover .hover_img{
														display: block;
													}
													</style>
												<?php }
												$pic_count++;
												?>
											<?php }											
										}?>
									</a>
									<!--<div class="w3_hs_bottom w3_hs_bottom_sub">
										<ul>
											<li>
												<a href="listing.php?id=<?php //echo $products['id']?>" data-toggle="modal" data-target="#myModal6"><i class="fa fa-eye"></i></a>
											</li>
										</ul>
									</div	-->
									<h5><?php echo $products['product_name']; ?></h5>
									<h6>$<?php echo $products['price']?></h6>
								</div>                                
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
		

	<div class="mobile-back">
		<div class="container">
			<div class="mobile-back-inner">
				<div class="row">
					<div class="col-md-12 text-right">
						 <h3>Sales On Products</h3>
						  <a href="#" class="btn">Shop Now <i class="fa fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
    </div>
	
    <div class="product-range">
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <h2>Our Product Range</h2>
                    <div class="sub">
                        <p>Listed below are the products in our inventory.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                            <div class="product-box">
                                <ul class="nav nav-tabs">
									<?php
									$cat_sql = "SELECT * from web_category WHERE _status=0 order by id DESC LIMIT 4";
									$cat_execute_sql = mysqli_query($conn, $cat_sql) or die("sql error");									
									$count = mysqli_num_rows($cat_execute_sql);
									if($count >= 1){
										$res=1;
										while($cat_row = mysqli_fetch_assoc($cat_execute_sql)){
									?>
										<li <?php if($res == 1){ echo 'class="active"'; }?>><a href="#pro_<?php echo $cat_row['id']?>" data-toggle="tab"><?php echo $cat_row['category_name']?></a></li>
										<?php 
										$res++; } 
									}	?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
								<?php
									$res=1;
									$cat_sql = "SELECT * from web_category WHERE _status=0 order by id DESC LIMIT 4";
									$cat_execute_sql = mysqli_query($conn, $cat_sql) or die("sql error");	
									while($cat_row = mysqli_fetch_assoc($cat_execute_sql)){
								?>														
                                <div class="tab-pane fade<?php if($res==1){echo ' show in active';}?>" id="pro_<?php echo $cat_row['id']?>">
                                    <div class="row">
									<?php
									$pro_sql = "SELECT * from web_products WHERE _status=0 and product_category='".$cat_row['id']."' order by id DESC LIMIT 8";
									$pro_execute_sql = mysqli_query($conn, $pro_sql) or die("sql error");									
									$pcount = mysqli_num_rows($pro_execute_sql);
									if($pcount >= 1){										
										while($pro_row = mysqli_fetch_assoc($pro_execute_sql)){
									?>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="box">
                                                <a href="view.php?pid=<?php echo $pro_row['id']; ?>">
													<?php
													$pi_sql = "SELECT * from web_productpics WHERE pid='".(int)$pro_row['id']."' order by id DESC LIMIT 2";
													$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
													$pi_count = mysqli_num_rows($pi_execute_sql);
													if($pi_count >=1){
														$pic_count = 1;
														while($pi_row = mysqli_fetch_assoc($pi_execute_sql)){
														?>															
															<img src="uploads/productpics/<?php echo $pi_row['_img']?>" alt="<?php echo $pro_row['product_name']; ?>" class="img-fluid <?php if($pic_count == 2){echo 'hover_img';}else{echo 'main_img';}?>">
															<?php
															if($pic_count == 2){ ?>
																<style>
																.box:hover .hover_img{
																	display: block;
																}
																</style>
															<?php }
															$pic_count++;
															?>
														<?php }											
													}?>
												
												
												
												
													<?php
													/* $pi_sql = "SELECT * from web_productpics WHERE pid='".$pro_row['id']."' order by id DESC LIMIT 1";
													$pi_execute_sql = mysqli_query($conn,$pi_sql) or die("sql error");
													$pi_row = mysqli_fetch_assoc($pi_execute_sql); */
													?>
													<!--img src="uploads/productpics/<?php //echo $pi_row['_img']?>" alt="<?php //echo $pro_row['product_name']; ?>" class="img-fluid"-->
                                                    <p><?php echo $pro_row['product_name']; ?></p>													
                                                </a>
                                            </div>											
                                        </div>										
                                        <?php }
									} ?>
                                    </div>
                                </div>								
							<?php $res++;
							} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
    </div>

   
   
	<div class="coupons">
	<div class="container">
	   <div class="cuopons-inner">
        <div class="row">
            <div class="col-md-3">
                 <h3>Buy your product in a simple way</h3>
            </div>
			<div class="col-md-3 text-center">
                 <span><i class="fa fa-user"></i></span>
				 <h4>LOGIN TO YOUR ACCOUNT</h4>
            </div>
			<div class="col-md-3 text-center">
			 <span><i class="fa fa-check"></i></span>
				<h4>SELECT YOUR ITEM</h4>
            </div>
			<div class="col-md-3 text-center">
			<span><i class="fa fa-credit-card"></i></span>
				 <h4>MAKE PAYMENT</h4>
            </div>
        </div>
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
		/* pause: true,
        interval: false */
	});
});

/*
    Carousel
*/
$('#carousel-example').on('slide.bs.carousel', function (e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 5;
    var totalItems = $('.carousel-item').length;
 
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});


/*Popup */

$(document).ready(function() {    
	setTimeout(function () {
		$(".popup").fadeIn()
	}, 4000);	
	$(".popup_close").click(function(){
		$(".popup").fadeOut(1000);
	})

});
</script>