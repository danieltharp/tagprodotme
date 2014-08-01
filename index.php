<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker";
require_once('header.php');
?>
	<p>
        <div align="center">Last 10 Games Recorded:</div>
        <table width="800px" align="center">
            <thead>
            		<th>Game ID</th>
                	<th>Recorded</th>
                    <th>Map</th>
                	<th>Duration</th>
                	<th>Result</th>
                    <th>Details</th>
            </thead>
            <tbody>
				<?php $last5 = query("SELECT gameno, timestamp, teamcaps, oppcaps, ROUND(((MAX(arrival) - MIN(departure))/1000)) AS elapsed, map, win FROM games GROUP BY gameno ORDER BY gameno DESC LIMIT 10"); 
				$redwins = 0;
				$bluewins = 0;
				$ties = 0;
				while ($row = mysql_fetch_assoc($last5)) {
					echo "<tr align=center>";
					echo("<td>".$row['gameno']."</td>");
					echo("<td>".time_since(time() - strtotime($row['timestamp']))." ago</td>");
					echo("<td>".substr($row['map'],5)."</td>");
					echo("<td>".gmdate("i:s", $row['elapsed'])."</td>");
					if ($row['win'] == 2) { $winner = 'Tied '; } elseif ($row['win'] == 1) { $winner = 'Red wins '; } else { $winner = 'Blue wins '; }
					$score = $row['teamcaps'] == $row['oppcaps'] ? $row['teamcaps']."-".$row['oppcaps'] : $row['teamcaps'] > $row['oppcaps'] ? $row['teamcaps']."-".$row['oppcaps'] : $row['oppcaps']."-".$row['teamcaps'];
					echo("<td>".$winner.$score."</td>");
					echo("<td><a href='game.php?id=".$row['gameno']."'>Click for details</a></td>");
					echo "</tr>";
									}
				?>
            </tbody>
        </table>
    </p>
	<?php $getresults = query("SELECT idxtotalgames,idxredwins,idxbluewins,idxties,rows,datapoints FROM preaggs WHERE 1");
	
	$results = mysql_fetch_assoc($getresults); ?>
	<p align="center">
		<script type="text/javascript">
  window.onload = function () {
          CanvasJS.addColorSet("results",
                [//colorSet Array

                "#FF0000",
                "#0000FF",
                "#666666"           
                ]);
    var chart = new CanvasJS.Chart("chartContainer",
    {
		colorSet: "results", backgroundColor: "#FFFFFF",
      title:{
        text: "Results Over <?php echo $results['idxtotalgames']; ?> Games"
      },
       data: [
      {
         type: "pie",
       showInLegend: false,
       dataPoints: [
       {  y: <?php echo $results['idxredwins']; ?>, legendText:"Red", indexLabel: "Red Wins" },
       {  y: <?php echo $results['idxbluewins']; ?>, legendText:"Blue", indexLabel: "Blue Wins" },
       {  y: <?php echo $results['idxties']; ?>, legendText:"Ties", indexLabel: "Ties" },
       ]
     }
     ]
   });

    chart.render();
  }
  </script>
   <div id="chartContainer" style="height: 300px; width: 300px; margin-left: auto; margin-right: auto;">
   </div>
   <div style="clear:both">&nbsp;</div>
   <div style="font-size:small; text-align:center">Serving <?php echo number_format($results['datapoints']); ?> data points over <?php echo number_format($results['rows']); ?> game entries.</div>
   </p>
   	<p>
		The website is slowly taking shape and I have decided to release the Chrome extension to the public as an Open Beta release. Grab it <a href="https://chrome.google.com/webstore/detail/tagprome-sync-agent/bdlmbkibaopdckdiabdckbpnjkhmkaic">here</a>. Player search, game details, player details and Game ID direct input are working. Map page is NYI. Login/Registration is NYI.<br /><br />
        
        Wondering where your stats are? <a href="http://www.reddit.com/r/TagPro/comments/2ajq6w/tagprome_stats_are_gone/">http://www.reddit.com/r/TagPro/comments/2ajq6w/tagprome_stats_are_gone/</a><br /><br />
        Been a fun weekend, added a lot of new features and officially released the site as version 0.6 about 36 hours ahead of schedule. <a href="http://www.reddit.com/r/TagPro/comments/2akfln/tagprome_update_to_extension_data_wipe_pls_no/">http://www.reddit.com/r/TagPro/comments/2akfln/tagprome_update_to_extension_data_wipe_pls_no/</a>
	</p>
<?php require_once('footer.php'); ?>
