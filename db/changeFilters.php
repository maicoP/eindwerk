<?php 
include 'db.php';

$input = file_get_contents("php://input");
$input = json_decode($input);
if($input->field == 'username' || $input->field == 'school')
{
	$sql="UPDATE app_user SET ".$input->field."='".$input->value."' WHERE id=".$input->userid."";
	$result = mysqli_query($con,$sql);
}
else
{
	$sql="UPDATE filters SET ".$input->field."='".$input->value."' WHERE fk_app_userid=".$input->userid."";
	$result = mysqli_query($con,$sql);
}

echo json_encode($input->value);