<?php 
session_start();
unset($_SESSION['lablogin']);
header("location:portal.php");
?>