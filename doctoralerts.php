<?php 
session_start();
if(!isset($_SESSION['doctorlogin']))
{
	header("location:portal.php");
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
	echo'
	<div style="width:50%;border:solid 2px black;">
	<h1>DOCTOR UPDATE DISEASE NOTIFICATION</h1>
	<form action="countycountry.php" method="post">
	enter alert number per country<br/>
	<input type="text" name="country" value="" placeholder="country alert rate goes here" style="width:60%;text-align:center;" required /><br/><Br/>
	enter alert number per county<br/>
	<input type="text" name="county" value="" placeholder="county alert rate goes here" style="width:60%;text-align:center;" required /><br/><Br/>
	<input style="width:50%;text-align:center;color:white;background-color:green;" type="submit" value="Update Disease Notification"/><br/><br/>
	</form>
	</div>
	';
	echo"<hr style='border:solid 2px black;width:100%;'/>
	<div style='width:100%;border:solid 2px black;'>
	<h1><u>THE POTENTIAL DISEASE PER COUNTY</u></h1>
	<form action='' method='post'>
	<br/><br/>
	select the county
	<select name='county' style='width:70%;'>
	";
	$query=mysqli_query($con,"select * from patientdetails");
	while($data=mysqli_fetch_array($query))
	{
		echo'
		<option>'.$data['county'].'</option>
		';
	}
	echo"
	</select><br/><br/>
	select a disease
	<select name='disease' style='width:70%;'>
	";
	$querylab=mysqli_query($con,"select * from labreport");
	while($datalab=mysqli_fetch_array($querylab))
	{
		echo'
		<option>'.$datalab['checkfor'].'</option>
		';
	}
	echo"
	</select><br/><br/>
	<input type='submit' value='View Result'/>
	</form>
	<hr/>
	";
	$county=$_POST['county'];
	$disease=$_POST['disease'];
	if($county && $disease)
	{
	$checkalert=mysqli_query($con,"select * from alert");
	$checkalertdata=mysqli_fetch_array($checkalert);
	$nopercounty=$checkalertdata['alertpercounty'];
	$labcheck=mysqli_query($con,"select * from labreport where results='positive' && county='$county' && checkfor='$disease'");
	$ngapi=mysqli_num_rows($labcheck);
	if($ngapi>=$nopercounty)
	{
		//show alert
		echo"
		<h1 style='text-transform:uppercase;color:red;'><marquee>CAUTION!! CAUTION!! THE DISEASE $disease is highly contagious according to the county rating</marquee></h1>
		<p>
		$disease has been infected by $ngapi people and is classified has contagious in the county named $county. Please inform the necessary bodies to check for the disease outbreak and possible ways to conquer it.
		</p>
		";
		//end alert
	}
	else
	{
		echo"
		$disease outbreak does not need an alert in $county county since the number of infected people so far is $ngapi and the alert has been set to alert you at $nopercounty cases of infection per county.
		";
	}
	}
	else
	{
		echo"there are no reports to view, select county and disease and submit the details";
	}
	echo"
	</div>
	";
	//check for country
	echo"<hr style='border:solid 2px black;width:100%;'/>
	<div style='width:100%;border:solid 2px black;'>
	<h1><u>THE POTENTIAL DISEASE PER COUNTRY</u></h1>
	<form action='' method='post'>
	<br/><br/>
	select the country
	<select name='country' style='width:70%;'>
	";
	$querycountry=mysqli_query($con,"select * from country");
	while($datacountry=mysqli_fetch_array($querycountry))
	{
		echo'
		<option>'.$datacountry['nicename'].'</option>
		';
	}
	echo"
	</select><br/><br/>
	select a disease
	<select name='disease' style='width:70%;'>
	";
	$querylab=mysqli_query($con,"select * from labreport");
	while($datalab=mysqli_fetch_array($querylab))
	{
		echo'
		<option>'.$datalab['checkfor'].'</option>
		';
	}
	echo"
	</select><br/><br/>
	<input type='submit' value='View Result'/>
	</form>
	<hr/>
	";
	$country=$_POST['country'];
	$disease=$_POST['disease'];
	if($country && $disease)
	{
	$checkalert=mysqli_query($con,"select * from alert");
	$checkalertdata=mysqli_fetch_array($checkalert);
	$nopercountry=$checkalertdata['alertpercountry'];
	$labcheck=mysqli_query($con,"select * from labreport where results='positive' && country='$country' && checkfor='$disease'");
	$ngapi=mysqli_num_rows($labcheck);
	if($ngapi>=$nopercountry)
	{
		//show alert
		echo"
		<h1 style='text-transform:uppercase;color:red;'><marquee>CAUTION!! CAUTION!! THE DISEASE $disease is highly contagious according to the country rating</marquee></h1>
		<p>
		$disease has been infected by $ngapi people and is classified has contagious in the country named $country. Please inform the necessary bodies to check for the disease outbreak and possible ways to conquer it.
		</p>
		";
		//end alert
	}
	else
	{
		echo"
		$disease outbreak does not need an alert in $country since the number of infected people so far is $ngapi and the alert has been set to alert you at $nopercountry cases of infection per country.
		";
	}
	}
	else
	{
		echo"there are no reports to view, select country and disease and submit the details";
	}
	echo"
	</div>
	";
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