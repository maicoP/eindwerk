<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT * FROM kot WHERE id NOT IN (SELECT fk_kotid from app_userkot where fk_app_userid ='".$input->userid."') LIMIT 1";
$result = mysqli_query($con,$sql);
for($i = 0; $array[$i] = mysqli_fetch_assoc($result); $i++) ;
array_pop($array);
$resultarray[] = $array[0];
$sql = "SELECT * FROM images WHERE fk_kotid = '".$resultarray[0]["id"]."'";
$result = mysqli_query($con,$sql);
for($i = 0; $images[$i] = mysqli_fetch_assoc($result); $i++) ;
array_pop($images);

    

echo json_encode(array('kot' =>$resultarray[0], 'images' => $images));

