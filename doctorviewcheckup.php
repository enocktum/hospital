<?php 
session_start();
if(!isset($_SESSION['doctorlogin']))
{
	header("location:portal.php");
}
else
{
	$doctorusername=$_SESSION['doctorlogin'];
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

<script>
function loadnowplaying()
{
	$("#results").load("doctorautoload.php").fadeIn("slow");
}
$(document).ready(function(){
	loadnowplaying();
	setInterval(function(){
	loadnowplaying();
	},3000);
});
</script>

<script>
$(document).ready(function(){
	
	$("#nobabe").click(function()
	{ 
	$("#lab").slideUp("slow"); 
	$("#conclusion").slideDown("slow"); 
	$("#disease").slideDown("slow"); 
	});
	
	$("#yesbabe").click(function()
	{ 
	$("#lab").slideDown("slow"); 
	$("#conclusion").fadeOut("slow"); 
	$("#disease").fadeOut("slow"); 
	});

});
</script>

</head>
<body>
<div class="wrapper row1">
  <header id="header">
    <div id="hgroup">
      <h1><a href="index.php">PRIMARY HEALTH CARE SYSTEM</a></h1>
      <h2>Bringing attention to you</h2>
    </div>
   
    <nav id="topnav">
      <ul id="results" class="topnav clear"></ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
    <center>
    <p>
	<?php 
	include"connection.eno";
	error_reporting(E_ERROR);
	if($_POST)
	{
		$username=$_POST['username'];
	}
	else if($_GET)
	{
		$username=$_GET['username'];
	}
	
	if($username)
	{
		$update=mysqli_query($con,"update patientdetails set needdoctor='2' where username='$username'");
		if($update)
		{
		$update2=mysqli_query($con,"update doctordetails set active='2' where username='$doctorusername'");
		if($update2)
		{
		$checkupquery=mysqli_query($con,"select * from checkup where username='$username'");
		$checkupdata=mysqli_fetch_array($checkupquery);
		$detailsquery=mysqli_query($con,"select * from patientdetails where username='$username'");
		$detailsdata=mysqli_fetch_array($detailsquery);
		echo"
		<div style='width:100%;border:solid 2px black;'>
		<br/>
		<h1 style='text-transform:uppercase;'>record the symptoms for ".$detailsdata['name']." and click continue</h1>
		<table border='0' style='width:80%;text-align:left;font-size:1.7em;'>		<tr>
			<th>Name</th>
			<th>Blood Pressure</th>
			<th>Blood Type</th>
			<th>Weight</th>
			<th>Pulse Rate</th>
			<th>Date</th>
		</tr>
		<tr>
			<td>".$detailsdata['name']."</td>
			<td>".$checkupdata['bloodpressure']."</td>
			<td>".$checkupdata['bloodtype']."</td>
			<td>".$checkupdata['weight']."</td>
			<td>".$checkupdata['pulserate']."</td>
			<td>".$checkupdata['date']."</td>
		</tr>
		<tr>
			<td colspan='7'>
			<br/>
			<form action='doctorviewcheckupconfirm.php' method='post'>
			<input type='hidden' value='".$username."' name='username'/>
			<textarea name='symptoms' placeholder='record patients symptoms here(separate by commas if more than one symptom e.g vomiting,sweating, shivering,head ache)' style='width:100%;height:5em;' required></textarea>
			<br/><br/>
					<center>Do you need lab reports: <input id='yesbabe' type='radio' name='labreport' value='yes' /> YES &nbsp;&nbsp;&nbsp; <input id='nobabe' type='radio' name='labreport' value='no' checked /> NO
					<br/><br/>
					<textarea name='lab' id='lab' placeholder='enter the posible diseases for the patient to be tested for (separate by commas if more than one e.g malaria, cholera, syphilis )' style='width:100%;height:5em;display:none;'></textarea><br/><br/>
					<textarea name='disease' id='disease' placeholder='enter the disease you have found in the patient (separate with commas if more than one disease e.g malaria, typhoid)' style='width:100%;height:5em;'></textarea><br/><br/>
					<textarea name='conclusion' id='conclusion' placeholder='prescribe medication to be given by the pharmacy attendant(s)  based on disease(s) above (separate the medication by commas if more than one e.g. piriton, amoxil, pruven' style='width:100%;height:5em;'></textarea><br/><br/>
			<input type='submit' value='Proceed' style='background-color:green;color:white;width:50%;'/></center>
			</form>
			</td>
		</tr>
		</table>
		</div>
		";
		}
		else
		{
			echo"change of doctor status not successful<br/><a href='attendpatient.php'>Try Again</a>";
		}
		}
		else
		{
			echo"change of patient status not successful<br/><a href='attendpatient.php'>Try Again</a>";
		}
	}
	else
	{
		echo"neccessary variables not sent in<br/><a href='attendpatient.php'>Try Again</a>";
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