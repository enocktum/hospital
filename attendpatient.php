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
	<h1>DOCTOR VIEW ACTIVE PATIENTS</h1>
    <p>
	<?php 
	include"connection.eno";
	error_reporting(E_ERROR);
	$query = mysqli_query($con,"select * from patientdetails where needdoctor='1' && status='1'");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
	echo'
	<table border="1" style="width:100%;text-align:left;">
	<tr>
		<th>Name</th>
		<th>Gender</th>
		<th>Age</th>
		<th>Username</th>
		<th>County</th>
		<th>Email</th>
		<th></th>
	</tr>
	';
	while($data = mysqli_fetch_array($query))
	{
		echo'
		<tr>
			<td>'.$data['name'].'</td>
			<td>'.$data['gender'].'</td>
			<td>'.$data['age'].'</td>
			<td>'.$data['username'].'</td>
			<td>'.$data['county'].'</td>
			<td>'.$data['email'].'</td>
			<td>
				<form action="doctorviewcheckup.php" method="post">
				<input type="hidden" value="'.$data['username'].'" name="username"/>
				<input type="submit" value="View Check Up Report" style="width:100%;background-color:green;color:white;"/>
				</form>
			</td>
		</tr>
		';
	}
	echo'
	</table>
	';
	}
	else
	{
		echo"No patient is active at the moment, a pop up will emerge in the menu section when patient(s) is available for attending";
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