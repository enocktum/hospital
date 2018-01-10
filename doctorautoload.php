	<?php 
	include"connection.eno";
	error_reporting(E_ERROR);
	//checking for available patients
	$check=mysqli_query($con,"select * from patientdetails where needdoctor='1' && status='1'");
	$no=mysqli_num_rows($check);
	if($no>1)
	{
		$patientreport="<li><a href='attendpatient.php'> Attend Patients<sup><font color='red' size='4'> ".$no." </font></sup></a></li>";
	}
	else if($no == 1)
	{
		$patientreport="<li><a href='attendpatient.php'> Attend Patient<sup><font color='red' size='4'> ".$no." </font></sup></a></li>";
	}
	else
	{
		$patientreport="<li><a href='' title='No patients are available for treatment at this time, wait till this part changes to Attend Patient(s)'>No Patient to Attend</a></li>";
	}
	//end
	
	//checking for reports from lab to doctor
	$ona=mysqli_query($con,"select * from patientdetails where labdoctor='1' && status='1'");
	$ngapi=mysqli_num_rows($ona);
	if($ngapi>1)
	{
		$labreport="<li><a href='labreport.php'> Lab Reports<sup><font color='red' size='4'> ".$ngapi." </font></sup></a></li>";
	}
	else if($ngapi == 1)
	{
		$labreport="<li><a href='labreport.php'> Lab Report<sup><font color='red' size='4'> ".$ngapi." </font></sup></a></li>";
	}
	else
	{
		$labreport="<li><a href='' title='no lab report available at the moment'>No Lab Report</a></li>";
	}
	//end
	?>
		<li><a href="doctorhome.php">Doctor Home</a></li>
        <?php echo $patientreport; ?> 
        <?php echo $labreport; ?> 
        <li><a href="doctoralerts.php">Alerts</a></li>
        <li class="last"><a href="doctorlogout.php">Logout</a></li>