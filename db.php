<?php

$host = ""; //mysql host
$username = ""; //mysql username 
$password = ""; //mysql password
$database = ""; //mysql database

	$link = mysql_connect($host,$username,$password)
		or die(mysql_error());
	mysql_select_db($database,$link)
		or die(mysql_error());

function query($query) {
	$result = mysql_query($query) 
		or die(mysql_error());
	return $result;
}
?>