<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Player Stats for ".stripslashes($_GET['id']);
require_once('header.php');
if(@$_GET['auth'] == '0') { $auth = 0; } else { $auth = 1; } 
$getcareerstats=query("SELECT SUM( plusminus ) AS dpm, COUNT( gameno ) AS gp, SUM( iwon ) AS iwon, SUM(grabs) as grabs, SUM( played ) AS played, SUM(tags) as kills, SUM(pops) as deaths, SUM(captures) as captures, SUM(returns) as returns, SUM(powerups) as powerups, SUM(tagpros) as tagpros, SUM( prevent ) AS d, SUM( roam ) AS r, SUM( hold ) AS a, SUM(bombtime) as bombtime, SUM(tagprotime) as tagprotime, SUM(griptime) as griptime, SUM(score) as score, MAX(degree) as degree FROM games WHERE name =  '".mysql_real_escape_string($_GET['id'])."' AND auth=".$auth."");
while($tempcstats = mysql_fetch_assoc($getcareerstats)) { $cstats[] = $tempcstats; } ?>
<?php
$getdegreestats=query("SELECT SUM( plusminus ) AS dpm, COUNT( gameno ) AS gp, SUM( iwon ) AS iwon, SUM(grabs) as grabs, SUM( played ) AS played, SUM(tags) as kills, SUM(pops) as deaths, SUM(captures) as captures, SUM(returns) as returns, SUM(powerups) as powerups, SUM(tagpros) as tagpros, SUM( prevent ) AS d, SUM( roam ) AS r, SUM( hold ) AS a, SUM(bombtime) as bombtime, SUM(tagprotime) as tagprotime, SUM(griptime) as griptime, SUM(score) as score, MAX(degree) as degree FROM games WHERE name = '".mysql_real_escape_string($_GET['id'])."' AND auth=".$auth." GROUP BY degree");
$dstats = array();
while ($tempstats = mysql_fetch_assoc($getdegreestats)) { $dstats[] = $tempstats; } 
$nan = 0; $ebug = 0;
$max = count($dstats); 
$getcties = query("SELECT COUNT(iwon) AS itied FROM games WHERE iwon=2 AND name='".mysql_real_escape_string($_GET['id'])."' AND auth=".$auth."");
$cties = mysql_result($getcties,0);
$cwins = $cstats[0]['iwon'];
$cwins = $cwins-($cties*2);
if (mysql_num_rows($getcareerstats) == 0 || mysql_num_rows($getdegreestats) == 0) { echo("<div align=center>That player doesn't exist in the database.<br /><br />
If you think they do but aren't authed, <a href='player.php?id=".urlencode($_GET['id'])."&auth=0'>try this.</a></div>"); killPage(" "); }
?>
<div align="center" style="width:100%; clear:both; font-size:large;">Player stats for <?php echo stripslashes($_GET['id'])." (".$cwins."-".($cstats[0]['gp']-$cwins-$cties); if($cties > 0) { echo "-".$cties; }
echo " ["; if ($cwins == $cstats[0]['gp']) { echo "1.000]"; } else if ($cwins == 0) { echo ".000]"; }else { echo ".".round((($cwins/$cstats[0]['gp'])*1000),0)."]"; }
echo ", ".$cstats[0]['degree']."&deg;)"; ?></div>
<div align="center" style="padding-bottom:30px; width:40%; float:left">
	<strong>Career Stats - Totals</strong><br />
    <?php echo $cstats[0]['kills']." Kills and ".$cstats[0]['deaths']." Deaths for a K:D of ".($cstats[0]['deaths'] == 0 ? "Inf" : round($cstats[0]['kills']/$cstats[0]['deaths'],2)).".<br />
	+/- of "; 
		if($cstats[0]['dpm'] > 0) { $pre = "+"; } else { $pre = ""; } 
	echo $pre.$cstats[0]['dpm']." over ".$cstats[0]['gp']." games for a PMPG of ".$pre.round($cstats[0]['dpm']/$cstats[0]['gp'],3);
	echo "<br />";
	if ($cstats[0]['grabs'] == 0) { echo "Not enough information for OEff%. <br />"; }
	else { echo $cstats[0]['captures']." captures on ".$cstats[0]['grabs']." attempts for an OEff% of ".round((($cstats[0]['captures']/$cstats[0]['grabs'])*100),2)."% <br />"; }
	
	if ($cstats[0]['kills']-$cstats[0]['returns'] == 0) { echo "Not enough information for K/TP.<br />"; }
	else { echo ($cstats[0]['kills']-$cstats[0]['returns'])." non-FC kills on &gt;= ".$cstats[0]['tagpros']." Tagpros for a K/TP of &lt;= ".@round((($cstats[0]['kills']-$cstats[0]['returns'])/$cstats[0]['tagpros']),2)." <sup><a href='#footnotes'>1</a></sup><br />"; }
	if((round(($cstats[0]['d']/$cstats[0]['played'])*100) < 0) || (round(($cstats[0]['d']/$cstats[0]['played'])*100)) > 100 || (round((($cstats[0]['played']-$cstats[0]['a']-$cstats[0]['d'])/$cstats[0]['played'])*100) < 0) || (round((($cstats[0]['played']-$cstats[0]['a']-$cstats[0]['d'])/$cstats[0]['played'])*100) > 100) || (round(($cstats[0]['a']/$cstats[0]['played'])*100) < 0) || (round(($cstats[0]['a']/$cstats[0]['played'])*100) > 100)) { echo "Not enough info for D/R/A."; }
	else {echo gmdate("H:i:s", ($cstats[0]['played']))." elapsed time in-game, with a D/R/A of ".round(($cstats[0]['d']/$cstats[0]['played'])*100)."/".round((($cstats[0]['played']-$cstats[0]['a']-$cstats[0]['d'])/$cstats[0]['played'])*100)."/".round(($cstats[0]['a']/$cstats[0]['played'])*100); }
	echo "<br />";
	$puptime = (($cstats[0]['bombtime'] + $cstats[0]['tagprotime'] + $cstats[0]['griptime'])/1000);
	echo gmdate("H:i:s",$puptime)." spent in powerup for a PUP of ".round(($puptime/$cstats[0]['played'])*100,2)."%";
	echo "<br />";
	$deadtime = $cstats[0]['deaths']*3; $inactive = round(($deadtime/$cstats[0]['played'])*100,2);
	echo "Inactive for ".$inactive."% of total played time.";
	 ?>
<br /><br />
<strong>Career Stats - Per Game (<?php echo $cstats[0]['gp']; ?> Games Played)</strong><br />
<?php
	$gp = $cstats[0]['gp'];
		echo round(($cstats[0]['score']/$gp),2)." Avg. Score<br />";
		echo round(($cstats[0]['kills']/$gp),2)." Kills/Game and ".round(($cstats[0]['deaths']/$gp),2)." Deaths/Game.<br />";
		echo round(($cstats[0]['captures']/$gp),3)." Captures/Game on ".round(($cstats[0]['grabs']/$gp),3)." Attempts/Game and ".round(($cstats[0]['returns']/$gp),3)." Returns/Game.<br />";
		echo "&gt;= ".round(($cstats[0]['powerups']/$gp),2)." Powerups/Game <sup><a href='#footnotes'>1</a></sup>";
?>
<br /><br />
<strong>Career Stats - Per Minute (<?php $mins = round($cstats[0]['played']/60,1); echo $mins." Minutes Played)"; ?></strong><br />
<?php
	echo round(($cstats[0]['score']/$mins),2)." Score/Min<br />";
	echo round(($cstats[0]['kills']/$mins),3)." Kills/Min & ".round(($cstats[0]['deaths']/$mins),3)." Deaths/Min.<br />";
	echo round(($cstats[0]['captures']/$mins),3)." Captures/Min on ".round(($cstats[0]['grabs']/$mins),3)." Attempts/Min and ".round(($cstats[0]['returns']/$mins),3)." Returns/Min.<br />";
	echo "&gt;= ".round(($cstats[0]['powerups']/$mins),2)." Powerups/Min <sup><a href='#footnotes'>1</a></sup>";
?>
<br /><br />
<?php $getelo = query("SELECT (SELECT elo from games WHERE name='".mysql_real_escape_string($_GET['id'])."' AND auth=".$auth." ORDER BY id DESC LIMIT 1) elo, COUNT(gameno) as egp, MAX(elo) as max, MIN(elo) as min FROM games WHERE name='".mysql_real_escape_string($_GET['id'])."' AND auth=".$auth." ORDER by gameno DESC LIMIT 1"); 
	$elostats = mysql_fetch_assoc($getelo);
if($elostats['egp'] == 0) { echo "No Elo Rating - No games played since game <a href='game.php?id=4931'>4931</a> when Elo tracking began."; }
else {
	$hasanelo = 1;
	$elo = $elostats['elo']; $egp = $elostats['egp']; $emax = $elostats['max']; $min = $elostats['min'];
	echo "<strong>Elo Rating &mdash; ".$elo."</strong><br />";
	if ($egp < 30) { echo "Provisional Rating (k=30)"; }
	else if ($egp > 30 && $elo < 2000) { echo "Confident Rating - Amateur (k=23)"; }
	else if (($elo >= 2000 && $elo < 2200) || ($elo > 2200 && $egp < 100)) { echo "Confident Rating - Master (k=15)"; }
	else { echo "Highly Confident Rating - Grandmaster (k=10)"; }
	echo "<br />";
	echo "Highest recorded Elo - ".$emax." <br />";
	echo "Lowest recorded Elo - ".$min;
}

?>
</div>
<div align="center" style="font-size:large; padding-bottom:30px; width:60%; float:left">
<strong>Stats by Degree</strong><br />
(Hover on acronyms for explanations.)<br />
<table width="100%" border="0" class="sbd">
	<thead>
    	<th><abbr title="Degree">&deg;</abbr></th>
        <th><abbr title="Games Played">GP</abbr></th>
        <th><abbr title="Win-Loss-Tie Record">W-L-T</abbr></th>
        <th><abbr title="Average Score Per Game">ASPG</abbr></th>
        <th><abbr title="Kill:Death Ratio">K:D</abbr></th>
        <th><abbr title="Plus/Minus">+/-</abbr></th>
        <th><abbr title="Plus/Minus Per Game">PMPG</abbr></th>
        <th><abbr title="Flag Captures">Caps</abbr></th>
        <th><abbr title="Flag Returns">Returns</abbr></th>
        <th><abbr title="Capture:Return Ratio">C:R</abbr></th>
        <th><abbr title="Offensive Efficiency, Captures/Grabs">OEff</abbr></th>
        <th><abbr title="Kills Per Minute">KPM</abbr></th>
        <th><abbr title="Captures Per Minute">CPM</abbr></th>
        <th><abbr title="Returns Per Minute">RPM</abbr></th>
        <th><abbr title="Score Per Minute">SPM</abbr></th>
   </thead>
   		<?php for ($i = 0; $i < $max; $i++) { 
		echo "<tr align=center"; echo ($i%2 == 1 ? " bgcolor=#dddddd" : "" ); echo ">";
		echo "<td>".$dstats[$i]['degree']."&deg;</td>";
		echo "<td>".$dstats[$i]['gp']."</td>";
		
		$getdties = query("SELECT COUNT(iwon) AS itied FROM games WHERE iwon=2 AND name='".mysql_real_escape_string($_GET['id'])."' AND degree = ".$dstats[$i]['degree']." AND auth=".$auth."");
		$dties = mysql_result($getdties,0);
		$dwins = $dstats[$i]['iwon'];
		$dwins = $dwins-($dties*2);
		
		echo "<td>".$dwins."-".($dstats[$i]['gp']-$dwins-$dties); if($dties > 0) { echo "-".$dties; } echo "</td>";
		echo "<td>".round(($dstats[$i]['score']/$dstats[$i]['gp']),2)."</td>";
		if($dstats[$i]['deaths'] == 0) { echo "<td>Inf.</td>"; }
		else { echo "<td>".round(($dstats[$i]['kills']/$dstats[$i]['deaths']),2)."</td>";}
		echo "<td>".$dstats[$i]['dpm']."</td>";
		echo "<td>"; if (($dstats[$i]['dpm']/$dstats[$i]['gp']) > 0) { echo "+"; }
		echo round(($dstats[$i]['dpm']/$dstats[$i]['gp']),2)."</td>";
		echo "<td>".$dstats[$i]['captures']."</td>";
		echo "<td>".$dstats[$i]['returns']."</td>";
		if($dstats[$i]['returns'] == 0) { echo "<td>Inf.</td>"; }
		else { echo "<td>".round(($dstats[$i]['captures']/$dstats[$i]['returns']),3)."</td>";}
		if($dstats[$i]['grabs'] == 0) { echo "<td>N/A</td>"; }
		else { echo "<td>".round((($dstats[$i]['captures']/$dstats[$i]['grabs'])*100),1)."%</td>";}
		$dmins = ($dstats[$i]['played']/60);
		echo "<td>".round(($dstats[$i]['kills']/$dmins),2)."</td>";
		echo "<td>".round(($dstats[$i]['captures']/$dmins),2)."</td>";
		echo "<td>".round(($dstats[$i]['returns']/$dmins),2)."</td>";
		echo "<td>".round(($dstats[$i]['score']/$dmins),2)."</td>";
		echo "</tr>";
		} ?>

</table>
</div>
<div style="clear:both">&nbsp;</div>
<?php
$pmpg_start = microtime(true);
?>

<div style="width:100%;">
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("histPMPG",
    {

      title:{
      text: "Avg. +/- Per Game"
      }, axisX:{title: "Degree"}, axisY:{title: "+/-", minimum:-3, maximum:3, interval:1},
       data: [
      {
        type: "line",
		name: "+/-",

        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo round(($dstats[$i]['dpm']/$dstats[$i]['gp']),2)?>, label: '<?php echo $dstats[$i]['degree']; ?>°'},
		<?php } ?>
        ]
      }
      ]
    });

    chart.render();
	
<?php $pmpg_end = microtime(true);
$pmpg = ($pmpg_end - $pmpg_start)*1000;
$hdra_start = microtime(true);
?>

    var chart2 = new CanvasJS.Chart("histDRA",
    {
      title:{
        text: "D/R/A%"      
      },
	  axisX:{title: "Degree"}, axisY:{title: "D/R/A %"},
	  toolTip:{shared:"true"},
      data: [{        
        type: "stackedColumn100",
        legendText: "Defense",
		name: "Defense",
        showInLegend:"true",
        dataPoints: [
		<?php for ($i = 0; $i < $max; $i++) { ?>
        {y: <?php echo ($dstats[$i]['d'] > 0 && $dstats[$i]['r'] > 0 && $dstats[$i]['a'] > 0) ? $dstats[$i]['d'] : 0; ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      },{type: "stackedColumn100",
         legendText: "Roaming",
		 name: "Roaming",
        showInLegend:"true",
        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo ($dstats[$i]['d'] > 0 && $dstats[$i]['r'] > 0 && $dstats[$i]['a'] > 0) ? $dstats[$i]['r'] : 0; ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      },
             
             {        
        type: "stackedColumn100",
               legendText: "Attack",
			   name: "Attack",
        showInLegend:"true",
        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        {y: <?php echo ($dstats[$i]['d'] > 0 && $dstats[$i]['r'] > 0 && $dstats[$i]['a'] > 0) ? $dstats[$i]['a'] : 0; ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      }
      ]
    });

    chart2.render();
	<?php $hdra_end = microtime(true);
$hdra = ($hdra_end - $hdra_start)*1000;
$hapm_start = microtime(true);

?>
	 var chart3 = new CanvasJS.Chart("histAPM",
    {
      title:{
        text: "Actions Per Minute"      
      },
	  axisX:{title: "Degree"}, axisY:{title: "Actions/Min", minimum:0},
	  toolTip:{shared:"true"},
      data: [{        
        type: "stackedColumn",
        legendText: "Returns",
		name: "Returns",
        showInLegend:"true",
        dataPoints: [
		<?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo round(($dstats[$i]['kills']/($dstats[$i]['played']/60)),2) ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      },{type: "stackedColumn",
         legendText: "Tagpro Kills",
		 name: "Tagpro Kills",
        showInLegend:"true",
        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo round((($dstats[$i]['kills']-$dstats[$i]['returns'])/($dstats[$i]['played']/60)),2) ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      },
             
             {        
        type: "stackedColumn",
               legendText: "Grabs",
			   name: "Grabs",
        showInLegend:"true",
        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo round((($dstats[$i]['grabs']-$dstats[$i]['captures'])/($dstats[$i]['played']/60)),2) ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      },
	  
	  {        
        type: "stackedColumn",
               legendText: "Captures",
			   name: "Captures",
        showInLegend:"true",
        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo round(($dstats[$i]['captures']/($dstats[$i]['played']/60)),2) ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      },
	  {        
        type: "stackedColumn",
               legendText: "Powerups",
			   name: "Powerups",
        showInLegend:"true",
        dataPoints: [
        <?php for ($i = 0; $i < $max; $i++) { ?>
        { y: <?php echo round(($dstats[$i]['powerups']/($dstats[$i]['played']/60)),2) ?>, label: "<?php echo $dstats[$i]['degree']."°"; ?>" },
		<?php } ?>
        ]
      }
      ]
    });

    chart3.render();
<?php $hapm_end = microtime(true);
$hapm = ($hapm_end - $hapm_start)*1000;
$helo_start = microtime(true);
?>
	<?php if($hasanelo == 1) { ?>
	
	    var chart4 = new CanvasJS.Chart("histElo",
    {

      title:{
      text: "Historical Elo (Average Player: 1000, last 50 games)"
      }, axisX:{title: "Games"}, axisY:{title: "Elo", minimum:600, maximum:1500, interval:100},
       data: [
      {
        type: "line",
		name: "Elo",

        dataPoints: [
        <?php 
			$getelohist = query("SELECT elo,gameno FROM games WHERE name='".mysql_real_escape_string($_GET['id'])."' AND auth=".$auth." ORDER BY gameno DESC LIMIT 50");
			$gamecounter = 50;
		while($elohist = mysql_fetch_assoc($getelohist)) { ?>
<?php        if($elohist['elo'] > 0) { ?> { x: <?php echo $gamecounter; ?>, y: <?php echo $elohist['elo']; ?> },
		<?php } 
			else { ?> { x: <?php echo $gamecounter; ?>, y: <?php echo "null"; ?> }, <?php }
		$gamecounter--;} ?>
        ]
      }
      ]
    });

    chart4.render();
	
	<?php } ?>
	
  }
  </script>
  <?php $helo_end = microtime(true);
$helo = ($helo_end - $helo_start)*1000;
?>
  <?php if($hasanelo == 1) { ?>
    <div id="histElo" style="height: 600px; width: 100%; float:left">  </div>
    <div style="clear:both">&nbsp;</div>
  <?php } ?>
  <div id="histAPM" style="height: 600px; width: 100%; float:left">  </div>
    <div style="clear:both">&nbsp;</div>
  <div id="histPMPG" style="height: 400px; width: 50%; float:left">
  </div>
  
  <div id="histDRA" style="height: 400px; width: 50%; float:left">
  </div>
	<div style="clear:both">&nbsp;</div>
    <?php /* New Game Code Follows */ ?>
    <div align="center" style="width:100%; clear:both; font-size:large;">Game Breakdown (last 50)</div>
     <table align="center" border="0">
		 <thead align="center">
                	<th>Game</th>
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

<?php	unset($getdetails); unset($row);

$gb_start = microtime(true);

		$getdetails = query("SELECT * FROM games WHERE name = '". mysql_real_escape_string($_GET['id'])."' AND auth=".$auth." GROUP by gameno ORDER BY gameno DESC LIMIT 50");
			if(mysql_num_rows($getdetails) == 0) { echo "<td colspan=26 align='center'>No games tracked since Elo update.</td>"; }
			else {
			while($row = mysql_fetch_assoc($getdetails)) { ?>
				<tr align="center">
                	<td bgcolor=<?php echo ($row['team'] == 1 ? "#FF7777" : "#7777FF"); ?>><a href="game.php?id=<?php echo $row['gameno']; ?>"><?php echo $row['gameno']." (".$row['teamcaps']."-".$row['oppcaps'].")</a></td>"; ?>
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
					echo "<td>".round($row['tags']/($row['played']/60),2)."</td>";
					echo "<td>".round($row['returns']/($row['played']/60),2)."</td>";
					$puptime = round(($row['bombtime'] + $row['tagprotime'] + $row['griptime']) / 10);
					echo "<td>".round($puptime/$row['played'])."%</td>";
					
					if((round(($row['prevent']/$row['played'])*100) < 0) || (round(($row['prevent']/$row['played'])*100)) > 100 || (round((($row['played']-$row['hold']-$row['prevent'])/$row['played'])*100) < 0) || (round((($row['played']-$row['hold']-$row['prevent'])/$row['played'])*100) > 100) || (round(($row['hold']/$row['played'])*100) < 0) || (round(($row['hold']/$row['played'])*100) > 100)) { echo "<td>Error<sup>2</sup>"; $nan = 1; } else {
					echo "<td>".round(($row['prevent']/$row['played'])*100)."/".round((($row['played']-$row['hold']-$row['prevent'])/$row['played'])*100)."/".round(($row['hold']/$row['played'])*100); } echo "</td>"; 
					if ($row['elo'] > 0) { echo "<td>".$row['elo']."</td>"; }
					else { echo "<td>???<sup>3</sup></td>"; $ebug = 1; }
					?>
                 </tr>
     		<?php  } }
			
			echo "</table>";  
			$gb_end = microtime(true);
$gb = ($gb_end - $gb_start)*1000;

?>
			
  <a name="footnotes"><sup>1</sup></a> If a player activates a powerup while already under the effects of that powerup, the timer extends but the total powerups count does not increase. Thus, Kills per Tagpro may be slightly overgenerous to the player, while Powerups Per Game is a slight understatement, unless the player is a master of chaining powerups. Additionally, Support kills (e.g. Button presses) are counted this way too. This is due to the way the extension handles data at the moment.<br />
<?php  if($nan == 1) { echo "<sup>2</sup> Occurs when recording player joins a game near the end of the game, and DRA numbers are below 0% or above 100% in any category. Known bug. Time Played, H:P, KPM, RPM and PUP for a player with this error should be ignored.<br />"; } ?>
<?php  if($ebug == 1) { echo "<sup>3</sup> Occurs rarely due to Elo glitches. Known bug.<br />"; } ?>
  
  <span style="font-size:x-small">Profiling: <br />
  PMPG Chart: <?php echo $pmpg; ?> ms<br />
  Historical DRA: <?php echo $hdra; ?> ms<br />
  Historical APM: <?php echo $hapm; ?> ms<br />
  Historical Elo: <?php echo $helo; ?> ms<br />
  Game Breakdown: <?php echo $gb; ?> ms</span>
  </div>
  
  <?php include('footer.php'); ?>