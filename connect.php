<?php

	$DBhostname='localhost';
	$DBusername='User';
	$DBpassword='123';
	$DBname= 'doctorPatient';
	$conn= mysqli_connect($DBhostname,$DBusername,$DBpassword,$DBname);

    if ($conn->connect_error) 
    {
       die("Error". mysqli_connect_error());
    }
?>