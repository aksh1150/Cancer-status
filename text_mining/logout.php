<?php
session_start();
unset($_SESSION['text_mining_current_login_user']);
session_destroy();
header("location:login.php");
?>