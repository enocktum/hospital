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
	<div style="border:solid 4px grey;width:50%;">
	<h1 style="font-size:2em;">USER LOGIN PANEL</h1>
    <p>
	<form action="loginconfirm.php" method="post">
	<input style="width:90%;font-size:2em;height:2em;text-align:center;color:black;background-color:white;" type="text" placeholder="enter your username" name="username" required autofocus/><br/><br/><br/>
	<input style="width:90%;font-size:2em;height:2em;text-align:center;color:black;background-color:white;" type="password" placeholder="enter your password" name="password" required/><br/><br/><br/>
	<input style="font-size:2em;width:50%;" type="submit" value="Login"/><br/><br/>
	<div style="text-align:center;font-size:1.5em;">Forgot your password? <a href="">Click Here</a></div>
	</form>
	</p>
	</center>
	</div>
    
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