<?php
	session_start();
	include('connect.php');
	$username = "";
	$salaryAmount = $salaryStatus = "";

	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];
	if(empty($_SESSION["salaryID"]) && empty($_SESSION["salaryAmount"]) && empty($_SESSION["salaryStatus"]))
	{
		$salaryAmount = "N/A";
	    $salaryStatus = "N/A";
	}
	$salaryAmount = $_SESSION['salaryAmount'];
	$salaryStatus = $_SESSION['salaryStatus'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Salary Info</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1 class="header">Salary Info</h1>
	<form>
		<label><b>Amount:</b></label> <span><?php echo $salaryAmount; ?></span>
		<br>
		<label><b>Status:</b></label> <span><?php echo $salaryStatus; ?></span>
	</form>
	<p style="text-align: center;"><a href="index.php">Home</a></p>

</body>
</html>
