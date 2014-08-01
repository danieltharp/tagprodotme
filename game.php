<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Game ID ".$_GET['id'];
require_once('header.php');
?>
	<p align="center">
<?php    $checkcollision = query("SELECT host FROM games WHERE gameno=".mysql_real_escape_string($_GET['id'])." GROUP BY host");
			if (mysql_num_rows($checkcollision) > 1) {
				$maptoupdate = mysql_result($checkcollision,0);
				$q_mostrecentgame = query("SELECT MAX(gameno) FROM games LIMIT 1");
	  $mostrecentgame = mysql_result($q_mostrecentgame,0);
	  $mostrecentgame++;
	  $update = query("UPDATE games SET gameno=".$mostrecentgame." WHERE gameno=".mysql_real_escape_string($_GET['id'])." AND host='".$maptoupdate."'");
	  echo "<script>location.reload();</script>";
			}
			$nan = 0; $ebug = 0;
$gettime = query("SELECT teamcaps, oppcaps, timestamp, win, map, host FROM games WHERE gameno = ".mysql_real_escape_string($_GET['id'])." LIMIT 1");
		if(mysql_num_rows($gettime) == 0) { killpage("That game does not exist in the database. It may have been deleted as a duplicate, a hacked game, or you're getting clever with the GET string."); }
		$row = mysql_fetch_assoc($gettime);
		echo "Game ".$_GET['id'].", recorded ".$row['timestamp']." EST on ".$row['host'].".<br /><br />"; 
		if ($row['win'] == 2) { $winner = 'Tied '; } elseif ($row['win'] == 1) { $winner = 'Red wins '; } else { $winner = 'Blue wins '; }
					$score = $row['teamcaps'] == $row['oppcaps'] ? $row['teamcaps']."-".$row['oppcaps'] : $row['teamcaps'] > $row['oppcaps'] ? $row['teamcaps']."-".$row['oppcaps'] : $row['oppcaps']."-".$row['teamcaps'];
					echo($winner.$score)." on ".substr($row['map'],5)."<br /><br />";
		?>


        <a href="game.php?id=<?php echo $_GET['id']-1; ?>">Prev</a> | <a href="game.php?id=<?php echo $_GET['id']+1; ?>">Next</a>

         <table align="center" border="0" width="100%">
		 <thead align="center">
                	<th>Player</th>
            		<th>Score</th>
                    <th>Tags</th>
                	<th>Pops</th>
                	<th>Grabs</th>
                    <th>Drops</th>
                    <th>Caps</th>
                	<th>Returns</th>
                    <th>Hold</th>
                	<th>Prevent</th>
                	<th>Supports</th>
                    <th>Tagpros (time)</th>
                    <th>Juke Juices (time)</th>
                	<th>Bombs (time)</th>
                    <th>TPUs</th>
                    <th>Played</th>
					<th>+/-</th>
                 	<th>K:D</th>
                    <th>G:R</th>
                    <th>OEff</th>
                    <th>H:P</th>
                    <th>KPM</th>
                    <th>RPM</th>
                    <th>PUP</th>
                    <th>D/R/A%</th>
                    <th>Elo</th>
                 </thead>

<?php
		$getdetails = query("SELECT * FROM games WHERE gameno = ".mysql_real_escape_string($_GET['id'])." ORDER BY score DESC");
		$i = 0;
		$player = array();
			while($row = mysql_fetch_assoc($getdetails)) { ?>
				<tr align="center">
                	<td bgcolor=<?php echo ($row['team'] == 1 ? "#FF7777" : "#7777FF"); ?>><a href="player.php?id=<?php echo urlencode($row['name']); ?>"><?php echo stripslashes($row['name'])." - ".$row['degree']."&deg;"; if($row['auth'] == 1) { echo "<img src='auth.png' alt='Reserved Name' style='vertical-align:middle' />"; } ?></a></td>
            		<?php echo "<td>".$row['score']."</td>";
					echo "<td>".$row['tags']."</td>";
					echo "<td>".$row['pops']."</td>";
					echo "<td>".$row['grabs']."</td>";
					echo "<td>".$row['drops']."</td>";
					echo "<td>".$row['captures']."</td>";
					echo "<td>".$row['returns']."</td>";
					echo "<td>".gmdate("i:s", $row['hold'])."</td>";
					echo "<td>".gmdate("i:s", $row['prevent'])."</td>";
					echo "<td>".$row['support']."</td>";
					echo "<td>".$row['tagpros']."(".gmdate("i:s", round($row['tagprotime']/1000)).")</td>";
					echo "<td>".$row['grips']."(".gmdate("i:s", round($row['griptime']/1000)).")</td>";
					echo "<td>".$row['bombs']."(".gmdate("i:s", round($row['bombtime']/1000)).")</td>";
					echo "<td>".$row['powerups']."</td>"; 
					echo "<td>".gmdate("i:s", ($row['played']))."</td>";
					echo "<td>".$row['plusminus']."</td>";
                    echo "<td>".($row['pops'] == 0 ? "Inf." : round($row['tags']/$row['pops'],2))."</td>";
					echo "<td>".($row['returns'] == 0 ? "Inf." : round($row['grabs']/$row['returns'],2))."</td>";
					if($row['grabs'] == 0) { echo "<td>N/A</td>"; }
						else { echo "<td>".round((($row['captures']/$row['grabs'])*100),1)."%</td>";}
					echo "<td>".($row['prevent'] == 0 ? "Inf." : round($row['hold']/$row['prevent'],2))."</td>";
					echo "<td>".@round($row['tags']/($row['played']/60),2)."</td>";
					echo "<td>".@round($row['returns']/($row['played']/60),2)."</td>";
					$puptime = round(($row['bombtime'] + $row['tagprotime'] + $row['griptime']) / 10);
					echo "<td>".@round($puptime/$row['played'])."%</td>";
					
					if((@round(($row['prevent']/$row['played'])*100) < 0) || (@round(($row['prevent']/$row['played'])*100)) > 100 || (@round((($row['played']-$row['hold']-$row['prevent'])/$row['played'])*100) < 0) || (@round((($row['played']-$row['hold']-$row['prevent'])/$row['played'])*100) > 100) || (@round(($row['hold']/$row['played'])*100) < 0) || (@round(($row['hold']/$row['played'])*100) > 100) || $row['played'] == 0) { echo "<td>Error<sup>1</sup>"; $nan = 1; } else {
					echo "<td>".round(($row['prevent']/$row['played'])*100)."/".round((($row['played']-$row['hold']-$row['prevent'])/$row['played'])*100)."/".round(($row['hold']/$row['played'])*100); } echo "</td>";
					if ($row['elo'] > 0) { echo "<td>".$row['elo']."</td>"; }
					else { echo "<td>Error<sup>2</sup></td>"; $ebug = 1; }
					?>
                 </tr>
                 
     		<?php $player[$i] = $row; $i++; } ?> 
			<tr>
                 	<td colspan="26" align="right"><a href="report.php?game=<?php echo $_GET['id']; ?>" target="_blank">Report this game.</a></td></tr>
			<?php echo "</table>"; 
			
						if($nan == 1) { echo "<sup>1</sup> Occurs when recording player joins a game near the end of the game, and DRA numbers are below 0% or above 100% in any category. Known bug. Time Played, H:P, KPM, RPM and PUP for a player with this error should be ignored."; }
                        if($ebug == 1) { echo "<sup>2</sup> Occurs rarely due to Elo glitches. Known bug. Game not counted and Elo from previous match preserved."; } ?>
						
			  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("scorePct",
    {
      title:{
        text: "Score Percentage"
      },
       data: [ 
      { startAngle:  270,
         type: "pie",
       showInLegend: false,
       dataPoints: [
	   <?php for ($i=0; $i < count($player); $i++) { ?>
       {  y: <?php echo $player[$i]['score'].", indexLabel: '".addslashes($player[$i]['name'])."' },"; ?>
	   <?php } ?>
       ]
     }
     ]
   });

    chart.render();
  }
  </script>			
			<div id="scorePct" style="height: 300px; width: 50%; float:left">&nbsp;</div>
            <?php if ($ebug == 0) { ?><div style="width:50%; float:left" align="center"><strong>Elo Breakdown</strong><br /><br />
            <?php $redelo = 0; $blueelo = 0; $blueplayers = 0; $redplayers = 0;
			for ($i=0;$i < count($player);$i++) { 
			if($player[$i]['team'] == 1) {$redelo += $player[$i]['elo']; $redplayers++; } else { $blueelo += $player[$i]['elo']; $blueplayers++; }
			} 
			echo "Advantage "; if ($blueelo > $redelo) { echo "Blue "; $blueelo = @round(($blueelo/$blueplayers)); $redelo = @round(($redelo/$redplayers)); } else if ($redelo > $blueelo) { echo "Red "; $blueelo = @round(($blueelo/$blueplayers)); $redelo = @round(($redelo/$redplayers)); } else { echo "Even. (Win Probability: 50%)."; }
			
			if($blueelo > $redelo) { echo $blueelo."-".$redelo; } else { echo $redelo."-".$blueelo; }
			$diff = abs($blueelo-$redelo);
			echo "<br />";
			echo "Win Probability: "; $prob =  1/(1+pow(10, (-$diff/400))); $prob = round(($prob*100),2); echo $prob."%.";
			}?>
            
            </div>
            
            <div style="clear:both">&nbsp;</div>
			<?php require_once('footer.php'); ?>            