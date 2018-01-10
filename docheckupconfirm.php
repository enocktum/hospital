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
	$bloodpressure=$_POST['bloodpressure'];
	$weight=$_POST['weight'];
	$pulserate=$_POST['pulserate'];
	$bloodtype=$_POST['bloodtype'];
	$date=date("Y-m-d");
	if($username && $bloodpressure && $weight && $pulserate && $bloodtype && $date)
	{
		$query=mysqli_query($con,"select * from checkup where username='$username'");
		$no=mysqli_num_rows($query);
		if($no>0)
		{
			$update1=mysqli_query($con,"update patientdetails set needdoctor='1' where username='$username'");
			if($update1)
			{
			$update=mysqli_query($con,"update checkup set bloodpressure='$bloodpressure',weight='$weight',pulserate='$pulserate',bloodtype='$bloodtype',date='$date' where username='$username'");
			if($update)
			{
				echo"
				patient check up details for $username have been successfully processed, proceed to doctors examination rooms to continue with your health preview
				<br/>
				<form action='printcheckupdetails.php' method='post' style='width:40%;float:left;'>
				<input type='hidden' value='".$username."' name='username'/>
				<input type='submit' value='Print Check Up for $username' style='background-color:green;color:white;width:60%;'/>
				</form>
				<form action='checkup.php' method='post' style='width:60%;float:right;'>
				<input type='submit' value='Return Home' style='background-color:green;color:white;width:40%;'/>
				</form>
				";
				echo"
				<br/><br/><br/>
				<hr style='border:solid 2px black;'/>
				<h1>EXAMINATION ROOMS AVAILABLE<h1>
				";
				$doctorquery=mysqli_query($con,"select * from doctordetails where active='1'");
				$ngapi=mysqli_num_rows($doctorquery);
				if($ngapi>0)
				{
					echo'
					<table border="1" style="width:100%;text-align:left;">
					<tr>
						<th>Room Free</th>
						<th>Doctor\'s name</th>
					</tr>
					';
					while($doctordata=mysqli_fetch_array($doctorquery))
					{
						echo'
						<tr>
							<td>'.$doctordata['room'].'</td>
							<td>'.$doctordata['name'].'</td>
						</tr>
						';
					}
					echo'
					</table>
					';
					
				}
				else
				{
					echo"No doctor is free at the moment, wait at the examination rooms benches while they serve other patients, thank you";
				}
			}
			else
			{
				echo"update for $username not successful<br/><a href='checkup.php'>Try Again</a>";
			}
		    }
			else
			{
				echo"Doctor alert not successful";
			}
		}
		else
		{
			//start of insert
			$update=mysqli_query($con,"update patientdetails set needdoctor='1' where username='$username'");
			if($update)
			{
			$insert=mysqli_query($con,"insert into checkup (bloodpressure,bloodtype,weight,pulserate,date,username) values ('$bloodpressure','$bloodtype','$weight','$pulserate','$date','$username')");
			if($insert)
			{
				echo"
				patient check up details for $username have been successfully processed, proceed to doctors examination rooms to continue with your health preview
				<br/>
				<form action='printcheckupdetails.php' method='post' style='width:40%;float:left;'>
				<input type='hidden' value='".$username."' name='username'/>
				<input type='submit' value='Print Check Up for $username' style='background-color:green;color:white;width:40%;'/>
				</form>
				<form action='checkup.php' method='post' style='width:40%;float:right;'>
				<input type='submit' value='Go Home' style='background-color:green;color:white;width:40%;'/>
				</form>
				";
				echo"
				<br/><br/><br/>
				<hr style='border:solid 2px black;'/>
				<h1>EXAMINATION ROOMS AVAILABLE<h1>
				";
				$doctorquery=mysqli_query($con,"select * from doctordetails where active='1'");
				$ngapi=mysqli_num_rows($doctorquery);
				if($ngapi>0)
				{
					echo'
					<table border="1" style="width:100%;text-align:left;">
					<tr>
						<th>Room Free</th>
						<th>Doctor\'s name</th>
					</tr>
					';
					while($doctordata=mysqli_fetch_array($doctorquery))
					{
						echo'
						<tr>
							<td>'.$doctordata['room'].'</td>
							<td>'.$doctordata['name'].'</td>
						</tr>
						';
					}
					echo'
					</table>
					';
					
				}
				else
				{
					echo"No doctor is free at the moment, wait at the examination rooms benches while they serve other patients, thank you";
				}
			}
			else
			{
				echo"check up for $username not successful<br/><a href='checkup.php'>Try Again</a>";
			}
			//end of insert
		    }
			else
			{
				echo"Doctor alert not successful";
			}
		}
	}
	else
	{
		echo"necessary variables not sent in<br/><a href='checkup.php'>Try Again</a>";
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