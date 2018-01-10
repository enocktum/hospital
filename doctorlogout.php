<?php 
session_start();
unset($_SESSION['doctorlogin']);
header("location:index.php");
?>