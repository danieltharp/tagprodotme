<?php require_once('../functions.php');
require_once('../db.php');
$title = "Admin Tools";
require_once('../header.php');
?>
Reported games:<br />
<table>
	<thead>
    	<th>Report ID</th>
        <th>Game No.</th>
        <th>Report Type</th>
        <th>Reason</th>
    </thead>

<?php $basiccheck = query("SELECT * FROM reports");
while ($row = mysql_fetch_assoc($basiccheck)) {
	echo "<tr>";
	echo "<td>".$row['reportid']."</td>";
	echo "<td><a href='http://tagpro.me/game.php?id=".$row['gameno']."' target='_blank'>".$row['gameno']."</a></td>";
	echo "<td>".$row['type']."</td>";
	echo "<td>".$row['reason']."</td>";
	echo "</tr>";
	} ?>
<?php include('../footer.php'); ?>