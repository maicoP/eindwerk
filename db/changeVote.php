<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql="UPDATE app_userkot set type='dislike' where fk_app_userid='".$input->userid."' and fk_kotid='".$input->kotid."'";
$result = mysqli_query($con,$sql);

echo json_encode($result);