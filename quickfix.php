<?php include('functions.php'); include('db.php');
$qf = query("UPDATE games SET iwon=2 WHERE win=2");
$rows = mysql_affected_rows($qf);
echo $rows." rows affected.";
?>