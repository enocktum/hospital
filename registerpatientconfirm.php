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
        <li class="active"><a href="registerpatient.php">Register Patient</a></li>
        <li><a href="viewpatient.php">View Patient</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
	<center>
	<h1 style="text-transform:uppercase;font-size:2em;">Patient Registration Confirmation</h1>
	<p>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$country=$_POST['country'];
	$county=$_POST['county'];
	$age=$_POST['age'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	if($name && $gender && $country && $county && $age && $username && $email)
	{
		if($gender=="select patients gender")
		{
			echo"please select patient's gender<br /> <a href='registerpatient.php'>Try Again</a>";
		}
		else if($country=="select patients country")
		{
			echo"please select patient's country<br /> <a href='registerpatient.php'>Try Again</a>";
		
		}
		else
		{
		$query=mysqli_query($con,"select * from patientdetails where username='$username'");
		$no=mysqli_num_rows($query);
		if($no>0)
		{
			echo"patient already exists in the database<br /> <a href='registerpatient.php'>Try Again</a>";
		}
		else
		{
		$insert=mysqli_query($con,"insert into patientdetails (name,gender,country,county,age,username,email,status,needdoctor,doctorlab,labdoctor,doctorpharmacy) values ('$name','$gender','$country','$county','$age','$username','$email','1','2','2','2','2')");
		if($insert)
		{
			header("location:viewpatient.php");
		}
		else
		{
			echo"data not inserted successfully<br /> <a href='registerpatient.php'>Try Again</a>";
		}
		}
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