<?php
session_start();
unset($_SESSION['pharmacylogin']);
header("location:portal.php");
?>