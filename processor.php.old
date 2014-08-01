<?php
require_once('db.php');

$comma = chr(127);
$quotes = chr(128);


$header = NULL; // need this for the loop
$lines = file('test.txt', FILE_IGNORE_NEW_LINES); // that damn flag was pretty useful actually
 foreach ($lines as $line_num => $line) {
	$array[$line_num] = explode($comma,$line); // using our ASCII character to explode the strings to array elements
	if ($line_num == 0) { $header = $array[$line_num]; } // load the header values into a discrete array
	if($line_num > 0) { $array[$line_num] = array_combine($header,$array[$line_num]); } // more literal keys to work with later
	}
	array_shift($array); 
	unset($header); // pop off the headers
	
	$q_mostrecentgame = query("SELECT MAX(gameno) FROM games LIMIT 1");
	$mostrecentgame = mysql_result($q_mostrecentgame,0);
	$mostrecentgame++;

	$i = 0;

	for ($array[$i]; $i < count($array); $i++) {
			$key1 = "id,gameno,timestamp,";
			$value1 = "NULL,".$mostrecentgame.",NULL,";
			
			$valimp1 = implode(chr(10),preg_replace('/[\x00-\x1F\x80-\xFF]/','',array_values($array[$i])));
			$keyimp1 = implode(chr(10),preg_replace('/[\x00-\x1F\x80-\xFF]/','',array_keys($array[$i])));
			$val[$i] = explode(chr(10),$valimp1);
			$key[$i] = explode(chr(10),$keyimp1);
			$val[$i][0] = "'".preg_replace(array('/,/','/"/',"/'/"), array('\,','\"',"\'"),$val[$i][0])."'";
			$val[$i][28] = "'".preg_replace(array('/,/','/"/',"/'/"), array('\,','\"',"\'"),$val[$i][28])."'";
			$array[$i] = array_combine($key[$i],$val[$i]);
	
			$key2 = implode(",",preg_replace('/[\x00-\x1F\x80-\xFF]/','',array_keys($array[$i])));
			$value2 = implode(",",preg_replace('/[\x00-\x1F\x80-\xFF]/','',array_values($array[$i])));
			$keys = $key1.$key2;
			$values = $value1.$value2;
			query("INSERT INTO games(".$keys.") VALUES (".$values.")"); 
	}
	
?>