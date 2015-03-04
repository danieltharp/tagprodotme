<?php
  require_once('db.php'); require_once('functions.php');
  $top25kd = array();
  $gettop25kd = query("SELECT name, SUM(tags) as k ,SUM(pops) as d FROM games WHERE auth=1 GROUP BY name HAVING (k >= 250) ORDER BY SUM(tags)/SUM(pops) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25kd)) { 
			$top25kd[$i]['rank'] = $i;
			$top25kd[$i]['name'] = mysql_real_escape_string($row['name']);
				$kdr = round(($row['k']/$row['d']),2);
			$top25kd[$i]['data'] = $kdr;
			$i++;
			}
	for	($i = 1; $i <= count($top25kd);$i++) { 
		$updatekd = query("UPDATE leaderboards SET name='".$top25kd[$i]['name']."',data='".$top25kd[$i]['data']."' WHERE board='top25kd' AND rank='".$i."'");
	}
	
	
	$top25OEff = array();
	$gettop25OEff = query("SELECT name, SUM(captures) as c ,SUM(grabs) as g FROM games WHERE auth=1 GROUP BY name HAVING (c >= 100) ORDER BY SUM(captures)/SUM(grabs) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25OEff)) { 
			$top25OEff[$i]['rank'] = $i;
			$top25OEff[$i]['name'] = mysql_real_escape_string($row['name']);
				$OEff = round(($row['c']/$row['g']),4)*100;
			$top25OEff[$i]['data'] = $OEff;
			$i++;
			}
	for	($i = 1; $i <= count($top25kd);$i++) { 
		$updatekd = query("UPDATE leaderboards SET name='".$top25OEff[$i]['name']."',data='".$top25OEff[$i]['data']."' WHERE board='top25OEff' AND rank='".$i."'");
	}
	
	$top25PMPG = array();
	$gettop25PMPG = query("SELECT name, COUNT(gameno) as c ,SUM(plusminus) as pm FROM games WHERE auth=1 GROUP BY name HAVING (c >= 100) ORDER BY SUM(plusminus)/COUNT(gameno) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25PMPG)) { 
			$top25PMPG[$i]['rank'] = $i;
			$top25PMPG[$i]['name'] = mysql_real_escape_string($row['name']);
				$PMPG = round(($row['pm']/$row['c']),3);
			$top25PMPG[$i]['data'] = $PMPG;
			$i++;
			}
	for	($i = 1; $i <= count($top25kd);$i++) { 
		$updatekd = query("UPDATE leaderboards SET name='".$top25PMPG[$i]['name']."',data='".$top25PMPG[$i]['data']."' WHERE board='top25PMPG' AND rank='".$i."'");
	}
	
		$top25SPM = array();
	$gettop25SPM = query("SELECT name, sum(played) as p, SUM(score) as s FROM games WHERE auth=1 GROUP BY name HAVING (p >= 18000) ORDER BY SUM(score)/sum(played) DESC LIMIT 25");  
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25SPM)) { 
			$top25SPM[$i]['rank'] = $i;
			$top25SPM[$i]['name'] = mysql_real_escape_string($row['name']);
				$SPM = round(($row['s']/($row['p']/60)),2);
			$top25SPM[$i]['data'] = $SPM;
			$i++;
			}
	for	($i = 1; $i <= count($top25kd);$i++) { 
		$updatekd = query("UPDATE leaderboards SET name='".$top25SPM[$i]['name']."',data='".$top25SPM[$i]['data']."' WHERE board='top25SPM' AND rank='".$i."'");
	}
	
	$top25RPM = array();
	$gettop25RPM = query("SELECT name, sum(played) as p, SUM(returns) as r FROM games WHERE auth=1 GROUP BY name HAVING (p >= 18000) ORDER BY SUM(returns)/sum(played) DESC LIMIT 25");  
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25RPM)) { 
			$top25RPM[$i]['rank'] = $i;
			$top25RPM[$i]['name'] = mysql_real_escape_string($row['name']);
				$RPM = round(($row['r']/($row['p']/60)),2);
			$top25RPM[$i]['data'] = $RPM;
			$i++;
			}
	for	($i = 1; $i <= count($top25kd);$i++) { 
		$updatekd = query("UPDATE leaderboards SET name='".$top25RPM[$i]['name']."',data='".$top25RPM[$i]['data']."' WHERE board='top25RPM' AND rank='".$i."'");
	}
	
	$top25CPM = array();
	$gettop25CPM = query("SELECT name, sum(played) as p, SUM(captures) as c FROM games WHERE auth=1 GROUP BY name HAVING (p >= 18000) ORDER BY SUM(captures)/sum(played) DESC LIMIT 25");  
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25CPM)) { 
			$top25CPM[$i]['rank'] = $i;
			$top25CPM[$i]['name'] = mysql_real_escape_string($row['name']);
				$CPM = round(($row['c']/($row['p']/60)),2);
			$top25CPM[$i]['data'] = $CPM;
			$i++;
			}
	for	($i = 1; $i <= count($top25kd);$i++) { 
		$updatekd = query("UPDATE leaderboards SET name='".$top25CPM[$i]['name']."',data='".$top25CPM[$i]['data']."' WHERE board='top25CPM' AND rank='".$i."'");
	}
?>