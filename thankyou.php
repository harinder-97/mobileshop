<?php
require_once("header.php");
if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
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
                        <li> Thank You</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="addtocart thank_you">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<h1>Thank you for placing order with Mobile store</h1>
                </div>
				<div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">
							<a href="index.php" class="btn">Continue shopping</a>             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
unset($_SESSION['product_id']);
}else{
	header("location:index.php");
}
require_once("footer.php");
?>
<script>
$(document).ready(function(){
	$("#new_address").hide();
})
	
function valueChanged()
{
	if($('#change_address').is(":checked"))   
		$("#new_address").show();
	else
		$("#new_address").hide();
}

</script>