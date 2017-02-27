<?php
session_start();
unset($_SESSION['login_admin_name']);
session_destroy();
header("location:login.php");
?>