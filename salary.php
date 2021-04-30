<?php
	session_start();
	include('connect.php');
	$username = $error = "";

	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];

	$password = $passwordErr ="";
	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		$password = $_POST["pass"];

		if (empty($password)) 
		{
			$passwordErr = "Please enter your password";
		}
		if(empty($passwordErr))
		{
			$encPassword = base64_encode($password);
			$selectQuery1 = "SELECT doctorID from doctor WHERE Username = '$username' AND Password = '$encPassword'";
			$result = mysqli_query($conn, $selectQuery1);
			if($result->num_rows > 0)
			{
				$row = mysqli_fetch_assoc($result);
				$doctorID = $row['doctorID'];
				$selectQuery2 = "SELECT * from Salary WHERE doctorID = '$doctorID'";
				$salary = mysqli_query($conn , $selectQuery2);
				if($salary->num_rows >0)
				{
					$row2 = mysqli_fetch_assoc($salary);
					$_SESSION['salaryID'] = $row2['salaryID'];
					$_SESSION['salaryAmount'] = $row2['Amount']; 
					$_SESSION['salaryStatus'] = $row2['Status']; 
					header("Location: salaryInfo.php");
					exit(); 
				}
				else
				{
					$error = "No salary record.";
				}
			} 
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Salary</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h1>Salary info</h1>
		
	</div>

	<form method="POST" action="salary.php">

		
			<fieldset>
				<p><span class="error" >*required field</span></p>
				<div class="input">
					<label>Password:</label>
					<input type="Password" name="pass">
					<span class="error">* <?php echo $passwordErr;?></span>
				</div>
				<br>
			</fieldset>	
			<br>
			<p class="error"><?php echo $error;?></p>

		<div class="input">
			<button type="submit" name="Login" class="btn">Check Salary</button>
		</div>
			<p>
				<a href="index.php"><-Back</a>
			</p>
	</form>

</body>
</html>