<?php 
session_start();
if(!isset($_SESSION['admissionlogin']))
{
	header("location:index.php");
}
?>
<html>
<title>Print Patient List</title>
<body onload="print()">
<center>
<?php 
error_reporting(E_ERROR);
include"connection.eno";
$choice=$_POST['choice'];
if($choice)
{
	if($choice=="all patients")
	{
		//start query for all patients
	$query=mysqli_query($con,"select * from patientdetails");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
		echo"
		<a href='viewpatient.php'><h1 style='text-transform:uppercase;color:black;'>ALL PATIENTS AS AT ".date("d-m-Y")."</h1></a>
		<table border='0' style='width:100%;text-align:left'>
		<tr>
			<th>NAME</th>
			<th>AGE</th>
			<th>COUNTY</th>
			<th>COUNTRY</th>
			<th>USERNAME</th>
			<th>GENDER</th>
			<th>EMAIL</th>
			<th>STATUS</th>
		</tr>
		";
		while($data=mysqli_fetch_array($query))
		{
			$status=$data['status'];
			echo"
			<tr>
				<td>".$data['name']."</td>
				<td>".$data['age']."</td>
				<td>".$data['county']."</td>
				<td>".$data['country']."</td>
				<td>".$data['username']."</td>
				<td>".$data['gender']."</td>
				<td>".$data['email']."</td>
				";
				if($status==1)
				{
				echo"
				<td style='color:green;'>active patient</td>
				";
				}
				else if($status==2)
				{
				echo"
				<td style='color:purple;'>inactive patient</td>
				";
				}
				echo"
			</tr>
			";
		}
		echo"
		</table>
		";
	}
	else
	{
		echo"the patient list is empty or the patients are inactive, add a patient or activate them to view their details";
	}
		//end query
	}
	else if($choice=="active patients")
	{
		//start query for active patients
	$query=mysqli_query($con,"select * from patientdetails where status='1'");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
		echo"
		<a href='viewpatient.php'><h1 style='text-transform:uppercase;color:black;'>ACTIVE PATIENTS AS AT ".date("d-m-Y")."</h1></a>
		<table border='0' style='width:100%;text-align:left'>
		<tr>
			<th>NAME</th>
			<th>AGE</th>
			<th>COUNTY</th>
			<th>COUNTRY</th>
			<th>USERNAME</th>
			<th>GENDER</th>
			<th>EMAIL</th>
		</tr>
		";
		while($data=mysqli_fetch_array($query))
		{
			$status=$data['status'];
			echo"
			<tr>
				<td>".$data['name']."</td>
				<td>".$data['age']."</td>
				<td>".$data['county']."</td>
				<td>".$data['country']."</td>
				<td>".$data['username']."</td>
				<td>".$data['gender']."</td>
				<td>".$data['email']."</td>
			</tr>
			";
		}
		echo"
		</table>
		";
	}
	else
	{
		echo"the patient list is empty or the patients are inactive, add a patient or activate them to view their details<br/><a href='viewpatient.php'>Try Again</a>";
	}	
		//end query
	}
	else if($choice=="inactive patients")
	{
		//start query for inactive patients
	$query=mysqli_query($con,"select * from patientdetails where status='2'");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
		echo"
		<a href='viewpatient.php'><h1 style='text-transform:uppercase;color:black;'>INACTIVE PATIENTS AS AT ".date("d-m-Y")."</h1></a>
		<table border='0' style='width:100%;text-align:left'>
		<tr>
			<th>NAME</th>
			<th>AGE</th>
			<th>COUNTY</th>
			<th>COUNTRY</th>
			<th>USERNAME</th>
			<th>GENDER</th>
			<th>EMAIL</th>
		</tr>
		";
		while($data=mysqli_fetch_array($query))
		{
			$status=$data['status'];
			echo"
			<tr>
				<td>".$data['name']."</td>
				<td>".$data['age']."</td>
				<td>".$data['county']."</td>
				<td>".$data['country']."</td>
				<td>".$data['username']."</td>
				<td>".$data['gender']."</td>
				<td>".$data['email']."</td>
			</tr>
			";
		}
		echo"
		</table>
		";
	}
	else
	{
		echo"the patient list is empty or all patients are active<br/><a href='viewpatient.php'>Try Again</a>";
	}	
		//end query
	}
}
else
{
	echo"necessary variables not sent in<br/><a href='viewpatient.php'>Try Again</a>";
}
?>
</center>
</body>
</html>