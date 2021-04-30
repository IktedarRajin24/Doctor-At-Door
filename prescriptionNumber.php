<?php
	session_start();

	include('connect.php');
	$username = $alert = $error = $searchErr ="";

	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}

	if ($_SERVER['REQUEST_METHOD']== "POST") 
	{
		$appointmentNumber = $_POST['appointments'];
		if (empty($appointmentNumber)) 
		{
			$searchErr = "Please insert an appointment number";
		}
		if(empty($searchErr))
		{
			$_SESSION['appointmentNumber'] = $appointmentNumber;
			header("Location: prescription.php");
		}
	}

  ?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	

<title>Prescription Time</title>
</head>

	<h1 class="header">Search for prescription</h1>
	<div>
		<form action="prescriptionNumber.php" method="POST">
			<p class="error"><?php echo "*".$searchErr;  ?></p>
			<label><b>Search appointment number:</b></label>
			<input type="text" name="appointments" id="appointments" placeholder="Type in the appointment number" oninput="showUser(this.value)">

			<input type="submit" name="Prescribe" value="Prescribe" class="btn">

			<p><a href="index.php"><-Back</a></p>
		</form>
		<br>
		<div id="txtHint"></div>
		<br>

	</div>

	<script>
		function showUser(str)
		{
			if (str=="") 
			{
				document.getElementById("txtHint").innerHTML="";
				return;
			}

			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() 
			{
				if (this.readyState==4 && this.status==200) 
				{
					document.getElementById("txtHint").innerHTML=this.responseText;
				}
			}
			xmlhttp.open("GET","appointments.php?appointments="+str,true);
			xmlhttp.send();
		}
	</script>
</body>
</html>