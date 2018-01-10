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
	<p>
	<?php
	error_reporting(E_ERROR);
	include"connection.eno";
	$username=$_POST['username'];
	if($username)
	{
		$query=mysqli_query($con,"select * from patientdetails where username='$username'");
		$no=mysqli_num_rows($query);
		if($no==1)
		{
			$data=mysqli_fetch_array($query);
			?>
	<div style="border:solid 4px black;text-align:center;">
	<h1 style="text-transform:uppercase;font-size:2em;">Editing Patient Details</h1>
	<form action="editpatientconfirm.php" method="post">
	<input type="hidden" value="<?php echo $username?>" name="username" required />
	<input type="text" placeholder="edit patient name which previously was <?php echo $data['name']?>" name="name" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;" value="<?php echo $data['name']?>"/><br/><br/>
	<input type="text" placeholder="edit patient password which previously was <?php echo $data['password']?>" name="password" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;" value="<?php echo $data['password']?>"/><br/><br/>
	<input type="text" placeholder="edit patient county which previously was <?php echo $data['county']?>" name="county" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;" value="<?php echo $data['county']?>"/><br/><br/>
	<input type="text" placeholder="edit patient age which previously was <?php echo $data['age']?>" name="age" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;" value="<?php echo $data['age']?>"/><br/><br/>
	<input type="email" placeholder="edit patient email which previously was <?php echo $data['email']?>" name="email" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;" value="<?php echo $data['email']?>"/><br/><br/>
	<input type="submit" value="Update Patient" style="width:30%;height:2em;font-size:2em;"/><br/><br/>
	</form>
	</div>
			<?php
		}
		else
		{
			echo"there are no patient in the database with the username $username<br/><a href='viewpatient.php'>Try Again</a>";
		}
	}
	else
	{
		echo"necessary variables not sent in<br/><a href='viewpatient.php'>Try Again</a>";
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