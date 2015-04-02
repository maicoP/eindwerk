<?php 
include 'db.php';
$sql = "SELECT * FROM kot";
$result = mysql_query($sql);
for($i = 0; $array[$i] = mysql_fetch_assoc($result); $i++) ;
    
// Delete last empty one
array_pop($array);
echo json_encode($array);

