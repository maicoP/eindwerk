<?php 
$host="mysql.2freehosting.com"; // Host name
$username="u118779281_eindw"; // Mysql username
$password="mm22mm33"; // Mysql password
$db_name="u118779281_eindw"; // Database name

// Connect to server and select database.
$con = mysqli_connect($host, $username, $password)or die("cannot connect");
mysqli_select_db($con,$db_name)or die("cannot select DB");