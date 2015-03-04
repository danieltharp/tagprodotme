<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Averages and Deviations";
require_once('header.php');
?><br />
	<div align="center">Averages and Standard Deviations for common metrics.</div><br />
    <table align="center">
    	<thead>
        	<th>Metric</th>
            <th>Average</th>
            <th>Std. Dev</th>
        </thead>
        <tbody>
        	<?php $getmetrics = query("SELECT * FROM metrics WHERE 1 ORDER BY `order`");
			while ($row = mysql_fetch_assoc($getmetrics)) {
				echo "<tr>";
					echo "<td>".ucwords($row['metric'])."</td>";
					echo "<td>".$row['avg']."</td>";
					echo "<td>".$row['std']."</td>";
				echo "</tr>";
			}
			?>
        </tbody>
    </table>
   <?php $getrows = query("SELECT rows FROM preaggs WHERE 1"); 
   $count = mysql_result($getrows,0);
   
   echo "<br /><div align='center'>Above statistics are calculated over ".number_format($count)." &plusmn;1500 game entries and are updated every 1500 games. Only data from players playing under their reserved names are counted. All counts are per game, Hold/Prevent/Played is in seconds.</div>";
   ?>
    
<?php
require_once('footer.php');
?>