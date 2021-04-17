<?php
if(!empty($_GET['cid']) && isset($_GET['cid'])){
require_once("header.php");
$cid = $_GET['cid'];
$cat_sql = "SELECT * from web_category WHERE _status=0 and id='".(int)$cid."'";
$cat_execute_sql = mysqli_query($conn, $cat_sql) or die("sql error");	
$cat_row = mysqli_fetch_assoc($cat_execute_sql);
if($cat_row >0){
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
                        <li> <?php echo html_entity_decode($cat_row["category_name"]); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="product-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <p><a href="javascript:void(0)" id="brands" data-toggle="collapse">Brands <i class="fa fa-plus"></i></a></p>
                        <ul class="brands">
						<?php
						$scat_sql = "SELECT * from web_category WHERE _status=0 order by category_name";
						$scat_execute_sql = mysqli_query($conn, $scat_sql) or die("sql error");	
						
						while($scat_row = mysqli_fetch_assoc($scat_execute_sql)){
						?>
                            <li <?php if($cid == $scat_row["id"]){ echo 'class="active"'; }?>><a href="listing.php?cid=<?php echo $scat_row["id"]; ?>"><?php echo $scat_row["category_name"]; ?></a></li>
						<?php 
						 } ?>
                        </ul>                       
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?php echo $cat_row["category_name"]; ?></h2>
                        </div>
                    </div>
                    <div class="row">
						<?php
						$pro_sql = "SELECT * from web_products WHERE _status=0 and product_category='".$cat_row['id']."' order by id DESC LIMIT 20";
						$pro_execute_sql = mysqli_query($conn, $pro_sql) or die("sql error");									
						$pcount = mysqli_num_rows($pro_execute_sql);
						if($pcount >= 1){										
							while($pro_row = mysqli_fetch_assoc($pro_execute_sql)){
						?>
							<div class="col-md-6 col-lg-4">
								<a href="view.php?pid=<?php echo $pro_row['id']; ?>">
									<div class="box">
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
										<p class="product_name"><span><?php echo $pro_row['product_name']; ?></span></p>
										<p><b>$<?php echo $pro_row['price']; ?></b></p>
									</div>
								</a>
							</div>
						<?php 
						    }
						}else{
						?>
						<div class="col-md-12">
						<h3>No Product Available</h3>
						</div>
						<?php } ?>

                        <!--div class="col-md-12 text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div-->
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
require_once("footer.php");
?>

<script> 
	$('#brands').click(function() {
		$('.brands').toggle('100');
	});
</script>
<?php
}else{
	header("location:index.php");
}
}else{
	header("location:index.php");
}
?>
