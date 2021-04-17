<?php
require_once("header.php");
?>

<div class="contact-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="C-inner">
                        <h1>Contact Us</h1>
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
                        <li><a href="index.html">Home  &raquo;</a></li>
                        <li>Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--about us-->

    <div class="contact-inner grey">
        <div class="container">
            <div class="row">
				<div class="col-md-12">
				<?php
					if(isset($_SESSION['msg'])){
						if($_SESSION['msg'] == 1){
							echo '<div class="alert alert-success" role="alert">
							  Thank you for contacting us!
							</div>';							
						}
						if($_SESSION['msg'] == 0){
							echo '<div class="alert alert-danger" role="alert">
								Sorry! Something went wrong. Please try again later.
							</div>';
						}
					}
				?>
				</div>
                <div class="col-md-7">
                    <h2>Contact Information</h2>
                    <address>
                        <p class="main"><strong>MOBILE SHOP Pvt. Ltd.</strong></p>
                        <p class="title"><strong> <i class="fa fa-map-marker"></i> Address</strong></p>
                        <p class="sub"> 12, ABC, ABC street, Toronto-144 021.Canada.</p>
                        <hr>
                        <p class="title"><strong><i class="fa fa-phone"></i> Phone No</strong></p>
                        <p class="sub"> +14378862762, +14378863140</p>
                        <hr>
                        <p class="title"><strong><i class="fa fa-fax"></i> Fax</strong></p>
                        <p class="sub">+14378863264</p>
                        <hr>
                        <p class="title"><strong><i class="fa fa-envelope-o"></i> Email Id</strong></p>
                        <p class="sub"> info@mobileshop.com</p>
                    </address>
                </div>
                <div class="col-md-5">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d41318790.21553134!2d-130.21730212202513!3d50.7959837332579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4b0d03d337cc6ad9%3A0x9968b72aa2438fa5!2sCanada!5e0!3m2!1sen!2sin!4v1614842618235!5m2!1sen!2sin" width="100%" height="550" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>                    
                </div>
            </div>

        </div>
    </div>

    <div class="contact-inner ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Get In Touch</h3>
                    <form action="send_contact.php" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input type="tel" id="phone" name="phone" placeholder="123-455-6789" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" title="Please enter required pattern" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email Id</label>
                                    <input type="email" name="email" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" rows="4" class="form-control" placeholder="" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="contact_submit" class="btn">Send <i class="fa fa-paper-plane-o"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<?php 
unset($_SESSION['msg']);
require_once("footer.php");
?>
