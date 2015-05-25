<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT  kot.* FROM kot join app_userkot on kot.id= app_userkot.fk_kotid where type='like' and  app_userkot.fk_app_userid = '".$input->userid."'";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++)
{
	$sql = "SELECT * FROM images WHERE fk_kotid = '".$array[$i]["id"]."'";
	$resultImages = mysqli_query($con,$sql);
	for($a = 0; $arrayImg[$a] = mysqli_fetch_assoc($resultImages); $a++);
		array_pop($arrayImg);
	$array[$i]['images'] = $arrayImg;
}
array_pop($array);

echo json_encode(array('kotten' => $array));

