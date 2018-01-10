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
	if($username)
	{
		$update=mysqli_query($con,"update doctordetails set active='2' where username='$doctorusername'");
		if($update)
		{
			//change lab doctor status
			$update2=mysqli_query($con,"update patientdetails set labdoctor='2' where username='$username'");
			if($update2)
			{
				//start viewing of the data
				$checkquery=mysqli_query($con,"select * from labreport where username='$username' order by date desc limit 1");
				$chdata=mysqli_fetch_array($checkquery);
				$latestdate = $chdata['date'];
				$finalquery=mysqli_query($con,"select * from labreport where username='$username' && results='positive' && date='$latestdate'");
				$patientcheck=mysqli_query($con,"select * from patientdetails where username='$username'");
				$patientdata=mysqli_fetch_array($patientcheck);
				echo'
				<div style="width:100%;border:solid 2px black;font-size:1.7em;">
				<center>
				<h1 style="text-transform:uppercase;">DOCTOR VIEW LAB REPORT(S) for '.$patientdata['name'].'</h1>
				<table border="0" style="width:90%;text-align:left;">
				<tr>
					<th>Username</th>
					<th>Disease Suspected</th>
					<th>Lab Results</th>
				</tr>
				';
				$diseasestring="";
				while($finaldata=mysqli_fetch_array($finalquery))
				{
					$disease=$finaldata['checkfor'];
					if($string=="")
					{
						$string=$disease;
					}
					else
					{
						$string=$string.",".$disease;
					}
					echo'
					<tr style="color:green;">
						<td>'.$finaldata['username'].'</td>
						<td>'.$finaldata['checkfor'].'</td>
						<td>'.$finaldata['results'].'</td>
					</tr>
					';
				}
				echo'
				</table>
				<br/><Br/>
				<form action="doctorsubmitdiseaseandconclusion.php" method="post">
				<input type="hidden" value="'.$username.'" name="username"/>
				<input type="hidden" value="'.$string.'" name="string"/>
				<textarea style="width:80%;height:5em;" name="conclusion" placeholder="enter the medical prescription to be given to the patient at the pharmacy( separate with commas if the medication is more than one e.g. paracetamol, amoxil, fluegone)" required></textarea><br/><br/>
				<input type="submit" value="Proceed To Pharmacy" style="background-color:green;color:white;"/>
				<br/><br /><br />
				</form>
				</center>
				</div>
				';
				//end viewing of the data
			}
			else
			{
				echo"update of lab doctor status not successful, try again";
			}
			//end code
		}
		else
		{
			echo"change of doctor status not possible, try again";
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