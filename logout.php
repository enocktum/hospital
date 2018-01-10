<?php 
session_start();
unset($_SESSION['admissionlogin']);
header("location:index.php");
?>