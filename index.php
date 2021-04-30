<?php 
	session_start();

	include('connect.php');
	$username = "";

	if(!isset($_SESSION["username"]))
	{
	    header("location: login.php");
	    exit;
	}
	$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    body{
    	font-family: Verdana;
    }
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

    .alert{
	margin: 1px green;
	background: lightgreen;
	text-decoration-color: green;
	}
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Menu</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="profile.php">Profile</a></li>
        <li><a href="ChangePassword.php">Change Password</a></li>
        <li><a href="salary.php">Salary</a></li>
        <li><a href="helpline.php">Helpline</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1 style="background-color: skyblue; color: white;">Doctor at door</h1>  
    <p class="alert">You're successfully logged in.</p>    
    <p style="font-size: 200%;">Welcome, <?php echo $username?></p>
  </div>
</div>
  
<div class="container-fluid bg-3 text-center">    
  <h3><b>Homepage</b></h3><br>
  <div class="row">
    <div class="col-sm-3">
      <p><a href="TimingSchedule.php">Timing Schedule</a></p>
    </div>
    <div class="col-sm-3"> 
      <p><a href="appointments.php">Appointments</a></p>
    </div>
    <div class="col-sm-3"> 
      <p><a href="consulting.php">Consulting Hours</a> </p>
    </div>
    <div class="col-sm-3">
      <p><a href="mails.php">Mails</a></p>
    </div>
  </div>
</div><br>

<div class="container-fluid bg-3 text-center">    
  <div class="row">
    <div class="col-sm-3">
      <p><a href="prescriptionNumber.php">Prescription</a></p>
    </div>
    <div class="col-sm-3"> 
      <p><a href="#">Notes regarding problems</a></p>
    </div>
  </div>
</div><br><br>

<footer class="container-fluid text-center">
  <p>&#169; Copyright since 2020</p>
</footer>

</body>
</html>