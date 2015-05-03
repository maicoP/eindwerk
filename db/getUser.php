<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT * FROM app_user where id = '".$input->userid."' LIMIT 1";
$result = mysqli_query($con,$sql);

echo json_encode(array('succes' => true , 'result' => mysqli_fetch_assoc($result)));