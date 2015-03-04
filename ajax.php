<?php
	header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
	if(isset($_POST))
	$rand = rand(1,10);
	$plz = file_put_contents($rand,$_POST);

	require_once('processor.php');
	
	$process = getFile($rand);
	if ($process != NULL) { $process = cleanArray($process); }
	if ($process != NULL) { $process = checkDupe($process); }
	if ($process != NULL) { $process = uploadGame($process); }
	if ($process != NULL) { $process = updateStats($process); }
	//if ($process != NULL) { $process = updateElo($process); }
	if ($process != NULL) { $process = cleanHouse($process); }
?>