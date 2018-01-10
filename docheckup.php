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
    <p>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$username=$_POST['username'];
	if($username)
	{
		$query=mysqli_query($con,"select * from checkup where username='$username'");
		$no=mysqli_num_rows($query);
		if($no>0)
		{
		$data=mysqli_fetch_array($query);
		echo"
		<div style='border:solid 2px black;width:80%;'>
		<h1 style='text-transform:uppercase;'>Previous Check Up Details for user with username <u><b>$username</b></u></h1>
		<form action='docheckupconfirm.php' method='post'>
		<input type='hidden' value='".$username."' name='username'/>
		<input type='text' placeholder='blood pressure previously was ".$data['bloodpressure']."' name='bloodpressure' style='width:70%;font-size:1.5em;text-align:center;color:green;' value='".$data['bloodpressure']."' required/><br/><br/>
		<input type='text' placeholder='blood type previously was ".$data['bloodtype']."' name='bloodtype' style='width:70%;font-size:1.5em;text-align:center;color:green;' value='".$data['bloodtype']."' required/><br/><br/>
		<input type='text' placeholder='Weight previously was ".$data['weight']."' name='weight' style='width:70%;font-size:1.5em;text-align:center;color:green;' value='".$data['weight']."' required/><br/><br/>
		<input type='text' placeholder='pulse rate previously was ".$data['pulserate']."' name='pulserate' style='width:70%;font-size:1.5em;text-align:center;color:green;' value='".$data['pulserate']."' required/><br/><br/>
		<input type='submit' value='Update Check Up' style='font-size:1.6em;background-color:magenta;color:white;'/><br/><br/>
		</form>
		</div>
		";
		}
		else
		{
		echo"
		<div style='border:solid 2px black;width:80%;'>
		<h1 style='text-transform:uppercase;'>Check Up Form for patient with username <u><b>$username</b></u></h1>
		<form action='docheckupconfirm.php' method='post'>
		<input type='hidden' value='".$username."' name='username'/>
		<input type='text' placeholder='enter the patients blood pressure' name='bloodpressure' style='width:70%;font-size:1.5em;text-align:center;color:green;' required/><br/><br/>
		<input type='text' placeholder='enter the patients blood type' name='bloodtype' style='width:70%;font-size:1.5em;text-align:center;color:green;' required/><br/><br/>
		<input type='text' placeholder='enter the patients weight' name='weight' style='width:70%;font-size:1.5em;text-align:center;color:green;' required/><br/><br/>
		<input type='text' placeholder='enter the patients pulse rate' name='pulserate' style='width:70%;font-size:1.5em;text-align:center;color:green;' required/><br/><br/>
		<input type='submit' value='Submit Check Up' style='font-size:1.6em;background-color:magenta;color:white;'/><br/><br/>
		</form>
		</div>
		";
		}
	}
	else
	{
		echo"necessary variables not sent in<br/><a href='checkup.php'>Try Again</a>";
	}
	
	$username=$_POST['username'];
	$bloodpressure=$_POST['bloodpressure'];
	$weight=$_POST['weight'];
	$pulserate=$_POST['pulserate'];
	$bloodtype=$_POST['bloodtype'];
	
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