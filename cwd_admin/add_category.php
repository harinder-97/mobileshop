<?php
require_once("includes/top.php");
require_once("includes/header.php");
require_once("inc_navigation.php"); 
?>

<section class="right-panel">
    <div class="breads">
        Home / Add Category
    </div>

    <div class="page-title">
        <h2>Add Category</h2>
    </div>

    <div class="main-content">
              <form class="sa-innate-form" action="add_category.php" method="POST" enctype="multipart/form-data">
              
                <div class="row">
                <section class="col-xs-12 col-sm-6 col-md-6">
                  <label class="label"><strong>Category Name*</strong></label>
                  <label class="input">
                   
                    <input type="text" name="category_name" id="cat_name" size="72"  required="required" class="form-control">
					<p class="cat_error"></p>
                  </label>
                </section>
               </div>                 
				<div class="row">    
					<section class="col-xs-12 col-sm-6 col-md-6">   
					<label class="label"><b>Status</b></label>  <input type='radio' name='status' value=0 checked="checked">Enable &nbsp; <input type='radio' name='status' value=1>  Disable 
					</section>
				</div>
                
				<footer>
					<input type="submit" name="submit_cat" value="Add" class="true-btn" id="add_category">
				</footer> 
			</form> 
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
					$("#add_category").attr('disabled', 'disabled');
					$(".cat_error").html("Category Name already exists."); 
					$(".cat_error").css("color","red"); 
					$(".cat_error").css("display","block"); 
				}
				else{
					$(".cat_error").css("display","none"); 
					$("#add_category").removeAttr('disabled');
				}
			}

		});
	}
});
});

</script>

<?php


 if(isset($_POST['submit_cat']) && !empty($_POST['submit_cat'])){
	
	$category_name = $_POST['category_name'];
	$status = $_POST['status'];
	
 $sql = "INSERT into web_category (category_name, _update, _status) values('$category_name', NOW(), '$status')";
			
   	if (mysqli_query($conn,$sql)) {
		$_SESSION['success'] = 'Category Added successfully!';	
	} else {
		$_SESSION['error'] = 'Category not Added';	
	}	
	
	echo '<script>window.location = "list_categories.php";</script>';
}   
?>