		<?php 
		include"connection.eno";
		error_reporting(E_ERROR);
		$query=mysqli_query($con,"select * from patientdetails where doctorlab='1' && status='1'");
		$no=mysqli_num_rows($query);
		if($no > 1)
		{
			$labreport='<li><a href="doctorlabreport.php">Doctor Lab Reports <sup> <font size="4" color="red">'.$no.'</font></sup></a></li>';
		}
		else if($no == 1)
		{
			$labreport='<li><a href="doctorlabreport.php">Doctor Lab Report <sup> <font size="4" color="red">'.$no.'</font></sup></a></li>';
		}
		else if($no <= 0)
		{
			 $labreport='<li><a href="">No Doctor Lab Report</sup></a></li>';
		}
		?>
		
		
		<li><a href="labhome.php">Laboratory Home</a></li>
        <?php echo $labreport; ?>
        <li class="last"><a href="lablogout.php">Logout</a></li>
