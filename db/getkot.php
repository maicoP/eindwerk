<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT kot.* ,images.* FROM kot JOIN  images on kot.id= images.fk_kotid WHERE kot.id NOT IN (SELECT fk_kotid from app_userkot where fk_app_userid ='".$input->userid."') LIMIT 1";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++) ;
array_pop($array);
$resultarray[] = $array[0];
$images = array();
foreach($array as $image)
{
	$images[] = $image['image'];
}

$resultarray[0]["image"] = $images;
    

echo json_encode($resultarray[0]);

