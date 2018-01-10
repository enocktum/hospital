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
        <li class="active"><a href="registerpatient.php">Register Patient</a></li>
        <li><a href="viewpatient.php">View Patient</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container"> 
	<center>
	<div style="border:solid 4px black;text-align:center;">
	<h1 style="text-transform:uppercase;font-size:2em;">Patient Registration</h1>
	<form action="registerpatientconfirm.php" method="post">
	<input type="text" placeholder="enter the patient's full name" name="name" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;"/><br/><br/>
	<select style="text-align:left;width:50%;height:1.7em;font-size:1.7em;" name="gender">
	<option>select patients gender</option>
	<option>male</option>
	<option>female</option>
	</select><br/><br/>
	<input type="text" placeholder="enter the patient's username" name="username" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;"/><br/><br/>
	<select style="text-align:left;width:50%;height:1.7em;font-size:1.7em;text-transform:lowercase;" name="country">
	<option>select patients country</option>
	<?php 
	include("connection.eno");
	error_reporting(E_ERROR);
	$query=mysqli_query($con,"select * from country");
	while($data=mysqli_fetch_array($query))
	{
	echo"<option>".$data['nicename']."</option>";
	}
	?>
	</select><br/><br/>
	<input type="text" placeholder="enter the patient's county" name="county" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;"/><br/><br/>
	<input type="text" placeholder="enter the patient's age" name="age" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;"/><br/><br/>
	<input type="email" placeholder="enter the patient's email address" name="email" style="text-align:center;width:50%;height:1.7em;font-size:1.7em;"/><br/><br/>
	<input type="submit" value="Register Patient" style="width:30%;height:2em;font-size:2em;"/><br/><br/>
	</form>
	</div>
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