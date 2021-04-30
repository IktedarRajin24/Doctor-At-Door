<?php 
	session_start();

	include('connect.php');
	$username = $appointmentNumber =  $patientID = $patientName = $success = "";

	if(!isset($_SESSION["username"]))
	{
	    header("Location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];


	if (!isset($_SESSION["appointmentNumber"])) 
	{
		header("Location: prescriptionNumber.php");
	    exit;
	}
	$appointmentNumber = $_SESSION['appointmentNumber'];
	$selectQuery1 = "SELECT * From appointment where appointmentNumber like '$appointmentNumber'";
	$result1 = mysqli_query($conn, $selectQuery1);
	$row = mysqli_fetch_array($result1);
	$patientID = $row['patientID'];

	$selectQuery2 = "SELECT * From patient where patientID like '$patientID'";
	$result2 = mysqli_query($conn, $selectQuery2);
	$row = mysqli_fetch_array($result2);
	$patientName = $row['Name'];



	$problem = $medicine = $prescribedTime = $comments = $check ="";
	$problemErr = $medicineErr = $prescribedTimeErr = "";

	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		$problem = $_POST["problem"];
		$medicine = $_POST["medicine"];
		$prescribedTime =  @$_POST["prescribedTime"];
		$comments = $_POST["problem"];

		if(empty($_POST["problem"]))
 		{
 			$problemErr = "Please enter problem of the Patient.";
 		}

 		if(empty($_POST["medicine"]))
 		{
 			$medicineErr = "Please enter medicine name.";
 		}

 		if(empty($_POST["prescribedTime"]))
 		{
 			$prescribedTimeErr = "Please enter time for medicine consumption.";
 		}

 		if(empty($problemErr) && empty($medicineErr) && empty($prescribedTimeErr))
 		{
 			foreach ($prescribedTime as $value) 
			{
				$check.= $value.",";
			}
 			
 			
 			$insertQuery = "INSERT into prescription(problem , prescribedMedicine , precribedTime , comments) values ('$problem' , '$medicine' ,  '$check' , '$comments')";

 			$result = mysqli_query($conn, $insertQuery);

 			if ($result)
			{
				$success = "Prescription successfully added.";
			}

 		}
	} 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Prescription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h1>Prescription</h1>
		
	</div>

	<form name="prescription" method="POST" action="prescription.php">
		<p class="success"><?php echo $success;?></p>
		<fieldset>
			<p><span class="error" >*required field</span></p>
			<div class="input" id="pname">
				<label>Patient Name:</label> <span><?php echo $row['Name']; ?></span>
				
			</div>
			<br>
			<br>

			<div class="input" id="problem">
				<label>Problem:</label>
				<textarea name="problem" rows="8" cols="60"></textarea><br>
				<p class="error">* <?php echo $problemErr;?></p>
				
			</div>
			<br>

			<div class="input" id="medicine">
				<label>Prescribed Medicine:</label>
				<input type="text" name="medicine"><br>
				<p class="error">* <?php echo $medicineErr;?></p>
			</div>
			<br>

			<div class="input" id="prescribedTime">
				<label>Prescribed Time:</label>
				<input type="checkbox" id="prescribedTime" name="prescribedTime[]" value="Morning" <?php if(isset($_POST['submit']) && isset($_POST['prescribedTime'][0])) echo "checked" ?>>
	  			<label for="morning"> Morning</label>
	  			<input type="checkbox" id="prescribedTime" name="prescribedTime[]" value="Afternoon" <?php if(isset($_POST['submit']) && isset($_POST['prescribedTime'][1])) echo "checked" ?>>
	  			<label for="afternoon"> Afternoon</label>
	  			<input type="checkbox" id="prescribedTime" name="prescribedTime[]" value="Night" <?php if(isset($_POST['submit']) && isset($_POST['prescribedTime'][2])) echo "checked" ?>>
	  			<label for="night"> Night</label>
	  			<br>
				<p class="error">* <?php echo $prescribedTimeErr;?></p>
			</div>
			<br>

			<div class="input" id="pname">
				<label>Comments</label>
				<textarea rows="8" cols="60">(Optional)</textarea>
				
			</div>
			<br>

			<div class="input">
				<button type="submit" name="Prescribe" class="btn">Prescribe</button>
			</div>
			<br>

			<a href="index.php"><-Back</a>
			<br>
		</fieldset>
	</form>

</body>
</html>