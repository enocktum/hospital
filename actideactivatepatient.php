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
	<h1 style="text-transform:uppercase;font-size:2em;">Change Status Progress</h1>
	<p>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$username=$_POST['username'];
	$status=$_POST['status'];
	if($username && $status)
	{
		if($status==1)
		{
			$update=mysqli_query($con,"update patientdetails set status='2' where username='$username'");
			if($update)
			{
				header("location:viewpatient.php");
			}
			else
			{
				echo"status not changed to active successfully<br/>Try Again by clicking VIEW PATIENT above";
			}
		}
		else if($status==2)
		{
			$update=mysqli_query($con,"update patientdetails set status='1' where username='$username'");
			if($update)
			{
				header("location:viewpatient.php");
			}
			else
			{
				echo"patient status not deactivated successfully<br/>Try Again by clicking VIEW PATIENT above";
			}
		}
	}
	else
	{
		echo"neccessary variable not sent in.<br/>Click VIEW PATIENT above to try again";
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