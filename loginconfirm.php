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
        <li><a href="index.php">Homepage</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="portforlio.php">Portfolio</a></li>
        <li><a href="">Downloads</a>
          <ul>
            <li><a href="downloads.php">Doctors Schedule</a></li>
            <li><a href="downloads.php">Nurses Schedule</a></li>
            <li><a href="downloads.php">Hospital events</a></li>
          </ul>
        </li>
        <li class="active"><a href="portal.php">Portal</a></li>
        <li class="last"><a href="contactus.php">Contact Us</a></li>
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
	include("connection.eno");
	$username=$_POST['username'];
	$password=$_POST['password'];
	if($password && $username)
	{
		$patientquery=mysqli_query($con,"select * from patientdetails where username='$username' && password='$password'");
		$patientno=mysqli_num_rows($patientquery);
		if($patientno==1)
		{
			//patient login successful
			
			//end patient login successful
		}
		else
		{
			$nursequery=mysqli_query($con,"select * from nurselogin where username='$username' && password='$password'");
			$nurseno=mysqli_num_rows($nursequery);
			if($nurseno==1)
			{
				//nurse login successful
				session_start();
				$_SESSION['nurselogin']=$username;
				header("location:nursehome.php");
				//end nurse login successful
			}
			else
			{
				$doctorquery=mysqli_query($con,"select * from doctordetails where username='$username' && password='$password'");
				$doctorno=mysqli_num_rows($doctorquery);
				if($doctorno==1)
				{
					//doctor login successful
					session_start();
					$_SESSION['doctorlogin']=$username;
					header("location:doctorhome.php");
					//end doctor login successful
				}
				else
				{
					$pharmacyquery=mysqli_query($con,"select * from pharmacydetails where username='$username' && password='$password'");
					$pharmacyno=mysqli_num_rows($pharmacyquery);
					if($pharmacyno==1)
					{
						//pharmacy login successful
						session_start();
						$_SESSION['pharmacylogin']=$username;
						header("location:pharmacyhome.php");
						//end pharmacy login successful
					}
					else
					{
						$labquery=mysqli_query($con,"select * from labdetails where username='$username' && password='$password'");
						$labno=mysqli_num_rows($labquery);
						if($labno==1)
						{
							//lab login successful
							session_start();
							$_SESSION['lablogin']=$username;
							header("location:labhome.php");
							//end lab login successful
						}
						else
						{
							$admissionquery=mysqli_query($con,"select * from admission where username='$username' && password='$password'");
							$admissionno=mysqli_num_rows($admissionquery);
							if($admissionno==1)
							{
								//admission login successful
								session_start();
								$_SESSION['admissionlogin']=$username;
								header("location:admissionhome.php");
								//end of admission login successful
							}
							else
							{
								echo"
								<h1>INFORMATICS LIBRARY RETURNS NEGATIVE</h1>
								<p>
								<progress style='width:80%;'></progress>
								<br/><br/>Wrong username or password<br/><a href='portal.php'>Try Again</a>
								</p>
								";
							}
						}
					}
				}
			}
		}
	}
	else
	{
		echo"neccessary variables not sent in<br /> <a href='portal.php'>Try Again</a>";
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