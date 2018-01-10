<?php 
session_start();
if(!isset($_SESSION['pharmacylogin']))
{
	header("location:portal.php");
}
else
{
	$pharmacyusername=$_SESSION['pharmacylogin'];
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
	$("#results").load("pharmacyautoload.php").fadeIn("slow");
}
$(document).ready(function(){
	loadnowplaying();
	setInterval(function(){
	loadnowplaying();
	},3000);
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
      <ul id="results" class="topnav clear"> </ul>
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
		$update=mysqli_query($con,"update patientdetails set doctorpharmacy='2',status='2' where username='$username'");
		if($update)
		{
			$query=mysqli_query($con,"select * from doctorreport where username='$username'");
			$data=mysqli_fetch_array($query);
			$prescriptionstring=$data['conclusion'];
			$prescriptionarray=explode(",",$prescriptionstring);
			echo"
			<h1 style='text-transform:uppercase;'>PHARMACY PRESCRIBE MEDICATION TIME FOR PATIENT WITH $username</h1>
			<table border='0' style='width:100%;text-align:left;'>
			<tr>
				<th>MEDICINE</th>
				<th>TIME TO TAKE MEDICINE</th>
			</tr>
			<form action='prescriptionform.php' method='post'>
			<input type='hidden' value='".$username."' name='username'/>
			";
			foreach($prescriptionarray as $prescription)
			{
				echo"
				<tr>
					<td>".$prescription."</td>
					<td><select name='".$prescription."' style='width:100%;'>
					<option>1 x 3</option>
					<option>1 x 2</option>
					<option>1 x 1</option>
					<option>2 x 3</option>
					<option>2 x 2</option>
					<option>2 x 1</option>
					<option>3 x 3</option>
					<option>3 x 2</option>
					<option>3 x 1</option>
					<option>4 x 3</option>
					<option>4 x 2</option>
					<option>4 x 1</option>
					</select>
					</td>
				</tr>
				";
			}
			echo"
			<tr>
				<td colspan='2'>
				<br/><br/><center><input type='submit' value='Release Patient' style='width:70%;height:2em;color:white;background-color:green;'/></center>
				</td>
			</tr>
			</form>
			</table>
			";
		}
		else
		{
			echo'patient status and doctor to lab status change not successful';
		}
	}
	else
	{
		echo"not sent";
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