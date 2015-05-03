<?php 
include 'db.php';

$input = file_get_contents("php://input");
$input = json_decode($input);
if($input->password != '')
{
	$password = md5($input->password);
	$sql="INSERT INTO app_user(username,password) VALUES ('". $input->username . "','". $password . "')";
	$result = mysqli_query($con,$sql);

	echo json_encode(array('result'=>$result,'username'=>$input->username,'password'=>$password,'id' => mysqli_insert_id($con)));
}
else
{
	$sql="INSERT INTO app_user(username) VALUES ('". $input->username ."')";
	$result = mysqli_query($con,$sql);

	echo json_encode(array('result'=>$result,'username'=>$input->username,'password'=>$input->password,'id' => mysqli_insert_id($con)));
}
