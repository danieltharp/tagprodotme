<?php
  require_once('db.php'); require_once('functions.php');
	for	($i = 1; $i <= 25;$i++) { 
		$updatekd = query("INSERT INTO leaderboards (board,rank) VALUES ('top25kd','".$i."')");
	}
		for	($i = 1; $i <= 25;$i++) { 
		$updatekd = query("INSERT INTO leaderboards (board,rank) VALUES ('top25OEff','".$i."')");
	}
		for	($i = 1; $i <= 25;$i++) { 
		$updatekd = query("INSERT INTO leaderboards (board,rank) VALUES ('top25PMPG','".$i."')");
	}
		for	($i = 1; $i <= 25;$i++) { 
		$updatekd = query("INSERT INTO leaderboards (board,rank) VALUES ('top25SPM','".$i."')");
	}
		for	($i = 1; $i <= 25;$i++) { 
		$updatekd = query("INSERT INTO leaderboards (board,rank) VALUES ('top25RPM','".$i."')");
	}
		for	($i = 1; $i <= 25;$i++) { 
		$updatekd = query("INSERT INTO leaderboards (board,rank) VALUES ('top25CPM','".$i."')");
	}
?>