<?php 
	require_once "connect.php";
	session_start();
	$username="";
	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];
	$password = $newPassword = $newPasswordConfirm = "";
	$passwordErr = $newPasswordErr = $newPasswordConfirmErr = "";
	$error = $success="";

	if ($_SERVER['REQUEST_METHOD']== "POST") 
	{
		$password = $_POST["pass"]; 
		$newPassword = $_POST["newpass"]; 
		$newPasswordConfirm = $_POST["newpassconf"];  

 		if(empty($_POST["pass"]))
 		{
 			$passwordErr = "Please enter a password.";
 		}
 		if(empty($_POST["newpass"]))
 		{
 			$newPasswordErr = "Please enter a new password.";
 		}

 		if(empty($_POST["newpassconf"]))
 		{
 			$newPasswordConfirmErr = "Please enter a new confirmed password.";
 		}
 		if (empty($passwordErr) && empty($newPasswordErr) && empty($newPasswordConfirmErr)) 
 		{
 			$encPassword = base64_encode($password);
 			$result = mysqli_query($conn, "SELECT Password FROM doctor WHERE Username='$username'");
 			$row = mysqli_fetch_assoc($result);

			$oldpassword = $row ['Password'];
 			if(!$result)
        	{
        		$error = "The username you entered does not exist";
        	}
        	else if($encPassword!= $row ['Password'])
        	{
        		$error = "You entered an incorrect password";
        	}
        	else if($newPassword!==$newPasswordConfirm)
        	{
        		$error= "Passwords do not match";
	        }
	        else
	        {
	        	$encPassword2 = base64_encode($newPassword);
        		$sql=mysqli_query($conn, "UPDATE doctor SET Password='$encPassword2' where Username='$username'");
        		if($sql)
		        {
		        	$success= "Congratulations You have successfully changed your password";
		        }
	        }
	        
 
 		}
	}


 ?>

<!DOCTYPE html>
<html>
<title>Change Password</title>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../Project/style.css">
</head>
<body>
	<div class="header">
		<h1>Change password</h1>
		
	</div>
	<form name="changepassForm" action="ChangePassword.php" onsubmit="validateForm()"  method="POST">
		<fieldset>
			<p style="color: green;"><?php echo $success; ?></p>
			<div class="input">
				<label>Current Password:</label>
				<input type="Password" name="pass">
				<span class="error">* <?php echo $passwordErr;?></span>
			</div>
			<br>
			<div class="input">
				<label>New Password:</label>
				<input type="Password" name="newpass">
				<span class="error">* <?php echo $newPasswordErr;?></span>
			</div>
			<br>
			<div class="input">
				<label>Confirm Password:</label>
				<input type="Password" name="newpassconf">
				<span class="error">* <?php echo $newPasswordConfirmErr;?></span>
			</div>
			<br>
			<p class="error"> <?php echo $error;  ?></p>
			<br>
			<div class="input">
				<button type="submit" name="ChangePassword" class="btn">Change Password</button>
			</div>
			<br>
			<p>
				<a href="index.php"><-Back</a>
			</p>
			<br>
		</fieldset>
	</form>
	<script type="text/javascript">
        function validateForm()
        {

            var oldpassword = document.forms['changepassForm']['pass'].value;
            if (oldpassword=="") 
            {
                alert("Please enter your old password.");
                return false;
            }

 

            var newPassword = document.forms['changepassForm']['newpass'].value;
            if (newPassword=="") 
            {
                alert("Please enter new password.");
                return false;
            }

 

            var newPasswordConfirm = document.forms['changepassForm']['newpassconf'].value;
            if (newPasswordConfirm=="") 
            {
                alert("Please confirm new password.");
                return false;
            }

 

            if(newPassword!= newPasswordConfirm)
            {
                alert("Passwords don't match");
                return false;
            }

 

        }
        

 

    </script>

</body>
</html>