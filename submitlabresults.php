<?php
session_start();
if(!isset($_SESSION['lablogin']))
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
	$("#results").load("labautoload.php").fadeIn("slow");
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
	if($username)
	{
		$query=mysqli_query($con,"select * from labreport where username='$username' order by date desc limit 1");
		$data=mysqli_fetch_array($query);
		$limitdate=$data['date'];
		$query2=mysqli_query($con,"select * from labreport where username='$username' && date='$limitdate'");
		while($data2=mysqli_fetch_array($query2))
		{
			$checkfor=$data2['checkfor'];
			$info=$_POST[$checkfor];
			$update=mysqli_query($con,"update labreport set results='$info' where username='$username' && date='$limitdate' && checkfor='$checkfor'");
			if($update)
			{
				echo"<font color='green'>the test results for $checkfor has been updated to $info</font><br/>";
			}
			else
			{
				echo'update not successful<br/>';
			}
		}
		$update3=mysqli_query($con,"update patientdetails set labdoctor='1' where username='$username'");
		if($update3)
		{
			header("location:labhome.php");
		}
		else
		{
			echo"update of lab to doctor signal not successful";
		}
	}
	else
	{
		echo"necessary variable unavailable";
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