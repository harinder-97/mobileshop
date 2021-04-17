<?php
require_once("includes/top.php");
require_once("includes/header.php");
require_once("inc_navigation.php"); 
  
if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];    
}else{
    session_destroy();	
	echo '<script>window.location = "index.php";</script>';	
}

$sql = "SELECT * FROM web_sale WHERE id='".(int)$id."'";
$uresult = mysqli_query($conn,$sql) or die(mysqli_error());
$row = mysqli_fetch_assoc($uresult);

if(mysqli_num_rows($uresult) > 0)
{ 
?> 
<section class="right-panel">
      <div class="breads">
        Home / Edit Sale Offer
      </div>

      <div class="page-title">
        <h1>Edit Sale Offer</h1>        
      </div>

      <div class="main-content clearfix">
            <form class="sa-innate-form" action="edit_sale.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">  
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><b>Product Category*</b></label>			
						<label class="select">
							<select name='product_category' id="pro_category" required="required" class="form-control">
								<option value="">--SELECT PRODUCT CATEGORY--</option>
								<?php
								$cat_sql = "SELECT * from web_category where _status=0 order by id DESC";
								$ce_sql = mysqli_query($conn,$cat_sql);
								$count_records = mysqli_num_rows($ce_sql);
								if($count_records>0)
								{
									while ($pcrow = mysqli_fetch_assoc($ce_sql) )
									{ ?>
										<option value="<?php echo $pcrow["id"] ?>" <?php if($row['product_category'] == $pcrow["id"]){ echo "selected"; } ?>><?php echo $pcrow["category_name"] ?></option>';
									<?php }
								}
								?>
							</select><i></i>
						</label>	
					</section>
				</div>
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><b>Product Name*</b></label>			
						<label class="select">
							<select name='product_name' required="required" class="form-control" id="products">
							<?php
							$product_id = $row['product_name'];
							$sql = "SELECT `id`, `product_name` FROM `web_products` where id='".$product_id."' and _status=0 ORDER BY id ASC";
							$query = mysqli_query($conn,$sql); 
							if (mysqli_num_rows($query) > 0) {
							   while ($prow = mysqli_fetch_assoc($query) )
								{
									?>
									<option value="<?php echo $prow["id"]; if($row['product_name'] == $prow["id"]){ echo "selected"; } ?>"><?php echo $prow["product_name"]?></option>';
								<?php } 
							}
							?>						
							</select><i></i>
						</label>
					</section>
				</div>
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>Product Price*</strong></label>
						<label class="input">			   
						<input type="text" name="product_price" size="72" value="<?php echo $row['product_price'];?>" readonly id="product_price" class="form-control">		  
					  </label>
					</section>
				</div>
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>Discount on Product* (In Precentage %)</strong></label>				
						<label class="select">
							<select name='discount' required="required" class="form-control">
								<option value="10" <?php if($row['discount'] == "10"){ echo "selected"; } ?>>10</option>					
								<option value="20" <?php if($row['discount'] == "20"){ echo "selected"; } ?>>20</option>					
								<option value="30" <?php if($row['discount'] == "30"){ echo "selected"; } ?>>30</option>					
								<option value="40" <?php if($row['discount'] == "40"){ echo "selected"; } ?>>40</option>					
								<option value="50" <?php if($row['discount'] == "50"){ echo "selected"; } ?>>50</option>					
								<option value="60" <?php if($row['discount'] == "60"){ echo "selected"; } ?>>60</option>					
								<option value="70" <?php if($row['discount'] == "70"){ echo "selected"; } ?>>70</option>				
							</select><i></i>
						</label>
					</section>
				</div>
				
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">   
						<label class="label"><b>Status</b></label>
						<input type='radio' name='status' value=0 <?php if($row['_status']==0) echo "checked"; ?>>Enable &nbsp; <input type='radio' name='status' value=1 <?php if($row['_status']==1) echo "checked"; ?>> Disable
					</section>
				</div>
				<br/>
				<footer>
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<input type="submit" name="submit_cont" value="Update" class="button true-btn pull-left">
				  </footer>      
                  
            </div>               
                   
      </form> 
           <?php } ?>      
         </div>
</section>
 
<?php
require_once("includes/footer.php"); 

if(isset($_POST['submit_cont']) && (!empty($_POST['submit_cont']))){
	$product_category = $_POST['product_category'];
	$product_id = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$discount = $_POST['discount'];
	$status = $_POST['status'];	
	
	$sql='UPDATE web_sale set product_category="'.$product_category.'", product_id="'.$product_id.'", product_price="'.$product_price.'", discount="'.$discount.'", updated_on=NOW(), _status="'.$_POST['status'].'"';
		
	$sql.=' where id="'.(int)$_POST["id"].'"';
	
	if(mysqli_query($conn,$sql)) {
		$_SESSION['success'] = 'Sale Offer updated successfully!';	
	} else {
		$_SESSION['error'] = 'Error updating Sale Offer';	
	}

	echo '<script>window.location = "list_sales.php";</script>';		

} 
?>


<script type="text/javascript">
$("#pro_category").change(function () {
    var str = "";
    $( "#pro_category option:selected" ).each(function() {
      str += $( this ).val() + " ";
    });
	
	if(str != ''){
		$.ajax({    //create an ajax request to check_category.php
			type: "POST",
			url: "check_category.php",             
			data: {product_category:str},               
			success: function(response){   
				if(response){
					$("#products").html(response);
				}				
			}

		});
	}
})



$("#products").change(function () {
    var pstr = "";
    $( "#products option:selected" ).each(function() {
      pstr += $( this ).val() + " ";
    });
	
	if(pstr != ''){
		$.ajax({    //create an ajax request to check_category.php
			type: "POST",
			url: "check_category.php",             
			data: {product_id:pstr},               
			success: function(response){   
				if(response){
					$("#product_price").val(response);
				}				
			}

		});
	}
})

</script>   
