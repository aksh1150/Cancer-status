<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['text_mining_current_login_user'])) {
    header('location:login.php');
}
?>