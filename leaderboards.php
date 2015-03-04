<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Leaderboards";
require_once('header.php'); ?>

<div style="width:100%; margin:0 auto">
<div style="float:left; width:33%">
<div align="center">Top K:D (min. 250 kills)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>K:D</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name,data FROM leaderboards WHERE board='top25kd' ORDER BY rank ASC"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['data']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="float:left; width:33%">
<div align="center">Top OEff% (min. 100 captures)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>OEff</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name,data FROM leaderboards WHERE board='top25OEff' ORDER BY rank ASC"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['data']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div><div style="float:left; width:33%">
<div align="center">Top PMPG (min. 100 games)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>PMPG</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name,data FROM leaderboards WHERE board='top25PMPG' ORDER BY rank ASC"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['data']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="clear:both; padding:10px 0"> </div>

<div style="float:left; width:33%">
<div align="center">Top Score Per Minute (min. 300 minutes)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>SPM</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name,data FROM leaderboards WHERE board='top25SPM' ORDER BY rank ASC"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['data']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="float:left; width:33%">
<div align="center">Top Captures Per Minute (min. 300 minutes)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>CPM</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name,data FROM leaderboards WHERE board='top25CPM' ORDER BY rank ASC"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['data']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
<div style="float:left; width:33%">
<div align="center">Top Returns Per Minute (min. 300 minutes)</div>
<table width="350" align="center">
            <thead>
            		<th>Rank</th>
                	<th>Name</th>
                    <th>RPM</th>
           	</thead>
            <tbody>
            <?php $gettop25elo = query("SELECT name,data FROM leaderboards WHERE board='top25RPM' ORDER BY rank ASC"); 
			$i = 1;
			while($row = mysql_fetch_assoc($gettop25elo)) { 
			echo "<tr align='center'>";
				echo "<td>".$i."</td>";
				echo "<td><a href='player.php?id=".urlencode($row['name'])."'>".$row['name']."</a></td>";
				echo "<td>".$row['data']."</td>";
			echo "</tr>";
			$i++;
			}
			?>
			</tbody>
            </table>


</div>
</div>
<div style="clear:both; padding:10px 0"> </div>
Leaderboards update after every 1000 games recorded and takes about 5 minutes during peak time.
<?php require_once('footer.php'); ?>