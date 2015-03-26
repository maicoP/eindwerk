<?php 
$host="www.db4free.net"; // Host name
$username="homestead"; // Mysql username
$password="password"; // Mysql password
$db_name="eindwerk"; // Database name

// Connect to server and select database.
$con = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");