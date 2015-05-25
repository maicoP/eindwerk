<?php 
include 'db.php';
$sql = "SELECT  name from schools order by name ASC";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++);
array_pop($array);

echo json_encode($array);