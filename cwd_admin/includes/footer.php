<div class="copyright">
    &copy; 2021. All Rights Reserved.
</div>
<?php
if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	unset($_SESSION['error']);
}

?> 
<script src="js/jquery-slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="js/sidebar-menu.js"></script>

<script>
	$.sidebarMenu($('.sidebar-menu'))
			//fullscreen mode on button click
			function requestFullScreen() {

			  var el = document.body;

			  // Supports most browsers and their versions.
			  var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen 
			  || el.mozRequestFullScreen || el.msRequestFullScreen;

			  if (requestMethod) {

			    // Native full screen.
			    requestMethod.call(el);

			  } else if (typeof window.ActiveXObject !== "undefined") {

			    // Older IE.
			    var wscript = new ActiveXObject("WScript.Shell");

			    if (wscript !== null) {
			      wscript.SendKeys("{F11}");
			    }
			  }
			}

			// toggle button show class on big screen
			
			$(window).bind("resize", function () {
				console.log($(this).width())
				if ($(this).width() < 768) {
					$(".sidebar-menu").removeClass("show");
				} 
				else if ($(this).width() > 767) {
					$(".sidebar-menu").addClass('show')
				}
			}).trigger('resize');

			
		</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 
<script>
$(function(){
 var path = window.location.href; 
	 $('ul a').each(function() {
	  if (this.href === path) {
	   $(this).addClass('activelink');
	  }
  });
  if ($('.sidebar-submenu li a').hasClass('activelink')) {
	$('.sidebar-submenu li a.activelink').parent().parent().parent().addClass('active');
  }
});
</script>
   
    </body>
</html>