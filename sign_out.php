<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION);
session_destroy();
session_start();
//$_SESSION['success'] = 'You have logged out successfully!';
header('location:index.php');
exit();
?>