<?php
	session_start();

	include('connect.php');
	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];
	$doctorID = $_SESSION['doctorID'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Consulting hour</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1 class="header">Consulting time</h1>
	<form>
		<?php
			$sql = "SELECT doctorScheduleDate, doctorScheduleDay , doctorScheduleStartTime , doctorScheduleEndTime  FROM doctorScheduleTable WHERE doctorID = '$doctorID' ";
			$result = mysqli_query($conn, $sql);
			if($result)
			{

	    		if(mysqli_num_rows($result) > 0)
	    		{
	        		echo "<table class='center'>";
	            	echo "<tr>";
	                echo "<th>Schedule Date</th>";
	                echo "<th>Schedule Day</th>";
	                echo "<th>Schedule Start Time</th>";
	                echo "<th>Schedule End Time</th>";
	            	echo "</tr>";
	        		while($row = mysqli_fetch_array($result))
	        		{
	            		echo "<tr>";
	                	echo "<td>" . $row['doctorScheduleDate'] . "</td>";
	                	echo "<td>" . $row['doctorScheduleDay'] . "</td>";
	                	echo "<td>" . $row['doctorScheduleStartTime'] . "</td>";
	                	echo "<td>" . $row['doctorScheduleEndTime'] . "</td>";
	            		echo "</tr>";
	        		}	
	        echo "</table>";
	    		}
	    	}


		?>
		<p><a href="index.php"><-Back</a></p>
		
	</form>

</body>
</html>