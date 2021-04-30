<?php
	require_once "connect.php";
	
	session_start();
	

	if (isset($_SESSION['username'])) 
	{
    	header("Location: index.php");
	}

	$uname = $pass ="";
 	$usernameErr = $passwordErr ="";
 	$error = "";
 	
 	if($_SERVER['REQUEST_METHOD']== "POST")
 	{
 		

 		$uname = $_POST["uname"];
 		$pass = $_POST["pass"];

 		if(empty($_POST["uname"]))
 		{
 			$usernameErr = "Please enter a username.";
 		}

 		if(empty($_POST["pass"]))
 		{
 			$passwordErr = "Please enter a password.";
 		}

 		if(empty($usernameErr) && empty($passwordErr))
 		{
 			$encPassword = base64_encode($pass);
	 		$sql = "SELECT * FROM doctor WHERE Username = '$uname' AND Password='$encPassword'";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) 
			{
				$row = mysqli_fetch_assoc($result);
				session_start();
				$_SESSION['username'] = $row['Username'];
				$_SESSION['doctorID'] = $row['doctorID'];
				header("Location: index.php");
				exit;
			} 
			else 
			{
				$error = "Invalid username or password";
			}
 		}
		
 	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h1>Login</h1>
		
	</div>

	<form name="loginForm" method="POST" action="login.php" onsubmit="validateForm()">

		
			<fieldset>
				<p><span class="error" >*required field</span></p>
				<div class="input" id="uname">
					<label>Username:</label>
					<input type="text" name="uname">
					<span class="error">* <?php echo $usernameErr;?></span>
				</div>
				<br>
				<div class="input" id="pass">
					<label>Password:</label>
					<input type="Password" name="pass">
					<span class="error">* <?php echo $passwordErr;?></span>
				</div>
				<br>
			</fieldset>	
			<br>
			<p class="error"> <?php echo $error;?></p>

		<div class="input">
			<button type="submit" name="Login" class="btn">Login</button>
		</div>
			<p>
				Not a member?<a href="Signup.php">Sign-up</a>
			</p>
	</form>
	<script type="text/javascript">
		function validateForm()
		{

			var uname = document.forms['loginForm']['uname'].value;
			if (uname=="") 
			{
				alert("Please enter Username.");
				return false;
			}

			var pass = document.forms['loginForm']['pass'].value;
			if (pass=="") 
			{
				alert("Please enter Password.");
				return false;
			}

		}
		

	</script>

</body>
</html>