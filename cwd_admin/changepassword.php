<?php
  include_once("includes/top.php");
  include_once("includes/header.php");
  include_once("inc_navigation.php"); ?>    
<section class="right-panel">
      <div class="breads">
        Home / Change Password
      </div>
      <br/>
<?php 
if (isset($_GET['error_msg']) && $_GET['error_msg'] <>"")
      //  if(trim($_GET['msg']) <> "")
        {?>
      <div class="alert alert-danger">
       <a href="#" class="close" data-dismiss="alert">&times;</a>
          <?php echo trim($_GET['error_msg']);?></div>
      <?php   }
       if (isset($_GET['msg']) && $_GET['msg'] <>"")
      //  if(trim($_GET['msg']) <> "")
        {?>
      <div class="alert alert-success">
       <a href="#" class="close" data-dismiss="alert">&times;</a>
          <?php echo trim($_GET['msg']);?></div>
      <?php   }
        ?>
      <div class="page-title">
        <h1>Change Password</h1>
      </div>
		<div class="main-content">
            <form class="sa-innate-form" action="updatepassword.php" method="POST" enctype="multipart/form-data">
				<div class="row"> 
					<section class="col col-6">
						<label class="label"><strong>Old Password*</strong></label>
						<label class="input">                   
                    <input type="password" class="form-control" name="txtoldpassword"  size="72" required="required">
                  
                  </label>
                </section>
                </div>
                 <div class="row">      

					<section class="col col-6">
                  <label class="label"><strong>New Password*</strong></label>
                  <label class="input">
                   
                    <input type="password" class="form-control" name="txtnewpassword"  size="72" required="required">
                  
                  </label>
                </section>
                </div>
                <div class="row">
				<section class="col col-6">
                  <label class="label"><strong>Re-Type New Password*</strong></label>
                  <label class="input">
                       <input type="password" class="form-control" name="txtnewpassword2"  size="72"  required="required">                  
                  </label>
                </section>
                </div>
              
                <input type="submit" name="submit_pass" value="Change" class="true-btn">
                <input type="reset" class="true-btn" value="Reset">               
      </form> 
                  
        </div>
    </section>      
<?php
include_once("includes/footer.php"); 
?>
           
