<?php

$GLOBALS['host']= "localhost";
$GLOBALS['db'] = "timeline";
$GLOBALS['dbuser'] = 'qasim';
$GLOBALS['dbpass'] = "";

header("Content-Type: application/json; charset=UTF-8");

$myquery = "select @rownum := @rownum + 1 as id, 3 as `group`,'era' as subgroup, concat(concat(eraname,concat('<br>',endyear-year+1)),' years')	 as content,concat(lpad(year,4,'0'),'-01-01') as start,concat(lpad(endyear,4,'0'),'-12-31') as end, case when year > 609 and year < 661 then 'postislam' else 'default' end as className from baseline cross join (select @rownum := 0) r where baseevent is not null and year > 0 and endyear is not null";

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

