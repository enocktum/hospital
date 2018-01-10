<?php 
session_start();
if(!isset($_SESSION['admissionlogin']))
{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PRIMARY HEALTH CARE SYSTEM</title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="layout/styles/mediaqueries.css" type="text/css" media="all">
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery-mobilemenu.min.js"></script>
</head>
<body>
<div class="wrapper row1">
  <header id="header">
    <div id="hgroup">
      <h1><a href="index.php">PRIMARY HEALTH CARE SYSTEM</a></h1>
      <h2>Bringing attention to you</h2>
    </div>
    
    <nav id="topnav">
      <ul class="topnav clear">
        <li><a href="">Admission Home</a></li>
        <li><a href="registerpatient.php">Register Patient</a></li>
        <li class="active"><a href="viewpatient.php">View Patient</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
	<center>
	<h1 style="text-transform:uppercase;font-size:2em;">Patient Editing Confirmation</h1>
	<p>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$name=$_POST['name'];
	$county=$_POST['county'];
	$age=$_POST['age'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$username=$_POST['username'];
	if($name && $county && $age && $password && $email && $username)
	{
		$update=mysqli_query($con,"update patientdetails set name='$name',county='$county',age='$age',password='$password',email='$email' where username='$username'");
		if($update)
		{
			header("location:viewpatient.php");
		}
		else
		{
			echo"patient editing not successful<br/><a href='viewpatient.php'>Try Again</a>";
		}
	}
	else
	{
		echo"neccessary variables not sent in successfully<br /> <a href='registerpatient.php'>Try Again</a>";
	}
	?>
	</p>
    </center>
    <div class="clear"></div>
  </div>
</div>
<!-- Copyright -->
<div class="wrapper row3">
  <footer id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2015 - All Rights Reserved - <a href="">enock tum</a></p>
    <p class="fl_right">Designed by <a target="_blank" href="" title="">enock tum</a></p>
  </footer>
</div>
</body>
</html>