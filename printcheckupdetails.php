<?php
session_start(); 
if(!isset($_SESSION['nurselogin']))
{
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<body onload='print()'>
<center>
<?php 
error_reporting(E_ERROR);
include"connection.eno";
$username=$_POST['username'];
if($username)
{
	$query=mysqli_query($con,"select * from checkup where username='$username'");
	$data=mysqli_fetch_array($query);
	echo"
	<a style='color:black;' href='checkup.php'><h1 style='text-transform:uppercase;'>Check Up Results for $username</h1></a>
	<hr style='border:solid 2px black;'/>
	<table border='0' style='width:100%;text-align:left;'>
	<tr>
		<th>Blood Pressure</th>
		<th>Blood Type</th>
		<th>Pulse Rate</th>
		<th>Weight</th>
	</tr>
	<tr>
		<td>".$data['bloodpressure']."</td>
		<td>".$data['bloodtype']."</td>
		<td>".$data['pulserate']."</td>
		<td>".$data['weight']."</td>
	</tr>
	</table>
	";
}
else
{
	header("location:checkup.php");
}
?>
</center>
</body>
</html>