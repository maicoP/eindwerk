<?php 
$host="fdb13.biz.nf"; // Host name
$username="1847346_eindwerk"; // Mysql username
$password="mm22mm33"; // Mysql password
$db_name="1847346_eindwerk"; // Database name

// Connect to server and select database.
$con = mysqli_connect($host, $username, $password)or die("cannot connect");
mysqli_select_db($con,$db_name)or die("cannot select DB");