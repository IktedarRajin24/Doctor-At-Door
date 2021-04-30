<?php
	session_start();

	include('connect.php');
	$username = "";
	$alert="";

	if(!isset($_SESSION["username"]))
	{
		header("location: login.php");
		exit;
	}
	$username = $_SESSION['username'];
	$query="SELECT * FROM doctor where Username='$username'";
	$result = mysqli_query($conn, $query);
	$row=mysqli_fetch_array($result);

	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$dob = $_POST['DOB'];
		$bloodgroup = $_POST['bloodgroup'];
		$email = $_POST['email'];
		$degree = $_POST['degree'];
		$speciality = $_POST['speciality'];

		$updateQuery = "UPDATE doctor SET Name = '$name', Sex = '$sex',DOB = '$dob',BloodGroup = '$bloodgroup',Email = '$email',Degree = '$degree',ExpertIn = '$speciality' WHERE Username = '$username'";

		$result = mysqli_query($conn, $updateQuery);
		if ($result) 
		{
			$alert = "Updated successfully";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<div class="header">
		<h1>Profile</h1>
		
	</div>
	<form method="POST" action="profile.php">
			<p style="color: green;"><?php echo $alert?></p>
			<div class="input">
				<label>Name:</label>
				<input type="text" name="name" value="<?php echo $row['Name']; ?>">
			</div>
			<br>

			<div class="input">
				<label>Sex:</label>
				<input type="text" name="sex" value="<?php echo $row['Sex']; ?>">
			</div>
			<br>

			<div class="input">
				<label>Date of Birth:</label>
				<input type="date" name="DOB" value="<?php echo $row['DOB']; ?>">
			</div>
			<br>

			<div class="input">
				<label>Blood Group:</label>
				<input type="text" name="bloodgroup" value="<?php echo $row['BloodGroup']; ?>">
			</div>
			<br>

			<div class="input">
				<label>Username:</label> <span><?php echo $row['Username']; ?></span>
			</div>
			<br>
			<div class="input">
				<label>E-mail:</label>
				<input type="text" name="email" value="<?php echo $row['Email']; ?>">
			</div>
			<br>

			<div class="input">
				<label>Degree:</label>
				<input type="text" name="degree" value="<?php echo $row['Degree']; ?>">
			</div>
			<br>
			<div class="input">
				<label>Expert In:</label>
				<input type="text" name="speciality" value="<?php echo $row['ExpertIn']; ?>">
			</div>
			<br>
			<div class="input">
				<label>Status:</label> <span><?php echo $row['Status']; ?></span>
			</div>
			<br>
			<p><a href="index.php"><-Back</a></p>
			<br>
			<div class="input">
				<button type="submit" name="Update" class="btn">Update</button>
			</div>

</body>
</html>