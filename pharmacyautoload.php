		<?php
		include"connection.eno";
		error_reporting(E_ERROR); 
		$query=mysqli_query($con,"select * from patientdetails where doctorpharmacy='1' && status='1'");
		$no=mysqli_num_rows($query);
		if($no>1)
		{
			$pharmacylink='<li><a href="doctorreport.php">Doctor Reports<sup> <font color="red" size="4"> '.$no.' </font> </sup></a></li>';
		}
		else if($no <= 0)
		{
			$pharmacylink='<li><a href="">No Doctor Report</a></li>';
		}
		else if($no == 1)
		{
			$pharmacylink='<li><a href="doctorreport.php">Doctor Report<sup> <font color="red" size="4"> '.$no.' </font> </sup></a></li>';
		}
		?>
        <li><a href="pharmacyhome.php">Pharmacy Home</a></li>
		<?php echo $pharmacylink; ?>
        <li class="last"><a href="pharmacylogout.php">Logout</a></li>