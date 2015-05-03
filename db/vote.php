<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql="INSERT INTO app_userkot(type,fk_app_userid,fk_kotid) VALUES ('". $input->vote . "','". $input->userid . "','". $input->kotid . "')";
$result = mysqli_query($con,$sql);

echo json_encode($result);