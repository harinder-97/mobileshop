<?php
require_once("header.php");
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
					<li> Log In/ Sign Up</li>
				</ul>
			</div>
		</div>
	</div>
</div>


<div class="product-inner">
<div class="container">
	<div class="row">
	
	<?php 
	if (isset($_SESSION['error']) && $_SESSION['error'] <>"")
	{?>
	<div class="col-md-12">
	<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> 
		<?php echo trim($_SESSION['error']);?></div> </div>
	<?php   }
		?>
	<?php 	
	if (isset($_SESSION['success']) && $_SESSION['success'] <>"")
		{?>
	<div class="col-md-12">
	<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo trim($_SESSION['success']);?></div></div>
	<?php   } ?>
	
		<div class="log_reg" id="log_reg">
			<div class="form-log_reg sign-up-log_reg">
				<form action="register.php" method="POST" onsubmit="return usernameval() && usernameval1() && emailval() && validate()">
					<h1>Create Account</h1>
					<!--span>or use your email for registration</span-->
					<input type="text" name="first_name" placeholder="First Name" onchange="usernameval()" id="user" required />
					<input type="text" name="last_name" placeholder="Last Name" onchange="usernameval1()" id="user_1"  required />
					<input type="email" name="email" placeholder="Email" id="user_email" onchange="emailval()" required />
					<p class="error"></p>
					<input type="password" name="password" required="required" placeholder="Password" id="password" onchange="return validate()" minlength="8" />
					<input type="tel" name="phone_number" placeholder="Phone Number" title="Please enter 10 digit phone number" pattern="[0-9]{10}" required="required" />
					<textarea name="address" placeholder="Enter Address..." required="required"></textarea> 
					<!--button>Sign Up</button-->
					<input type="submit" value="Sign Up" name="signup" id="signup" class="lr_btn"/>
				</form>
			</div>
			<div class="form-log_reg sign-in-log_reg">
				<form action="register.php" method="POST">
					<h1>Sign in</h1>
					<span>or use your account</span>
					<input type="email" name="email" placeholder="Email" required />
					<input type="password" name="password" placeholder="Password" required />
					<input type="submit" value="Sign In" name="signin" class="lr_btn"/>
				</form>
			</div>
			<div class="overlay-log_reg">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Welcome Back!</h1>
						<p>To keep connected with us please login with your personal info</p>
						<button class="ghost lr_btn" id="signIn">Sign In</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Hello, Friend!</h1>
						<p>Enter your personal details and start journey with us</p>
						<input type="submit" value="Sign Up" name="signup" class="ghost lr_btn" id="signUp" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const log_reg = document.getElementById('log_reg');

signUpButton.addEventListener('click', () => {
	log_reg.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	log_reg.classList.remove("right-panel-active");
});

</script>

<?php
if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	unset($_SESSION['error']);
}
require_once("footer.php");
?>
<script>

$(document).ready(function() {
	$(".error").css("display", "none"); 
    $("#user_email").keyup(function() {                
		var user_email =  $("#user_email").val();
		
		  $.ajax({    //create an ajax request 
			type: "POST",
			url: "check_customer.php",             
			data: {user_email: user_email},                 
			success: function(response){   
				if(response == 1){
					$(".error").html("Email already exists. Please try with some other email."); 
					$(".error").css("color", "red"); 
					$("#signup").attr('disabled', 'disabled');
					$(".error").css("display", "block"); 
				}
				if(response == 0){
					$("#signup").removeAttr('disabled');
					$(".error").css("display", "none"); 
				}
				
			}

		});
	});
});


function validate()
	{
		var pwd=document.getElementById("password").value;
		//var cpwd=document.getElementById("confirm_password").value;
		var pattern=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
		     if(!pwd.match(pattern))
	         {
			     alert("password must contain minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character");
			     return false;
	         }
		     return true;
		}
		function usernameval()
{
	var user=document.getElementById("user").value;
	var regex= /^[a-zA-Z]+$/
	    if(!user.match(regex))
          {
		   alert("First name should contain albhabets only!");
		   return false;
		  }
		  return true;
	}
	function usernameval1()
{
	var user=document.getElementById("user_1").value;
	var regex= /^[a-zA-Z]+$/
	    if(!user.match(regex))
          {
		   alert("Last name should contain albhabets only!");
		   return false;
		  }
		  return true;
	}
function emailval()
{
   var em=document.getElementById("user_email").value;
   var reg =/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(gmail|yahoo|hotmail|icloud)\.com$/	
       if(!em.match(reg))
	   {
		   
		alert("invalid email address");   
		return false;   
		   
	   }
	
       return true;



} 
</script>