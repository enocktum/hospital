<?php 
session_start();
if(!isset($_SESSION['admissionlogin']))
{
	header("location:index.php");
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
        <li><a href="">Admission Home</a></li>
        <li><a href="registerpatient.php">Register Patient</a></li>
        <li class="active"><a href="viewpatient.php">View Patient</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
	<center>
	<h1 style="text-transform:uppercase;font-size:2em;">Patient Details</h1>
	<p>
	<form action="" method="post">
	<strong style="">filter patient by username and click the button</strong>
	<input type="text" placeholder="patient's username goes here" name="username" style="width:50%;" required/>
	<input style="" type="submit" value="View Patient Details"/>
	</form>
	<hr style="border:solid 1px black;"/>
	<?php 
	error_reporting(E_ERROR);
	include"connection.eno";
	$username=$_POST['username'];
	echo"<br/><br/>";
	if($username)
	{
	//start with username
	$query=mysqli_query($con,"select * from patientdetails where username='$username'");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
		echo"
		<h1 style='text-transform:uppercase;'>you are viewing details for patient with username $username</h1>
		<table border='1' style='width:100%;'>
		<tr>
			<th>NAME</th>
			<th>AGE</th>
			<th>COUNTY</th>
			<th>COUNTRY</th>
			<th>USERNAME</th>
			<th>PASSWORD</th>
			<th>EMAIL</th>
			<th></th>
			<th></th>
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
				<td>".$data['password']."</td>
				<td>".$data['email']."</td>
				";
				if($status==1)
				{
					echo"
					<td>
				    <form action='actideactivatepatient.php' method='post'>
					<input type='hidden' value='".$data['username']."' name='username' required/>
					<input type='hidden' value='".$data['status']."' name='status' required/>
					<input type='submit' value='Deactivate' style='width:100%;background-color:magenta;color:white;'>
					</form>
					</td>
					";
				}
				else if($status==2)
				{
					echo"
					<td>
				    <form action='actideactivatepatient.php' method='post'>
					<input type='hidden' value='".$data['username']."' name='username' required/>
					<input type='hidden' value='".$data['status']."' name='status' required/>
					<input type='submit' value='Activate' style='width:100%;background-color:purple;color:white;'>
					</form>
					</td>
					";
				}
				echo"
					<td>
					<form action='editpatient.php' method='post'>
					<input type='hidden' value='".$data['username']."' name='username' required/>
					<input type='submit' value='Edit' style='width:100%;background-color:green;color:white;'>
					</form>
					</td>
			</tr>
			";
		}
		echo"
		</table>
		";
	}
	else
	{
		echo"There is no patient with username $username";
	}
	//end with username
	}
	else
	{
	$query=mysqli_query($con,"select * from patientdetails where status='1'");
	$no=mysqli_num_rows($query);
	if($no>0)
	{
		echo"
		<h1 style='text-transform:uppercase;'>you are viewing details for all active patients</h1>
		<table border='1' style='width:100%;'>
		<tr>
			<th>NAME</th>
			<th>AGE</th>
			<th>COUNTY</th>
			<th>COUNTRY</th>
			<th>USERNAME</th>
			<th>PASSWORD</th>
			<th>EMAIL</th>
			<th></th>
			<th></th>
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
				<td>".$data['password']."</td>
				<td>".$data['email']."</td>
				";
				if($status==1)
				{
					echo"
					<td>
				    <form action='actideactivatepatient.php' method='post'>
					<input type='hidden' value='".$data['username']."' name='username' required/>
					<input type='hidden' value='".$data['status']."' name='status' required/>
					<input type='submit' value='Deactivate' style='width:100%;background-color:magenta;color:white;'>
					</form>
					</td>
					";
				}
				else if($status==2)
				{
					echo"
					<td>
				    <form action='actideactivatepatient.php' method='post'>
					<input type='hidden' value='".$data['username']."' name='username' required/>
					<input type='hidden' value='".$data['status']."' name='status' required/>
					<input type='submit' value='Activate' style='width:100%;background-color:purple;color:white;'>
					</form>
					</td>
					";
				}
				echo"
					<td>
					<form action='editpatient.php' method='post'>
					<input type='hidden' value='".$data['username']."' name='username' required/>
					<input type='submit' value='Edit' style='width:100%;background-color:green;color:white;'>
					</form>
					</td>
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
	}
		echo"
		
		<br/><br/>
		<hr style='border:solid 1px black;'/>
		<h1>GENERATE REPORTS FOR PATIENTS</h1>
		<form action='printpatients.php' method='post'>
		select print option:<select name='choice' style='width:70%;'>
		<option>all patients</option>
		<option>active patients</option>
		<option>inactive patients</option>
		</select>
		<input type='submit' value='Print Choice'/>
		</form>
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