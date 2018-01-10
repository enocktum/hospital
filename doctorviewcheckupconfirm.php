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
	<h1>DOCTOR SUBMIT SYMPTOMS AND LAB TEST RESULT</h1>
    <p>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$symptoms=$_POST['symptoms'];
	$labreport=$_POST['labreport'];
	$username=$_POST['username'];
	$lab=$_POST['lab'];
	$disease=$_POST['disease'];
	$conclusion=$_POST['conclusion'];
	if($symptoms && $username && $labreport)
	{
		if($symptoms && $lab)
		{
			//code for both symptoms and lab
			$paquery=mysqli_query($con,"select * from patientdetails where username='$username'");
			$padata=mysqli_fetch_array($paquery);
			$county=$padata['county'];
			$country=$padata['country'];
			$date=date("Y-m-d");
			$insert=mysqli_query($con,"insert into doctorreport (username,symptoms,conclusion,date,disease) values ('$username','$symptoms','','$date','')");
			if($insert)
			{
				//insert into lab
				$checkforarray=explode(",",$lab);
				foreach($checkforarray as $checkfor)
				{
				$insert2=mysqli_query($con,"insert into labreport (username,county,country,checkfor,results,date) values ('$username','$county','$country','$checkfor','','$date')");
				if($insert2)
				{
					//success
					echo"<font color='green'>$username details posted successfully to the lab</font><br/>";
					//success
				}
				else
				{
					//not success 
					echo"<font color='green'>$username details posted successfully to the lab</font><br/>";
					//not success
				}
				}
				//update doctor status
				$update=mysqli_query($con,"update doctordetails set active='1' where username='$doctorusername'");
				if($update)
				{
					$update2=mysqli_query($con,"update patientdetails set doctorlab='1' where username='$username'");
					if($update2)
					{
						header("location:doctorhome.php");
					}
					else
					{
						echo"update of lab status not successful";
					}
				}
				else
				{
					echo"doctor status not updated successfully<br/><a href='doctorviewcheckup.php?username=$username'>Try Again</a>";
				}
				//end update
				//end code
			}
			else
			{
				echo"Symptoms not added successfully to the doctor reports <br/><a href='doctorviewcheckup.php?username=$username'>Try Again</a>";
			}
			//end of code
		}
		else if($symptoms && $conclusion && $disease)
		{
			//code for symptoms and conclussion
			$date=date("Y-m-d");
			$insert=mysqli_query($con,"insert into doctorreport (username,symptoms,conclusion,date,disease) values ('$username','$symptoms','$conclusion','$date','$disease')");
			if($insert)
			{
				//success
				$update=mysqli_query($con,"update doctordetails set active='1' where username='$doctorusername'");
				if($update)
				{
					$update2=mysqli_query($con,"update patientdetails set doctorpharmacy='1' where username='$username'");
					if($update2)
					{
						header("location:doctorhome.php");
					}
					else
					{
						echo"update of doctor to pharmacy signal not successful";
					}
				}
				else
				{
					echo"doctor status not updated successfully<br/><a href='doctorviewcheckup.php?username=$username'>Try Again</a>";
				}
				//success
			}
			else
			{
				echo"Symptoms not added successfully to the doctor reports <br/><a href='doctorviewcheckup.php?username=$username'>Try Again</a>";
			}
			//end of code
		}
		else
		{
			//code for symptoms alone
			echo"Records cannot be processed, fill the <b><u>symptoms and the conclussion</u></b> or the <b><u>symptoms and the lab reports</u></b> before clicking the proceed button <br/><br/><a href='doctorviewcheckup.php?username=$username'>CLICK HERE TO CORRECT IT</a>";
			//end of code
		}
	}
	else
	{
		echo"You have not included symptoms before you submitted<br/><br/><a href='attendpatient.php'>Try Again</a>";
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