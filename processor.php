<?php
  require_once('db.php'); require_once('functions.php');
  
  
  function getFile($rand) {
	  $comma = chr(127);
	  $header = NULL; // need this for the loop
	  $lines = file($rand, FILE_IGNORE_NEW_LINES); // that damn flag was pretty useful actually
	  foreach ($lines as $line_num => $line) {
		  // $array[$line_num] = explode($comma,preg_replace(array('/"/',"/'/"), array('\"',"\'"),$line)); // using our ASCII character to explode the strings to array elements
		  $array[$line_num] = explode($comma,$line);
		  if ($line_num == 0) { 
			  $header = $array[$line_num]; 
		  } // load the header values into a discrete array
		  if($line_num > 0) { 
		  $array[$line_num] = array_combine($header,$array[$line_num]); 
		  } // more literal keys to work with later
	  }
	  array_shift($array); 
	  unset($header); // pop off the headers
	  if(!empty($array)) { 
		  return $array; 
	  } else {
		  return NULL;
	  }
	  
  }
  
  function cleanArray($array) {
	  $i = 0;
	  
	  for ($array[$i]; $i < count($array); $i++) {
	  	$valimp1 = implode(chr(10),preg_replace('/[\x00-\x1F\x80-\xFF]/','',array_values($array[$i]))); //stripping out pesky carryover ASCII code from JS and introducing our own
		$keyimp1 = implode(chr(10),preg_replace('/[\x00-\x1F\x80-\xFF]/','',array_keys($array[$i])));
		$val[$i] = explode(chr(10),$valimp1); //back to array
		$key[$i] = explode(chr(10),$keyimp1);
		$val[$i][0] = "'".mysql_real_escape_string($val[$i][0])."'"; //escape potentially bothersome characters for the query
		$val[$i][28] = "'".mysql_real_escape_string($val[$i][28])."'";
		$val[$i][29] = "'".mysql_real_escape_string($val[$i][29])."'";
		$array[$i] = array_combine($key[$i],$val[$i]); //regexing the way we did broke the associative aray, throwing it back together
		
	  }
	  $names = array();
	  $loc = array();
	  $team = array();
	  $i = 0;
	  for ($array[$i]; $i < count($array); $i++) {
		  (int)$dup = array_search($array[$i]['name'],$names);
		  if ($dup != FALSE) { 
		  	if ($array[$i]['team'] === $team[$i]) {
		  $array[$dup]['played'] += $array[$i]['played'];
		  $array[$dup]['score'] += $array[$i]['score'];
		  $array[$dup]['tags'] += $array[$i]['tags'];
		  $array[$dup]['pops'] += $array[$i]['pops'];
		  $array[$dup]['grabs'] += $array[$i]['grabs'];
		  $array[$dup]['drops'] += $array[$i]['drops'];
		  $array[$dup]['hold'] += $array[$i]['hold'];
		  $array[$dup]['captures'] += $array[$i]['captures'];
		  $array[$dup]['prevent'] += $array[$i]['prevent'];
		  $array[$dup]['returns'] += $array[$i]['returns'];
		  $array[$dup]['support'] += $array[$i]['support'];
		  $array[$dup]['bombtime'] += $array[$i]['bombtime'];
		  $array[$dup]['tagprotime'] += $array[$i]['tagprotime'];
		  $array[$dup]['griptime'] += $array[$i]['griptime'];
		  $array[$dup]['speedtime'] += $array[$i]['speedtime'];
		  $array[$dup]['tagpros'] += $array[$i]['tagpros'];
		  $array[$dup]['grips'] += $array[$i]['grips'];
		  $array[$dup]['bombs'] += $array[$i]['bombs'];
		  $array[$dup]['powerups'] += $array[$i]['powerups'];
		  unset($array[$i]);
			}
		  }
		  else {
		  $names[] = $array[$i]['name'];
		  $loc[] = $i;
		  $team[] = $array[$i]['team']; }
	  }
    $array = array_values($array);
	return $array;
  }
  
  function checkDupe($array) { 
  $i = 0;
  $sumscore = 0; $highscore = 0; $ingame = array();
  $mintime = 0; $maxtime = 0;
  $host = $array[0]['host'];
	for($array[$i];$i < count($array); $i++) {
		
			if($array[$i]['arrival'] > $maxtime) { $maxtime = $array[$i]['arrival']; }
			if($mintime == 0 || $array[$i]['departure'] < $mintime) { $mintime = $array[$i]['departure']; }
						
	}
	if (($maxtime - $mintime) < 20000) { return NULL; }
	
	else {
		if (strlen($host) < 1) { return NULL; } else {
	$then = date("'Y-m-d H:i:s'",strtotime("-20 seconds"));
	if(strpos($host,"maptest") != FALSE) { return NULL; }
	$lock = query("LOCK TABLES games WRITE");
	$q_checkforgames = query("SELECT MAX(gameno) FROM games WHERE host=".$host." and timestamp >= ".$then." LIMIT 1");
	$unlock = query ("UNLOCK TABLES");
		if(mysql_result($q_checkforgames,0) == NULL) {
			return $array; // we're done here
		} else { return NULL; } // See tracker ID 3.
		} }
		
  }
  
  function uploadGame($array) {
	  $q_mostrecentgame = query("SELECT MAX(gameno) FROM games LIMIT 1");
	  $mostrecentgame = mysql_result($q_mostrecentgame,0);
	  $mostrecentgame++;
  	  $i = 0;
	  $qstring2 = "";
	  for ($array[$i]; $i < count($array); $i++) {
			  $key1 = "id,gameno,timestamp,";
			  $value1 = "NULL,".$mostrecentgame.",NULL,";
			  $key2 = implode(",",array_keys($array[$i])); //stripping our chr(10) in favor of a comma
			  $value2 = implode(",",array_values($array[$i]));
			  $keys = $key1.$key2; // concatenate our static beginning columns
			  $values = $value1.$value2;
			 $qstring1 = "INSERT INTO games(".$keys.") VALUES ";
			 $qstring2 .="(".$values.")";
			 if ($i < (count($array)-1)) { $qstring2 .= ","; }
			 }
			 $qstring = $qstring1.$qstring2;
	  $upload = query($qstring);
	  return $mostrecentgame;
  }
  
  function updateStats($lastgame) { 
  
  	$grab = query("SELECT id,played,hold,prevent,team,win FROM games WHERE gameno = ".$lastgame);
	while ($row = mysql_fetch_assoc($grab)) { 
	$roam = $row['played'] - $row['prevent'] - $row['hold'];
	if ($row['team'] == $row['win']) { $iwon = 1; } else if ($row['win'] == 2) { $iwon = 2; } else { $iwon = 0; }
	$update = query("UPDATE games SET roam=".$roam.",iwon=".$iwon." WHERE id = ".$row['id']);
	}
  return $lastgame;
  }
  
/*  function updateElo($lastgame) {
	  $getdetails = query("SELECT name,team,iwon,auth FROM games WHERE gameno=".$lastgame." ORDER BY iwon DESC");
	  $winners = array();
	  $losers = array();
	  $tiedplayers = array();
	  $i = 0;
	  while($row = mysql_fetch_assoc($getdetails)) {
		  if($row['iwon'] == 1) {
			  $winners[$i]['name'] = mysql_real_escape_string($row['name']); $winners[$i]['auth'] = $row['auth'];
		  } else if ($row['iwon'] == 0) {
			  $losers[$i]['name'] = mysql_real_escape_string($row['name']); $losers[$i]['auth'] = $row['auth'];
		  } else { $tiedplayers[$i]['name'] = mysql_real_escape_string($row['name']); $tiedplayers[$i]['team'] = $row['team'];  $tiedplayers[$i]['auth'] = $row['auth'];
		  }
		  $i++;
	  }
	  $winners = array_values($winners); 			// learned you can't do something like $winners[]['name'] = 'blah'; $winners[]['auth'] = 1;
	  $losers = array_values($losers); 				// You have to give them proper keys. Using array_values will reindex the arrays
	  $tiedplayers = array_values($tiedplayers);	// so we have all the data and logically numbered.
	  
	  if (empty($tiedplayers)) { //normal win/loss calc
		$loserelo = 0;
		  for($i = 0;$i < count($losers);$i++) { 
		   	$getlastloserelo = query("SELECT elo FROM games WHERE name='".$losers[$i]['name']."' AND auth=".$losers[$i]['auth']." AND elo > 0 ORDER BY gameno DESC LIMIT 1");
			if(mysql_result($getlastloserelo,0) == 0) { $loserelo += 1000; $losers[$i]['elo'] = 1000; }
			else { $loserelo += mysql_result($getlastloserelo,0); $losers[$i]['elo'] = mysql_result($getlastloserelo,0); }
	  	  }
		$winnerelo = 0;
		  for($i = 0;$i < count($winners);$i++) { 
		   	$getlastwinnerelo = query("SELECT elo FROM games WHERE name='".$winners[$i]['name']."' AND auth=".$winners[$i]['auth']." AND elo > 0 ORDER BY gameno DESC LIMIT 1");
			if(mysql_result($getlastwinnerelo,0) == 0) { $winnerelo += 1000; $winners[$i]['elo'] = 1000; }
			else { $winnerelo += mysql_result($getlastwinnerelo,0); $winners[$i]['elo'] = mysql_result($getlastwinnerelo,0); }
		  }
		$loserelo = round($loserelo / count($losers)); $winnerelo = round($winnerelo / count($winners));
		
		for($i = 0;$i < count($losers);$i++) {
			$getkfactor = query("SELECT COUNT(*) FROM games WHERE name='".$losers[$i]['name']."'");
			$gp = mysql_result($getkfactor,0);
			if (($losers[$i]['elo'] > 2200) && $gp > 100) { $kfactor = 10; } else if ($losers[$i]['elo'] > 2000) { $kfactor=15; } else if ($gp > 30) { $kfactor = 23; } else { $kfactor = 30; }
			$win = 1; // backwards but -1 is considered a win and 1 is a loss.
			$elo = $losers[$i]['elo'];
			$oElo = $winnerelo;
			$getelo = new elo;
			$newelo = $getelo->calculate($elo,$oElo,$win,$kfactor);
			if (($gp < 2) && $newelo == 100) { $newelo = 1000; }
			$addnewrow = query("UPDATE games SET elo=".$newelo." WHERE gameno=".$lastgame." AND name='".$losers[$i]['name']."'");
		}
		for($i = 0;$i < count($winners);$i++) {
			$getkfactor = query("SELECT COUNT(*) FROM games WHERE name='".$winners[$i]['name']."'");
			$gp = mysql_result($getkfactor,0);
			if (($winners[$i]['elo'] > 2200) && $gp > 100) { $kfactor = 10; } else if ($winners[$i]['elo'] > 2000) { $kfactor=15; } else if ($gp > 30) { $kfactor = 23; } else { $kfactor = 30; }
			$win = -1; // backwards but -1 is considered a win and 1 is a loss.
			$elo = $winners[$i]['elo'];
			$oElo = $loserelo;
			$getelo = new elo;
			$newelo = $getelo->calculate($elo,$oElo,$win,$kfactor);
			$addnewrow = query("UPDATE games SET elo=".$newelo." WHERE gameno=".$lastgame." AND name='".$winners[$i]['name']."'"); 
		}
		  return $lastgame;
	  } else { // calc for tied players
		  $redelo = 0; // team 1
		  $blueelo = 0; // team 0
		  $redplayers = 0; $blueplayers = 0;
		  for($i = 0; $i < count($tiedplayers); $i++) {
				$getallelos = query("SELECT elo FROM games WHERE name='".$tiedplayers[$i]['name']."' AND auth=".$tiedplayers[$i]['auth']." AND elo > 0 ORDER BY gameno DESC LIMIT 1");	
					if(mysql_result($getallelos,0) == 0) { 
						if ($tiedplayers[$i]['team'] == 0) { 
							$tiedplayers[$i]['elo'] = 1000;
							$blueelo += 1000; 
							$blueplayers++;
						} else { 
							$redelo += 1000;
							$tiedplayers[$i]['elo'] = 1000;
							$redplayers++;
						}
					} else { 
						if ($tiedplayers[$i]['team'] == 0) { 
							$blueelo += mysql_result($getallelos,0); 
							$tiedplayers[$i]['elo'] = mysql_result($getallelos,0); 
							$blueplayers++;
						} else { 
							$redelo += mysql_result($getallelos,0); 
							$tiedplayers[$i]['elo'] = mysql_result($getallelos,0);
							$redplayers++;
						}
					}
		  }
		  $blueelo = round($blueelo / $blueplayers); 
		  $redelo = round($redelo / $redplayers);
		  
		  for($i = 0;$i < count($tiedplayers);$i++) {
			$getkfactor = query("SELECT COUNT(*) FROM games WHERE name='".$tiedplayers[$i]['name']."'");
			$gp = mysql_result($getkfactor,0);
			if (($tiedplayers[$i]['elo'] > 2200) && $gp > 100) { $kfactor = 10; } else if ($tiedplayers[$i]['elo'] > 2000) { $kfactor=15; } else if ($gp > 30) { $kfactor = 23; } else { $kfactor = 30; }
			$win = 0; // ties are 0
			$elo = $tiedplayers[$i]['elo'];
			if($tiedplayers[$i]['team'] == 0) { $oElo = $redelo; } else { $oElo = $blueelo; }
			$getelo = new elo;
			$newelo = $getelo->calculate($elo,$oElo,$win,$kfactor);
			if(strlen($tiedplayers[$i]['name']) > 0) { $addnewrow = query("UPDATE games SET elo=".$newelo." WHERE gameno=".$lastgame." AND name='".$tiedplayers[$i]['name']."'"); }
		}
		 return $lastgame; 
	  }
	  
  } */
  
function cleanHouse($lastgame) {
	//$removedupes = query("DELETE g1 FROM games g1, games g2 WHERE g1.name=g2.name AND g1.gameno=g2.gameno AND g1.score=g2.score AND g1.id > g2.id AND g1.gameno=".$lastgame);
	//$fix100elo = query("UPDATE games SET elo=1000 WHERE elo=100 AND gameno=".$lastgame);
	if (multipleOf(25,$lastgame)) {
	$getresults = query("SELECT (SELECT COUNT(DISTINCT gameno) AS ties FROM games WHERE win = 2) AS ties, (SELECT COUNT(DISTINCT gameno) AS ties FROM games WHERE win = 1) AS redwins, (SELECT COUNT(DISTINCT gameno) AS ties FROM games WHERE win = 0) AS bluewins, COUNT(DISTINCT gameno) AS gamesplayed FROM games");
	$results = mysql_fetch_assoc($getresults);
	$gp = $results['gamesplayed'];
	$red = $results['redwins'];
	$blue = $results['bluewins'];
	$tie = $results['ties'];
	$updategp = query("UPDATE preaggs SET idxtotalgames=".$gp.",idxredwins=".$red.",idxbluewins=".$blue.",idxties=".$tie." WHERE 1");
	}
	if(multipleOf(26,$lastgame)) {
	$qrows = query("SELECT COUNT(id) as rows FROM games WHERE 1");
	$rows = mysql_result($qrows,0);
	$qcols = query("SELECT count(*) as columns FROM information_schema.columns WHERE table_name = 'games'");
	$cols = mysql_result($qcols,0);
	$points = $rows*$cols;
	$updatepoints = query("UPDATE preaggs SET rows=".$rows.",datapoints=".$points." WHERE 1");
	}
	if(multipleOf(1000,$lastgame)) {
		include('updateleaderboard.php');
	}
	if(multipleOf(1500,$lastgame)) {
		include('updatemetrics.php');
	}
	
}
	  
?>