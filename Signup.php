<?php

	$name = $sex = $dob = $bloodgroup = $uname = $email = $pass1 = $pass2 = $password= $degree= $speciality= $status="";
	$nameErr = $sexErr = $dobErr = $bloodgroupErr = $unameErr = $emailErr = $pass1Err = $pass2Err = $passwordErr= $degreeErr= $specialityErr= $statusErr="";

	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		include('connect.php');

		$name = $_POST['name'];
		$sex = @$_POST['sex'];
		$dob = $_POST['DOB'];
		$bloodgroup = $_POST['bloodgroup'];
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$pass1 = $_POST['pass'];
		$pass2 = $_POST['cpass'];
		$degree = $_POST['degree'];
		$speciality = $_POST['speciality'];
		$status = @$_POST['status'];

		if (empty($_POST["name"])) 
	  	{
	    	$nameErr = "Name is required";
	  	} 

	   	if (!isset($_POST["sex"])) 
	   	{
	   		$sexErr = "Sex is required";

	   	}

	   	if (empty($_POST["DOB"])) 
	   	{
    		$dobErr = "Date of birth is required";
  		} 

  		if (empty($_POST["bloodgroup"])) 
  		{
    		$bloodgroupErr = "Blood Group is required";
  		} 

  		if (empty($_POST["uname"])) 
  		{
    		$unameErr = "Username is required";
  		}
  		else 
	  	{ 
	      	if (!preg_match("/^[a-zA-Z-' _]*$/",$uname)) 
	     	{
	        	$unameErr = "Only letters and white space allowed";
	      	}
	  	} 

  		if (empty($_POST["email"])) 
  		{
    		$emailErr = "Email is required";
  		} 
  		else 
  		{
    		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    		{
      			$emailErr = "Invalid email format";
    		}
  		}

  		if (empty($_POST["pass"])) 
  		{
    		$pass1Err = "Password is required";
  		} 

  		if (empty($_POST["cpass"])) 
  		{
    		$pass2Err = "Please confirm password";
  		} 

  		if ($pass1 !== $pass2) 
    	{
    		$passwordErr=  "!Password doesn't match.";
    	}
    	if (empty($_POST["degree"])) 
	  	{
	    	$degreeErr = "Degree is required";
	  	} 
	  	if (empty($_POST["speciality"])) 
	  	{
	    	$specialityErr = "speciality is required";
	  	}
	  	if (!isset($_POST["status"])) 
	   	{
	   		$statusErr = "Status is required";
	   	} 



    	if(empty($nameErr) && empty($sexErr) && empty($dobErr) && empty($bloodgroupErr) && empty($unameErr) && empty($emailErr) && empty($pass1Err) && empty($pass2Err) && empty($passwordErr) && empty($degreeErr) && empty($specialityErr) && empty($statusErr))
    	{
    		$password = base64_encode($pass1);
			$insertQuery = "INSERT into doctor (Name, Sex, DOB, BloodGroup, Username, Email, Password, Degree, ExpertIn, Status) values ('$name', '$sex', '$dob', '$bloodgroup', '$uname', '$email', '$password', '$degree', '$speciality', '$status')";

			$result = mysqli_query($conn, $insertQuery);

			if ($result)
			{
				header("Location: login.php");
				die();
			}

    	}	


        
	}
    	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h1>Sign-Up</h1>
		
	</div>

	<form name="signupForm" action="Signup.php"  method="POST" onsubmit="validateForm()">
		<p><span class="error" >*required field</span></p>
		<fieldset>
			<legend><b>Basic Information</b></legend>
			<div class="input" id="name">
				<label>Name:</label>
				<input type="text" name="name">
				<span class="error">* <?php echo $nameErr;?></span>
			</div>
			
			<br>

			<div class="input" id="sex">
				<label>Sex:</label>
				<input type="radio" name="sex" value="female">Female
				<input type="radio" name="sex" value="male">Male
				<input type="radio" name="sex" value="other">Other
				<span class="error">* <?php echo $sexErr;?></span>
			</div>
			
			<br>

			<div class="input" id="dob">
				<label>Date of Birth:</label>
				<input type="date" name="DOB">
				<span class="error">* <?php echo $dobErr;?></span>
			</div>
			
			<br>
			<div class="input" id="bloodgroup">
				<label>Blood Group:</label>
				<select name="bloodgroup">
					<option>---Select---</option>
				    <option value="A Positive">A Positive</option>
				    <option value="A Negative">A Negative</option>
				    <option value="B Positive">B Positive</option>
				    <option value="B Negative">B Negative</option>
				    <option value="AB Positive">AB Positive</option>
				    <option value="AB Negative">AB Negative</option>
				    <option value="O Positive">O Positive</option>
				    <option value="O Negative">O Negative</option>
				</select>
				<span class="error">* <?php 
				if(isset($bloodgroupErr))
				{
					echo $bloodgroupErr;
				}
				?></span>
			</div>
			
			<br>
		</fieldset>
		<br>

		<fieldset>
			<legend><b>User Information</b></legend>
			<div class="input" id="uname">
				<label>Username:</label>
				<input type="text" name="uname">
				<span class="error">* <?php echo $unameErr;?></span>
			</div>
			<br>
			<div class="input" id="email">
				<label>E-mail:</label>
				<input type="email" name="email">
				<span class="error">* <?php echo $emailErr;?></span>
			</div>
			<br>
			<div class="input" id="pass">
				<label>Password:</label>
				<input type="Password" name="pass">
				<span class="error">* <?php echo $pass1Err;?></span>
			</div>
			<br>
			<div class="input" id="cpass">
				<label>Confirm Password:</label>
				<input type="Password" name="cpass">
				<span class="error">* <?php echo $pass2Err;?></span>
			</div>
			<br>
			<p class="error"><?php echo $passwordErr; ?></p>
		</fieldset>
		<br>
		<fieldset>
			<legend>Professional Information</legend>
			<div class="input" id="degree">
				<label>Degree:</label>
				<input type="text" name="degree">
				<span class="error">* <?php echo $degreeErr;?></span>
			</div>
			<br>
			<div class="input" id="speciality">
				<label>Expert In:</label>
				<select name="speciality">
					<option>---Select---</option>
				    <option value="Gynae">Gynae</option>
				    <option value="Sergen">Sergen</option>
				    <option value="Medicine">Medicine</option>
				</select>
				<span class="error">* <?php echo $specialityErr;?></span>
			</div>
			<br>
			<div class="input" id="status">
				<label>Status:</label>
				<input type="radio" name="status" value="active">Active
				<input type="radio" name="status" value="inactive">Inactive
				<span class="error">* <?php echo $statusErr;?></span>
			</div>

		</fieldset>
		<br>

		<div class="input">
			<button type="submit" name="Sign-Up" class="btn">Register</button>
		</div>
		<p>
			Already registered?<a href="login.php">Login</a>
		</p>
	</form>
	<script type="text/javascript">
		function validateForm()
		{
			var name = document.forms['signupForm']['name'].value;
			if (name=="") 
			{
				alert("Please enter name.");
				return false;
			}

			var sex = document.forms['signupForm']['sex'].value;
			if (sex=="") 
			{
				alert("Please enter sex.");
				return false;
			}

			var dob = document.forms['signupForm']['dob'].value;
			if (dob=="") 
			{
				alert("Please enter date of birth.");
				return false;
			}

			var bloodgroup = document.forms['signupForm']['bloodgroup'].value;
			if (bloodgroup=="") 
			{
				alert("Please enter Blood Group.");
				return false;
			}

			var uname = document.forms['signupForm']['uname'].value;
			if (uname=="") 
			{
				alert("Please enter Username.");
				return false;
			}

			var email = document.forms['signupForm']['email'].value;
			if (email=="") 
			{
				alert("Please enter E-mail.");
				return false;
			}

			var pass1 = document.forms['signupForm']['pass'].value;
			if (pass1=="") 
			{
				alert("Please enter Password.");
				return false;
			}

			var pass2 = document.forms['signupForm']['cpass'].value;
			if (pass2=="") 
			{
				alert("Please confirm password.");
				return false;
			}

			var degree = document.forms['signupForm']['degree'].value;
			if (degree=="") 
			{
				alert("Please enter Degree.");
				return false;
			}

			var speciality = document.forms['signupForm']['speciality'].value;
			if (speciality=="") 
			{
				alert("Please enter speciality.");
				return false;
			}

			var status = document.forms['signupForm']['status'].value;
			if (status=="") 
			{
				alert("Please enter status.");
				return false;
			}

			if(pass1!= pass2)
			{
				alert("Passwords don't match");
				return false;
			}
		}
		

	</script>

</body>
</html>