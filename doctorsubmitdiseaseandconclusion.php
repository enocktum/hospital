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
	error_reporting(E_ERROR);
	include"connection.eno";
	$username=$_POST['username'];
	$conclusion=$_POST['conclusion'];
	$string=$_POST['string'];
	if($username && $conclusion)
	{
		$update=mysqli_query($con,"update doctorreport set conclusion='$conclusion',disease='$string' where username='$username'");
		if($update)
		{
			$update2=mysqli_query($con,"update doctordetails set active='1' where username='$doctorusername'");
			if($update2)
			{
				$update3=mysqli_query($con,"update patientdetails set needdoctor='2',doctorpharmacy='1' where username='$username'");
				if($update3)
				{
					header("location:doctorhome.php");
				}
				else
				{
					echo"sending signal to pharmacy not successful.";
				}
			}
			else
			{
				echo"update of doctor status to active failed, try again";
			}
		}
		else
		{
			echo"update not successful, try again";
		}
	}
	else
	{
		echo"Necessary variables not sent in<br/><a href='labreport.php'>Try Again</a>";
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