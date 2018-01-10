<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Patient Report</title>
</head>

<body onload="print()">
<center>
<?php 
error_reporting(E_ERROR);
include"connection.eno";
$username=$_POST['username'];
if($username)
{
	$query=mysqli_query($con,"select * from doctorreport where username='$username'");
	$data=mysqli_fetch_array($query);
	$prescriptionstring=$data['conclusion'];
	$date=date("Y-m-d");
	$prescriptionarray=explode(",",$prescriptionstring);
	//start of getting patient basic details
				$paquery=mysqli_query($con,"select * from patientdetails where username='$username'");
				$padata=mysqli_fetch_array($paquery);
				$lquery=mysqli_query($con,"select * from labreport where username='$username' && date='$date'");
				$dquery=mysqli_query($con,"select * from doctorreport where username='$username'");
				$nquery=mysqli_query($con,"select * from checkup where username='$username'");
				$ndata=mysqli_fetch_array($nquery);
				$phquery=mysqli_query($con,"select * from pharmacyreport where username='$username' && date='$date'");
				echo'
				<div style="width:100%;font-size:0.5em;">
				<h1 style="text-transform:uppercase;"><a href="pharmacyhome.php" style="color:black;">Hospital general report for '.$padata['name'].' generated at '.date("Y-m-d").'</a></h1>
				<hr style="width:100%;border:solid 2px black;"/>
				<h2>BASIC DETAILS</h2>
				<hr/>
				<table border="0" style="width:100%;text-align:left;">
				<tr>
					<th>USERNAME</th>
					<th>AGE</th>
					<th>GENDER</th>
					<th>COUNTRY</th>
					<th>COUNTY</th>
					<th>EMAIL</th>
					<th>WEIGHT</th>
					<th>BLOOD TYPE</th>
					<th>BLOOD PRESSURE</th>
					<th>PULSE RATE</th>
				</tr>
				<tr>
					<td>'.$padata['username'].'</td>
					<td>'.$padata['age'].'</td>
					<td>'.$padata['gender'].'</td>
					<td>'.$padata['country'].'</td>
					<td>'.$padata['county'].'</td>
					<td>'.$padata['email'].'</td>
					<td>'.$ndata['weight'].'</td>
					<td>'.$ndata['bloodtype'].'</td>
					<td>'.$ndata['bloodpressure'].'</td>
					<td>'.$ndata['pulserate'].'</td>
				</tr>
				</table>
				<br/><br/>
				';
	//end of getting patients basic details
	$postarray=$_POST;
	$prescriptionnumber=count($prescriptionarray);
	$prescriptionnumberreal=$prescriptionnumber-1;
	//finalising
	$mailfollowup="";
	for($counter=1;$counter<=$prescriptionnumber;$counter++)
	{
		$medicine=$prescriptionarray[$counter-1];
		$period=$postarray[($prescriptionarray[$counter-1])];
		if($mailfollowup=="")
		{
			$mailfollowup="MEDICINE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRESCRIPTION<br/>".$medicine."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$period;
		}
		else
		{
			$mailfollowup=$mailfollowup."<br/>".$medicine."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$period;
		}
		$chkquery=mysqli_query($con,"select * from pharmacyreport where username='$username' && medicine='$medicine' && period='$period' && date='$date'");
		$no=mysqli_num_rows($chkquery);
		if($no==0)
		{
			//start insert
			$insert=mysqli_query($con,"insert into pharmacyreport (username,medicine,period,date) values ('$username','$medicine','$period','$date')");
			if($insert)
			{
				//keep inserting bbe
				
				//end of keep inserting bbe
			}
			else
			{
				echo"<font color='red'>medicine, period and date not inserted to table successfully for $username</font><Br/>";
			}
			//end of insert
		}
		else
		{
			//echo"The prescription already exist in medication history<br/><br/>";
		}
	}
	//getting pharmacy data
	echo"
	<hr/><hr/>
	<h2>YOUR PHARMACY PRESCRIPTION DOSAGE TO BE STRICTLY FOLLOWED</h2>
	<hr/>
	<table border='0' style='width:100%;text-align:center;' >
	<tr>
		<th>MEDICINE NAME</th>
		<th>PERIOD TO TAKE</th>
		<th>DATE OF ISSUE</th>
	</tr>
	";
	$trh=date("Y-m-d");
	$chukquery=mysqli_query($con,"select * from pharmacyreport where username='$username' && date='$trh'");
	while($phdata=mysqli_fetch_array($chukquery))
	{
		echo"
		<tr>
			<td>".$phdata['medicine']."</td>
			<td>".$phdata['period']."</td>
			<td>".$phdata['date']."</td>
		</tr>
		";
	}
	echo"
	</table>
	";
	//end of getting pharmacy data
	//getting laboratory data
	$ngapi=mysqli_num_rows($lquery);
	if($ngapi>0)
	{
	echo"
	<hr/><hr/>
	<h2>YOUR LABORATORY TEST RESULTS</h2>
	<hr/>
	<table border='0' style='width:100%;text-align:center;' >
	<tr>
		<th>SUSPECTED DISEASE</th>
		<th>RESULTS/OUTCOME</th>
		<th>DATE OF TEST</th>
	</tr>
	";
	while($ldata=mysqli_fetch_array($lquery))
	{
		echo"
		<tr>
			<td>".$ldata['checkfor']."</td>
			<td>".$ldata['results']."</td>
			<td>".$ldata['date']."</td>
		</tr>
		";
	}
	echo"
	</table>
	";
	}
	else
	{
	echo"
	<hr/><hr/>
	<h2>YOUR LABORATORY TEST RESULTS</h2>
	<hr/>
	You do not have laboratory test report, no tests has been done for you in the laboratory
	";
	}
	//end of getting laboratory data
	//sending mail
	echo"
	<hr/><hr/>
	<h2>MAIL CONFIRMATION INCASE OF PAPER LOSS</h2>
	<hr/>
	";
	$to=$padata['email'];
	$subject="Medicine Prescription Schedule";
	$text="
	<div style='background-color:blue;color:white;border:dashed 2px white;'>
	<h1 style='font-size:2em;'><u>HOSPITAL MAILING SYSTEM AUTOBOX</u></h1>
	<h1>the following is the schedule to be followed and the medicine</h1>
	<h2>$mailfollowup</h2>
	incase of any queries please visit the hospital website at <a style='color:white;' href='http://www.enocktum.com/'>www.enocktum.com</a> or call the number +254784525425 or email us at <a style='color:white;' href='mailto:queries@enocktum.com'> queries@enocktum.com </a>
	<br/><br/>
	Thanks for visiting us, quick recovery
	</div>
	";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers.="From: hospitalfaculty@enocktum.com";
	$mail=mail($to,$subject,$text,$headers);
	if($mail)
	{
		echo"An email has been sent successfully to $to containing the medicine and periods to swallow<br/>thank you for visiting our hospital, we wish you quick recovery and Gods healing at fore most<br/>Safe journey back home";
	}
	else
	{
		echo"mail not successfully sent, internet connectivity required";
	}
	//end sending mail
	//end
	
}
else
{
	header("location:pharmacyhome.php");
}
?>
</center>
</body>
</html>
