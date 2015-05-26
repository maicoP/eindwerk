<?php 

$host="kotterapp.be.mysql"; // Host name

$username="kotterapp_be"; // Mysql username

$password="mm11mm22"; // Mysql password

$db_name="kotterapp_be"; // Database name



// Connect to server and select database.

$con = mysqli_connect($host, $username, $password)or die("cannot connect");

mysqli_select_db($con,$db_name)or die("cannot select DB");