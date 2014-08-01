<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Leaderboards";
require_once('header.php'); ?>

<div style="width:100%; margin:0 auto">
<div style="float:left; width:33%">
<div align="center">Top Elo</div>
        <table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>Elo</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT elo, name FROM (SELECT elo, name FROM games WHERE auth=1 ORDER BY gameno DESC) AS g2 WHERE 1 GROUP BY name ORDER BY elo DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['elo']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>
</div><div style="float:left; width:33%">
<div align="center">Top K:D (min. 50 kills)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>K:D</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name, SUM(tags) as k ,SUM(pops) as d FROM games WHERE auth=1 GROUP BY name HAVING (k >= 50) ORDER BY SUM(tags)/SUM(pops) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['k']."-".$row['d']." (";
				$kdr = round(($row['k']/$row['d']),2);
				echo $kdr.")</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="float:left; width:33%">
<div align="center">Top OEff% (min. 25 captures)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>OEff</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name, SUM(captures) as c ,SUM(grabs) as g FROM games WHERE auth=1 GROUP BY name HAVING (c >= 25) ORDER BY SUM(captures)/SUM(grabs) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['c']." on ".$row['g']." (";
				$kdr = round(($row['c']/$row['g']),4)*100;
				echo $kdr."%)</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="clear:both; padding:10px 0"> </div>
<div style="float:left; width:33%">
<div align="center">Top PMPG (min. 25 games)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>PMPG</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name, COUNT(gameno) as c ,SUM(plusminus) as pm FROM games WHERE auth=1 GROUP BY name HAVING (c >= 25) ORDER BY SUM(plusminus)/COUNT(gameno) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>+".$row['pm']." on ".$row['c']." (+";
				$pmpg = round(($row['pm']/$row['c']),3);
				echo $pmpg."/gm)</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="float:left; width:33%">
<div align="center">Top Score Per Minute (min. 30 minutes)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>SPM</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name, sum(played) as p, SUM(score) as s FROM games WHERE auth=1 GROUP BY name HAVING (p >= 1800) ORDER BY SUM(score)/sum(played) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				$spm = round(($row['s']/($row['p']/60)),2);
				echo "<td>".$spm."/min</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="float:left; width:33%">
<div align="center">Top Returns Per Minute (min. 30 minutes)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>RPM</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name, sum(played) as p, SUM(returns) as r FROM games WHERE auth=1 GROUP BY name HAVING (p >= 1800) ORDER BY SUM(returns)/sum(played) DESC LIMIT 25"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				$spm = round(($row['r']/($row['p']/60)),2);
				echo "<td>".$spm."/min</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
</div>
<div style="clear:both; padding:10px 0"> </div>
<?php require_once('footer.php'); ?>