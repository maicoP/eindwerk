<?php 
include 'db.php';
$input = file_get_contents("php://input");
$input = json_decode($input);
$sql = "SELECT * FROM filters WHERE fk_app_userid ='".$input->userid."' LIMIT 1";
$filters = mysqli_query($con,$sql);
for($b = 0; $arrayFilt[$b] = mysqli_fetch_assoc($filters); $b++);
array_pop($arrayFilt);
$filters  = $arrayFilt[0];
$sql = "SELECT * FROM kot WHERE id NOT IN (SELECT fk_kotid from app_userkot where fk_app_userid ='".$input->userid."') and id NOT IN ( '" . implode($input->kotids, "', '") . "' )";
if( $filters['bikestands'] == true)
{
	$sql =$sql.'and bikestands = 1 ';
}
if( $filters['seperatebathroom'] == true)
{
	$sql =$sql.'and seperatebathroom = 1 ';
}
if( $filters['seperatekitchen'] == true)
{
	$sql =$sql.'and seperatekitchen = 1 ';
}
if( $filters['furniture'] == true)
{
	$sql =$sql.'and furniture = 1 ';
}
if( $filters['wifi'] == true)
{
	$sql =$sql.'and wifi = 1 ';
}
if( $filters['price'] > 0)
{
	$sql =$sql."and price <= '".$filters['price']."' ";
}
if( $filters['size'] > 0)
{
	$sql =$sql."and size >= '".$filters['size']."' ";
}
if( $filters['startDate'] != 0)
{
	$sql =$sql."and begindate <= '".$filters['startDate']."' ";
}
if( $filters['endDate'] != 0)
{
	$sql =$sql."and enddate >= '".$filters['endDate']."' ";
}
$sql =$sql.'LIMIT 1';
$sqlres = $sql;
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
$resultarray[] = $array[0];
$kot = $resultarray[0];  
echo json_encode(array('kot' => $kot,'filter' => $filters));

