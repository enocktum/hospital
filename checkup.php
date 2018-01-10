<?php
session_start(); 
if(!isset($_SESSION['nurselogin']))
{
	header('location:index.php');
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
        <li><a href="nursehome.php">Nurse Home</a></li>
        <li class="active"><a href="checkup.php">Check Up</a></li>
        <li><a href="checkupreport.php">Check Up Report</a></li>
        <li class="last"><a href="nurselogout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
    <center>
	<h1>Check Up</h1>
    <p>
	<form action="" method="post">
	<strong style="font-size:1.3em;">enter patient's username:</strong>
	<input type="text" placeholder="patient's username goes here" name="username" style="width:50%;font-size:1.4em;" required/>
	<input style="font-size:1.4em;" type="submit" value="Check Patient"/>
	</form>
	<hr style="border:solid 3px black;"/>
	<?php 
	error_reporting(E_ERROR);
	include("connection.eno");
	$username=$_POST['username'];
	if($username)
	{
		$query=mysqli_query($con,"select * from patientdetails where username='$username' && status='1'");
		$no=mysqli_num_rows($query);
		if($no==1)
		{
			echo"
			<table style='width:100%;text-align:left;' border='0'>
			<tr>
				<th>Name</th>
				<th>Gender</th>
				<th>Username</th>
				<th>Password</th>
				<th>County</th>
				<th>Email</th>
				<th></th>
			</tr>
			";
			while($patientdata=mysqli_fetch_array($query))
			{
				echo"
				<tr>
					<td>".$patientdata['name']."</td>
					<td>".$patientdata['gender']."</td>
					<td>".$patientdata['username']."</td>
					<td>".$patientdata['password']."</td>
					<td>".$patientdata['county']."</td>
					<td>".$patientdata['email']."</td>
					<td>
					<form action='docheckup.php' method='post'>
					<input type='hidden' value='".$patientdata['username']."' name='username' required/>
					<input type='submit' value='Check Up' style='width:100%;color:white;background-color:magenta;'>
					</form>
					</td>
				</tr>
				";
			}
			echo"
			</table>
			";
		}
		else
		{
			echo"the record with username $username does not exist, send the patient back to the admission officer for activation or registration";
		}
	}
	else
	{
		$query=mysqli_query($con,"select * from patientdetails where status='1'");
		$no=mysqli_num_rows($query);
		if($no>0)
		{
			echo"
			<table style='width:100%;text-align:left;' border='0'>
			<tr>
				<th>Name</th>
				<th>Gender</th>
				<th>Username</th>
				<th>Password</th>
				<th>County</th>
				<th>Email</th>
				<th></th>
			</tr>
			";
			while($patientdata=mysqli_fetch_array($query))
			{
				echo"
				<tr>
					<td>".$patientdata['name']."</td>
					<td>".$patientdata['gender']."</td>
					<td>".$patientdata['username']."</td>
					<td>".$patientdata['password']."</td>
					<td>".$patientdata['county']."</td>
					<td>".$patientdata['email']."</td>
					<td>
					<form action='docheckup.php' method='post'>
					<input type='hidden' value='".$patientdata['username']."' name='username' required/>
					<input type='submit' value='Check Up' style='width:100%;color:white;background-color:magenta;'>
					</form>
					</td>
				</tr>
				";
			}
			echo"
			</table>
			";
		}
		else
		{
			echo"No patients have been registered or activated, send the patient back to admission for registration or activation";
		}
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