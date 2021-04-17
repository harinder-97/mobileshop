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

$sql = "SELECT * FROM web_products WHERE id='".(int)$id."'";
$uresult = mysqli_query($conn,$sql) or die(mysqli_error());


if(mysqli_num_rows($uresult) > 0)
{ 
$row = mysqli_fetch_assoc($uresult);
?> 
<section class="right-panel">
      <div class="breads">
        Home / Edit Product
      </div>

      <div class="page-title">
        <h1>Edit Product</h1>        
      </div>
	    <div class="main-content clearfix">
			<form class="sa-innate-form"  action="update_product.php" method="POST" enctype="multipart/form-data" name="formUploadFile">
			
			<div class="row">
				<section class="col-xs-12 col-sm-8 col-md-8">
					<label class="label"><strong>Product Name*</strong></label>
						<label class="input">			   
						<input type="text" name="product_name" size="72" value="<?php echo $row['product_name'];?>" required="required" class="form-control">			  
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
								while ($pcrow = mysqli_fetch_assoc($ce_sql) )
								{
									?>
									<option value="<?php echo $pcrow['id']; ?>" <?php if($pcrow['id'] == $row['product_category']){echo "selected"; } ?> ><?php echo $pcrow["category_name"]; ?></option>';

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
						<input type="number" name="product_price" size="72" step="any" value="<?php echo $row['price'];?>" required="required" class="form-control">			  
					</label>
				</section>
			</div>
			<div class="row">           
				<section class="col-xs-12 col-sm-8 col-md-8">
					<label class="label"><strong>Product Details</strong></label>
					<label class="textarea">
						<textarea name="product_detail" id="description" rows="10" cols="80" required="required" class="form-control"><?php echo $row['product_details'];?></textarea>               
					</label>
				</section>
			</div>
			<div class="row">
				<section class="col-xs-12 col-sm-8 col-md-8">
					<label class="label"><b>Is Featured</b></label>			
					<label class="select">
						<select name='is_featured' class="form-control">
							<option value="0" <?php if($row['is_featured'] == 0){echo "selected"; }?>>No</option>
							<option value="1" <?php if($row['is_featured'] == 1){echo "selected"; }?>>Yes</option>						
						</select><i></i>
					</label>
				</section>
			</div>
			<?php
			$pimg_sql = "SELECT * from web_productpics where pid='".(int)$id."' order by id DESC";
			$p_sql = mysqli_query($conn,$pimg_sql);
			$records = mysqli_num_rows($p_sql);
			if($records>0)
			{ 
				$p_count = 1;?>
				<div class="row">
					<section class="col col-12" id="pro_re">
						<label class="label"><b>Product Image</b></label>
						<p class="cat_error"></p>
							<?php
							while ($pirow = mysqli_fetch_assoc($p_sql) )
							{
								?>
								<div class="col-xs-12 col-sm-3 col-md-3 pro_img" id="pro_<?php echo $pirow['id']?>" p_count="<?php echo $p_count; ?>">
									<img src="../uploads/productpics/<?php echo $pirow['_img']?>" / alt="No Image" width="300px">
									<?php
									//if($p_count > 1){
									?>
									<div class="pro_img_delete" picid="<?php echo $pirow['id']?>"><i class="fa fa-trash" aria-hidden="true"></i></div>
									<?php //} ?>
								</div>
							<?php 
							$p_count++;
							}
							
						?>
					</section>
				</div>
				<?php
			}
			?>
					
			
			<div class="row">
				<section class="col-xs-12 col-sm-8 col-md-8">
					<label class="label"><b>Add Product Image(s)</b></label>
				
					<div class="input input-file">
						<input type="file" name="files[]" accept="image/*" id="upload_file" multiple="multiple" onchange="preview_image();">
					</div>
					<div id="image_preview"></div>
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
				<input type="hidden" name="pid" value="<?php echo $id; ?>" />
				<input type="submit" class="button true-btn pull-left" name="edit_img" value="Upload" />
			</footer>          
		</form> 
	</div>
</section>
<?php } 
require_once("includes/footer.php"); 
?>
 <script type="text/javascript">
  $(document).ready(function() {
    $(".pro_img_delete").click(function() {                
	var pr_imgid =  $(this).attr("picid");
	var parent_id = $(this).parent().attr('id');
	var p_count = $(this).parent().attr('p_count');
	
	if(pr_imgid != ''){
		$.ajax({    //create an ajax request to check_proimg.php
			type: "POST",
			url: "check_proimg.php",             
			data: {pr_imgid:pr_imgid},               
			success: function(response){   
				if(response == 1){
					alert("Product Image deleted."); 
					$("#"+parent_id).remove();
					
				}
				if(response == 0){				
					$(".cat_error").html("Product Image not deleted."); 
					$(".cat_error").css("color","red");					
				}
			}

		});
	} 
});
});

</script>  
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
