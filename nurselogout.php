<?php 
session_start();
unset($_SESSION['nurseslogin']);
header("location:index.php");
?>