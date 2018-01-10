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
        <li><a href="checkup.php">Check Up</a></li>
        <li class="active"><a href="checkupreport.php">Check Up Report</a></li>
        <li class="last"><a href="nurselogout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
    <center>
	<h1>NURSE VIEW PATIENT CHECK UP DETAILS</h1>
    <p>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$query=mysqli_query($con,"select * from checkup");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
		echo'
		<table border="1" style="width:100%;text-align:left;">
		<tr>
			<th>Name</th>
			<th>Age</th>
			<th>Country</th>
			<th>County</th>
			<th>Email</th>
			<th>Blood Pressure</th>
			<th>Blood Type</th>
			<th>Pulse Rate</th>
			<th>Weight in Kg(s)</th>
			<th>Date</th>
		</tr>
		';
		while($data=mysqli_fetch_array($query))
		{
			$username=$data['username'];
			$patientquery=mysqli_query($con,"select * from patientdetails where status='1' && username='$username'");
			$ngapi=mysqli_num_rows($patientquery);
			if($ngapi==1)
			{
				//display
				$patientdata=mysqli_fetch_array($patientquery);
				echo"
				<tr>
					<td>".$patientdata['name']."</td>
					<td>".$patientdata['age']."</td>
					<td>".$patientdata['country']."</td>
					<td>".$patientdata['county']."</td>
					<td>".$patientdata['email']."</td>
					<td>".$data['bloodpressure']."</td>
					<td>".$data['bloodtype']."</td>
					<td>".$data['pulserate']."</td>
					<td>".$data['weight']."</td>
					<td>".$data['date']."</td>
				</tr>
				";
				//end
			}
			else
			{
				//display nothing
				//###############
				//end############
			}
		}
		echo'
		</table>
		';
	}
	else
	{
		echo"there are no patient check up that are active as at ".date('d-m-Y')." or patients have not yet been checked up<br/><a href='checkup.php'>Try Again Later</a>";
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