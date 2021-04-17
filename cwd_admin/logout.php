<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['authenValid']);
unset($_SESSION['authen_key']);
unset($_SESSION['captcha_code']);
unset($_SESSION);
session_destroy();
session_start();
$_SESSION['success'] = 'You have logged out successfully!';
header('location:index.php');
exit();
?>