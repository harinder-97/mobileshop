<?php
include_once("includes/top.php");
include_once("includes/header.php"); 
include_once("inc_navigation.php"); ?>
<section class="right-panel">
	<div class="breads">
		Home / Add Sale Offer
	</div>

	<div class="page-title">
		<h1>Add Sale Offer</h1>
	</div>

<div class="main-content clearfix">
	<form class="sa-innate-form" action="add_sale.php" method="POST">
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
							while ($row = mysqli_fetch_assoc($ce_sql) )
							{
								echo '<option value="'.$row["id"].'">'.$row["category_name"].'</option>';
							}
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
											
					</select><i></i>
				</label>
			</section>
		</div>
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">
				<label class="label"><strong>Product Price*</strong></label>
				<label class="input">			   
				<input type="text" name="product_price" size="72" value="" readonly id="product_price" class="form-control">		  
			  </label>
			</section>
		</div>
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">
				<label class="label"><strong>Discount on Product* (In Precentage %)</strong></label>				
				<label class="select">
					<select name='discount' required="required" class="form-control">
						<option value="10">10</option>					
						<option value="20">20</option>					
						<option value="30">30</option>					
						<option value="40">40</option>					
						<option value="50">50</option>					
						<option value="60">60</option>					
						<option value="70">70</option>				
					</select><i></i>
				</label>
			</section>
		</div>
		
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">  
				<label class="label"><b>Status</b></label> 				 
					<input type='radio' name='status' value=0 checked="checked">Enable &nbsp; <input type='radio' name='status' value=1 >Disable
				</label> 
			</section>
		</div>
		<br/>
		<footer>
			<input type="submit" class="button true-btn pull-left" name="add_sale" value="Submit" />
		</footer>          
	</form>
</div>
</section>

<?php include_once("includes/footer.php"); ?>


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

<?php
if(isset($_POST['add_sale']) && (!empty($_POST['add_sale']))){
	$product_category = $_POST['product_category'];
	$product_id = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$discount = $_POST['discount'];
	$status = $_POST['status'];
	
	$sql = "INSERT into web_sale (product_category, product_id, product_price, discount, updated_on, _status) values('$product_category', '$product_id', '$product_price', '$discount', NOW(), '$status')";
	
		
	if (mysqli_query($conn,$sql)) {
		$_SESSION['success'] = 'Product Sale Added successfully!';	
	} else {
		$_SESSION['error'] = 'Product Sale not Added';	
	}		
	echo '<script>window.location = "list_sales.php";</script>';
	
}   

?>

