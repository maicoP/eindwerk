<?php 
include 'db.php';

$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT * FROM app_user WHERE id=".$input->userid."";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++) ;
array_pop($array);
if($array[0]['id'] == $input->userid)
{
	echo json_encode(array('succes' => true));
}
else
{
	echo json_encode(array('succes' => false));
}
