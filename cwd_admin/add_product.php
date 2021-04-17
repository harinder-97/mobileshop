<?php
include_once("includes/top.php");
include_once("includes/header.php"); 
include_once("inc_navigation.php"); ?>
<section class="right-panel">
	<div class="breads">
		Home / Add Product
	</div>

	<div class="page-title">
		<h1>Add Product</h1>
	</div>

<div class="main-content clearfix">
	<form class="sa-innate-form"  action="upload_product.php" method="POST" enctype="multipart/form-data" name="formUploadFile">
		
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">
			    <label class="label"><strong>Product Name*</strong></label>
					<label class="input">			   
					<input type="text" name="product_name" size="72"  required="required" class="form-control">			  
				</label>
			</section>
		</div>
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">
				<label class="label"><b>Product Category*</b></label>			
				<label class="select">
					<select name='product_category' required="required" class="form-control">
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
			    <label class="label"><strong>Product Price*</strong></label>
					<label class="input">			   
					<input type="number" name="product_price" size="72" step="any"  required="required" class="form-control">			  
				</label>
			</section>
		</div>
		<div class="row">           
            <section class="col-xs-12 col-sm-8 col-md-8">
				<label class="label"><strong>Product Details</strong></label>
				<label class="textarea">
					<textarea name="product_detail" rows="10" cols="80" required="required" class="form-control"></textarea>               
				</label>
            </section>
		</div>
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">
				<label class="label"><b>Is Featured</b></label>			
				<label class="select">
					<select name='is_featured' class="form-control">
						<option value="0">No</option>
						<option value="1">Yes</option>						
					</select><i></i>
				</label>
			</section>
		</div>
		<div class="row">
			<section class="col-xs-12 col-sm-8 col-md-8">
				<label class="label"><b>Image(s)*</b></label>
			
				<div class="input input-file">
					<input type="file" name="files[]" accept="image/*" id="upload_file" required="required" multiple="multiple" onchange="preview_image();">
				</div>
				<div id="image_preview"></div>
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
			<input type="submit" class="button true-btn pull-left" name="add_img" value="Upload" />
		</footer>          
	</form>
</div>
</section>
<script>
function preview_image() 
{
 var total_file=document.getElementById("upload_file").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
 }
}

</script>   

<style>
#image_preview img{
      width: 150px;
      padding: 5px;
      height: 150px;
}
</style>         
<?php include_once("includes/footer.php"); ?>