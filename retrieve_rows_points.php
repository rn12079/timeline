<?php

$GLOBALS['host']= "localhost";
$GLOBALS['db'] = "timeline";
$GLOBALS['dbuser'] = 'qasim';
$GLOBALS['dbpass'] = "";

header("Content-Type: application/json; charset=UTF-8");



$myquery = "select @rownum := @rownum + 1 as id, 2 as `group`,'event1' as subgroup, baseevent as content,concat(lpad(year,4,'0'),'-01-01') as start,'point' as type from baseline cross join (select @rownum := (select count(*) from baseline where baseevent is not null and year > 0 and endyear is not null)) r where baseevent is not null and year > 0";

$conn = new mysqli($GLOBALS['host'],$GLOBALS['dbuser'],$GLOBALS['dbpass'],$GLOBALS['db']);
  if ($conn->connect_error)
{
  die('Could not connect: ' . $con->connect_error);
}

$result = $conn->query($myquery);
$ans = array();
while($row = $result->fetch_assoc())
  $ans[] = $row;


mysqli_close ($conn);

echo json_encode($ans,JSON_NUMERIC_CHECK);



?>

