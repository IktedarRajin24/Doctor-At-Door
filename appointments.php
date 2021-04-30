<?php

	session_start();
	include('connect.php');

	$username = $doctorID = "";

	if(!isset($_SESSION["username"]) && !isset($_SESSION["doctorID"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];
	$doctorID = $_SESSION["doctorID"];

		

?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointments</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1 class="header">Appointments</h1>
	<form>
		<?php
			$appointmentNumber =$_GET["appointments"];
			$sql = "SELECT * FROM appointment WHERE appointmentNumber like '$appointmentNumber%' ";
			$result = mysqli_query($conn, $sql);
			if($result)
			{

	    		if(mysqli_num_rows($result) > 0)
	    		{
	        		echo "<table class='center'>";
	            	echo "<tr>";
	                echo "<th>Appointment Number</th>";
	                echo "<th>Reason For Appointment</th>";
	                echo "<th>Appointment Time</th>";
	                echo "<th>Status</th>";
	            	echo "</tr>";
	        		while($row = mysqli_fetch_array($result))
	        		{
	            		echo "<tr>";
	                	echo "<td>" . $row['appointmentNumber'] . "</td>";
	                	echo "<td>" . $row['reasonForAppointment'] . "</td>";
	                	echo "<td>" . $row['appointmentTime'] . "</td>";
	                	echo "<td>" . $row['status'] . "</td>";
	            		echo "</tr>";
	        		}	
	        echo "</table>";
	    		}
	    	}


		?>
		<br>
		<a href="index.php"><-Back</a>
	</form>




</body>
</html>