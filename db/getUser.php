<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT filters.* , app_user.* FROM app_user JOIN filters on app_user.id=filters.fk_app_userid  where app_user.id = '".$input->userid."' LIMIT 1";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++) ;
array_pop($array);
echo json_encode(array('succes' => true , 'result' => $array));