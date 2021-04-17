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

$sql = "SELECT * FROM web_category WHERE id='".(int)$id."'";
$uresult = mysqli_query($conn,$sql) or die(mysqli_error());
if(mysqli_num_rows($uresult) > 0)
{ 
$row = mysqli_fetch_assoc($uresult);
?> 
<section class="right-panel">
      <div class="breads">
        Home / Edit Category
      </div>

      <div class="page-title">
        <h1>Edit Category</h1>        
      </div>

      <div class="main-content clearfix">
            <form class="sa-innate-form" action="edit_category.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">  
				<div class="row">
					<section class="col-xs-12 col-sm-6 col-md-6">
					  <label class="label"><strong>Category Name*</strong></label>
					  <label class="input">					   
						<input type="text" name="category_name" id="cat_name" value="<?php echo $row['category_name'];?>" size="72"  required="required" class="form-control">
						<p class="cat_error"></p>
					    </label>
					</section>					
				</div> 
				
				<div class="row">
					<section class="col-xs-12 col-sm-6 col-md-6">   
						<label class="label"><b>Status</b></label>
						<input type='radio' name='status' value=0 <?php if($row['_status']==0) echo "checked"; ?>>Enable &nbsp; <input type='radio' name='status' value=1 <?php if($row['_status']==1) echo "checked"; ?>> Disable
					</section>
				</div>
				<br/>
			<footer>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="submit" name="submit_cont" value="Update" id="edit_category" class="button true-btn pull-left">
              </footer>      
                  
            </div>               
                   
      </form> 
           <?php } ?>      
         </div>
</section>
 
<?php
require_once("includes/footer.php"); 
?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#cat_name").keyup(function() {                
	var cat_name =  $("#cat_name").val();
	
	if(cat_name != ''){
		$.ajax({    //create an ajax request to check_category.php
			type: "POST",
			url: "check_category.php",             
			data: {cat_name:cat_name},               
			success: function(response){   
				if(response == 1){
					$("#edit_category").attr('disabled', 'disabled');
					$(".cat_error").html("Category Name already exists."); 
					$(".cat_error").css("color","red"); 
					$(".cat_error").css("display","block"); 
				}
				else{
					$(".cat_error").css("display","none"); 
					$("#edit_category").removeAttr('disabled');
				}
			}

		});
	}
});
});

</script>
<?php

if(isset($_POST['submit_cont'])){
	$category_name= $_POST['category_name'];
	
	$sql='UPDATE web_category set category_name="'.$category_name.'", _update=NOW(),_status="'.$_POST['status'].'"';
			
	$sql.=' where id="'.(int)$_POST["id"].'"';
	
		
	if(mysqli_query($conn,$sql)) {
		$_SESSION['success'] = 'Category updated successfully!';	
	} else {
		$_SESSION['error'] = 'Error updating Category';	
	}

  echo '<script>window.location = "list_categories.php";</script>';
		
} 
?>
           
