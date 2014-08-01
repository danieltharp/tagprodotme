<?php require_once('functions.php');
require_once('db.php');
if($_REQUEST['term'] != "%") {
$escaped = urldecode(mysql_real_escape_string($_REQUEST['term']));
$req = "SELECT DISTINCT name "
	."FROM games "
	."WHERE name LIKE '".$escaped."%' "; 

$query = mysql_query($req);
$results = array();
while($row = mysql_fetch_array($query))
{
	$row = str_replace('\\','',$row);
	$results[] = array('label' => $row['name'],
						'url' => "player.php?id=".urlencode(mysql_real_escape_string($row['name'])));
}

echo json_encode($results); }
?>