<?php
	
	$getcaptures=query("Select FORMAT(STD(captures),2) AS sdev, FORMAT(AVG(captures),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getcaptures);
	$updatecaptures=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='captures'");
	
	$getscore=query("Select FORMAT(STD(score),2) AS sdev, FORMAT(AVG(score),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getscore);
	$updatescore=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='score'");
	
	$getpops=query("Select FORMAT(STD(pops),2) AS sdev, FORMAT(AVG(pops),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getpops);
	$updatepops=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='pops'");
	
	$gettags=query("Select FORMAT(STD(tags),2) AS sdev, FORMAT(AVG(tags),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($gettags);
	$updatetags=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='tags'");
	
	$getreturns=query("Select FORMAT(STD(returns),2) AS sdev, FORMAT(AVG(returns),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getreturns);
	$updatereturns=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='returns'");
	
	$getgrabs=query("Select FORMAT(STD(grabs),2) AS sdev, FORMAT(AVG(grabs),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getgrabs);
	$updategrabs=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='grabs'");
	
	$gethold=query("Select FORMAT(STD(hold),2) AS sdev, FORMAT(AVG(hold),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($gethold);
	$updatehold=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='hold'");

	$getprevent=query("Select FORMAT(STD(prevent),2) AS sdev, FORMAT(AVG(prevent),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getprevent);
	$updateprevent=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='prevent'");
	
	$getplayed=query("Select FORMAT(STD(played),2) AS sdev, FORMAT(AVG(played),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getplayed);
	$updateplayed=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='played'");
	
	$getdrops=query("Select FORMAT(STD(drops),2) AS sdev, FORMAT(AVG(drops),2) AS average FROM games WHERE auth=1");
	$row = mysql_fetch_row($getdrops);
	$updatedrops=query("UPDATE metrics SET std='".$row[0]."',avg='".$row[1]."' WHERE metric='drops'");
?>