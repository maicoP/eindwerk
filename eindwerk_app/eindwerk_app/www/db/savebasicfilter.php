<?php 
include 'db.php';

$input = file_get_contents("php://input");
$input = json_decode($input);
$sql="UPDATE app_user SET school='".$input->school."',price='".$input->price."' WHERE id=".$input->userid."";
$result = mysqli_query($con,$sql);

echo json_encode(array('result'=>$result));