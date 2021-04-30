<?php
	session_start();

	include('connect.php');
	$username = $alert = $error ="";

	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];
	$doctorID = $_SESSION['doctorID'];

	$scheduleDate = $scheduleDay = $startTime = $endTime = $status = $check ="";
	$scheduleDateErr = $scheduleDayErr = $startTimeErr = $endTimeErr = $statusErr ="";

	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		$scheduleDate = $_POST["scheduleDate"];
		$scheduleDay = @$_POST["scheduleDay"];
		$startTime = $_POST["startTime"];
		$endTime = $_POST["endTime"];
		$status = @$_POST["status"];

		if (empty($_POST["scheduleDate"])) 
		{
			$scheduleDateErr = "Please enter a date";
		}
		if (empty($_POST["scheduleDay"])) 
		{
			$scheduleDayErr = "Please enter a day";
		}
		if (empty($_POST["startTime"])) 
		{
			$startTimeErr = "Please enter a start time";
		}
		if (empty($_POST["endTime"])) 
		{
			$endTimeErr = "Please enter an end time";
		}
		if (empty($_POST["status"])) 
		{
			$statusErr = "Please enter status";
		}
		if(empty($scheduleDateErr) && empty($scheduleDayErr) && empty($startTimeErr) && empty($endTimeErr) && empty($statusErr))
		{
			foreach ($scheduleDay as $value) 
			{
				$check.= $value.",";
			}
			function differenceInHours($starttime,$endtime)
			{
				$starttimestamp = strtotime($starttime);
				$endtimestamp = strtotime($endtime);
				$difference = abs($endtimestamp - $starttimestamp)/3600;
				return $difference;
			}
			$averageTime = differenceInHours($startTime,$endTime);

			$sql = "INSERT INTO doctorscheduletable (doctorID , doctorScheduleDate, doctorScheduleDay, doctorScheduleStartTime, doctorScheduleEndTime, averageConsultingTime, doctorScheduleStatus) values((SELECT doctorID From doctor WHERE Username = '$username'), '$scheduleDate' , '$check' , '$startTime', '$endTime', '$averageTime' , '$status')";
			$result = mysqli_query($conn, $sql);

			if ($result)
			{
				$alert = "Time Schedule updated.";
			}
			else
			{
				$error = "failed";
			}
		}
	}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Timing Schedule</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<h1 class="header">Timing Schedule</h1>
	<form action="TimingSchedule.php" method="POST">
		<p class="alert"><?php echo $alert; ?></p>
 		<p class="error"><?php echo $error; ?></p>
		<fieldset>
			<div class="input" id="uname">
				<label>Username:</label>
				<label><?php echo $username; ?></label>
			</div>
			<br>

			<div class="input">
				<label>Schedule Date:</label>
				<input type="date" name="scheduleDate">
				<span class="error">* <?php echo $scheduleDateErr;?></span>
			</div>
			<br>

			<div class="input">
				<label>Schedule Day:</label>
				<br>
				<input type="checkbox"  name="scheduleDay[]" value="Sunday">
	  			<label for="Sunday"> Sunday</label>

	  			<input type="checkbox"  name="scheduleDay[]" value="Monday">
	  			<label for="Monday"> Monday</label>

	  			<input type="checkbox"  name="scheduleDay[]" value="Tuesday">
	  			<label for="Tuesday"> Tuesday</label>

	  			<input type="checkbox"  name="scheduleDay[]" value="Wednesday">
	  			<label for="Wednesday"> Wednesday</label>

	  			<input type="checkbox"  name="scheduleDay[]" value="Thursday">
	  			<label for="Thursday"> Thursday</label>

	  			<input type="checkbox"  name="scheduleDay[]" value="Saturday">
	  			<label for="Saturday"> Saturday</label>
	  			<span class="error">* <?php echo $scheduleDayErr;?></span>
			</div>
			<br>

			<div class="input">
				<label>Start Time:</label>
				<input type="time" name="startTime">
				<span class="error">* <?php echo $startTimeErr;?></span>
			</div>
			<br>

			<div class="input">
				<label>End Time:</label>
				<input type="time" name="endTime">
				<span class="error">* <?php echo $endTimeErr;?></span>
			</div>
			<br>

			<div class="input">
				<label>Status:</label>
				<input type="radio" name="status" value="active">Active
				<input type="radio" name="status" value="inactive">Inactive
				<span class="error">* <?php echo $statusErr;?></span>
			</div>
			<br>


			<div class="input">
				<button type="submit" name="Submit" class="btn">Submit</button>
			</div>
			<br>

			<a href="index.php"><-Back</a>
			<br>


		</fieldset>


 		
	</form>
    
    
    
</body>
</html>