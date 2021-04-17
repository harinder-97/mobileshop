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

$sql = "SELECT * FROM web_customers WHERE id='".(int)$id."'";
$uresult = mysqli_query($conn,$sql) or die(mysqli_error());
$row = mysqli_fetch_assoc($uresult);

if(mysqli_num_rows($uresult) > 0)
{ 
?> 
<section class="right-panel">
      <div class="breads">
        Home / Edit Customer
      </div>

      <div class="page-title">
        <h1>Edit Customer</h1>        
      </div>

      <div class="main-content clearfix">
            <form>  
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>First Name*</strong></label>
							<label class="input">			   
							<input type="text" name="first_name" size="72" value="<?php echo $row['first_name'];?>" required="required" class="form-control">			  
						</label>
					</section>
				</div>
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>Last Name*</strong></label>
							<label class="input">			   
							<input type="text" name="last_name" size="72" value="<?php echo $row['last_name'];?>" required="required" class="form-control">			  
						</label>
					</section>
				</div>
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>Email*</strong></label>
							<label class="input">			   
							<input type="email" name="email" size="72" value="<?php echo $row['email'];?>" required="required" class="form-control">			  
						</label>
					</section>
				</div>
				<div class="row">
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>Phone Number*</strong></label>
							<label class="input">
							<input type="tel" name="phone_number" placeholder="1234567891" value="<?php echo $row['phone_no'];?>" title="Please enter 10 digit phone number" pattern="[0-9]{10}" size="72" required="required" class="form-control">
						</label>
					</section>
				</div>
				<div class="row">           
					<section class="col-xs-12 col-sm-8 col-md-8">
						<label class="label"><strong>Address</strong></label>
						<label class="textarea">
							<textarea name="address" rows="10" cols="80" required="required" class="form-control"><?php echo $row['address'];?></textarea>               
						</label>
					</section>
				</div>				
				<br/>
			<footer>     
				<a href="list_customers.php" class="button true-btn pull-left">Back</a>
              </footer>      
                  
            </div>               
                   
      </form> 
           <?php } ?>      
         </div>
</section>
 
<?php
require_once("includes/footer.php"); 

?>
           
