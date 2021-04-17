<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="contact-mail">
                    <p>For More Enquiry Contact Us <a href="tel:1812650779" class="btn"> +14378863140</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
				<div class="col-md-6 col-lg-4">
                    <h4>Mobile Shop</h4>                    
                </div>                
                <div class="col-md-6 col-lg-2">
                    <h5>Categories</h5>
					<?php
					$cat_sql = "SELECT * FROM web_category WHERE _status='0' ORDER BY category_name LIMIT 5";
					$cat_result = mysqli_query($conn,$cat_sql) or die(mysqli_error());

					if(mysqli_num_rows($cat_result) > 0)
					{ ?>
						<ul>
						<?php
						while($cat_row = mysqli_fetch_assoc($cat_result)){
						?>
							<li><a href="listing.php?cid=<?php echo $cat_row['id']?>"><?php echo $cat_row['category_name']?></a></li>
						<?php }  ?>
						</ul>
					<?php } ?>					
                </div>
				<div class="col-md-6 col-lg-2">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login_reg.php">Register</a></li>						
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="contactus.php">Contact Us</a></li>
                    </ul>
                </div>
				<div class="col-md-6 col-lg-4">
                    <h4>Contact Us</h4>
                    <address>
                        <p><strong>MOBILE SHOP Pvt. Ltd.</strong></p>
                        <p><i class="fa fa-map-marker"></i> 12, ABC,ABC Road,
                            Toronto-144 021.Canada.</p>
                            <p><i class="fa fa-phone"></i>+14378862762, +14378863140</p>
                            <p><i class="fa fa-fax"></i>+14378863264</p>
                            <p><i class="fa fa-envelope-o"></i> info@mobileshop.com</p>
                    </address>
                </div>
                
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <p>MOBILE SHOP PVT. LTD. © 2021</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:" id="return-to-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- JS files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>	
    <script src="js/carouseller.js"></script>
    <script src="js/sina-nav.js"></script>

    <!-- For All Plug-in Activation & Others -->
    <script>
	
	
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
                $('#return-to-top').fadeIn(200);
            } else {
                $('#return-to-top').fadeOut(200);
            }
        }
        $(document).ready(function() {
            $("#return-to-top").click(function(event) {
                event.preventDefault();
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
                return false;
            });

        });

        $(' .nav-tabs li').click(function() {
            $(this).addClass('active').siblings().removeClass('active')
        })
    </script>
</body>

</html>