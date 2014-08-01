<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: ".stripslashes($_GET['map']);
require_once('header.php'); 

$getmapdetails = query("SELECT SUM(played) as played,SUM(tags) as k, SUM(hold) as a, SUM(prevent) as d, SUM(roam) as r, SUM(powerups) as pup, COUNT(*) as c FROM games WHERE map='".mysql_real_escape_string($_GET['map'])."'");
$m = mysql_fetch_assoc($getmapdetails);
$getgames = query("SELECT COUNT(DISTINCT gameno) FROM games WHERE map='".mysql_real_escape_string($_GET['map'])."'");
$g = mysql_result($getgames,0);
function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
} ?>
<div style="width:100%; margin:0 auto; padding-top:10px" align="center">
<?php
echo "<span style='font-size: larger'>".mysql_real_escape_string($_GET['map']);
echo "</span><br />";
echo secondsToTime($m['played'])." logged total over ".$g." games.";
echo "<br />";
echo "Of that time, "; $a = round($m['a']/$m['played'],2)*100; echo $a."% was spent carrying the flag and ";
$d = round($m['d']/$m['played'],2)*100; echo $d."% was spent in prevent.<br />";
echo "Current death toll: ".$m['k']."<br />";
echo "Average kills per game: "; echo round(($m['k']/$g),2) . "<br />";
echo $m['pup']." powerups grabbed.<br />";
?>
</div>
<?php require_once('footer.php'); ?>