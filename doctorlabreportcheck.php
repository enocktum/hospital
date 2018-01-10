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
		//do lab related staff
		$update=mysqli_query($con,"update patientdetails set doctorlab='2' where username='$username'");
		if($update)
		{
			//endelea
			$query=mysqli_query($con,"select * from labreport where username='$username' order by date desc limit 1");
			$data=mysqli_fetch_array($query);
			$limitdate=$data['date'];
			$query2=mysqli_query($con,"select * from labreport where username='$username' && date='$limitdate'");
			echo"
			<h1 style='text-transform:uppercase;'>select the tested disease result for $username</h1>
			<table border='0' style='width:100%;text-align:left;'>
			<tr>
				<th>Suspected Diseasse</th>
				<th>Laboratory Results</th>
			</tr>
			<form action='submitlabresults.php' method='post'>
			<input type='hidden' value='".$username."' name='username'/>
			";
			while($data2=mysqli_fetch_array($query2))
			{
				echo'
				<tr>
					<td>'.$data2['checkfor'].'</td>
					<td>
					<select name="'.$data2['checkfor'].'" style="width:100%;text-align:center;">
					<option>negative</option>
					<option>positive</option>
					</select>
					</td>
				</tr>
				';
			}
			echo"
			<tr>
				<td colspan='2'>
				<center><br/><br/><input type='submit' value='Submit Laboratory Results' style='color:white;background-color:green;width:50%;'/></center>
				</td>
			</tr>
			</form>
			</table>
			";
			//mwisho
		}
		else
		{
			echo"update of doctor lab status not successful";
		}
		//end of staff
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