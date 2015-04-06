<?php 
include 'db.php';
$sql = "SELECT * FROM kot";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++) ;
    
// Delete last empty one
array_pop($array);
echo json_encode($array);

