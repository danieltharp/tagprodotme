<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="canvasjs.min.js"></script>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.10.4.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.10.4.custom.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
</head>

<body>
<script>
$(function() {

	$( "#playersearch" ).autocomplete(
	{
		 source:'playersearch.php',
		 select: function (event, ui) {
            window.location = ui.item.url;
        }
	})

});
</script>
<table width="100%">
        	<tr>
            	<td>Search by player: <input type="text" id="playersearch" /></td>
                <td>Search by map: <select name="map" onchange="location = this.options[this.selectedIndex].value;">
                						<option value="">--Please select a map.--</option>
                						<?php $getmaps = query("SELECT DISTINCT map FROM `games` ORDER BY map ASC");
										while($maps = mysql_fetch_assoc($getmaps)) { ?>
                                        <option value="map.php?map=<?php echo urlencode($maps['map']); ?>"><?php echo $maps['map']; ?></option>
                                        <?php } ?>
					                </select>
                
                </td>
                <td>Enter Game ID: <form action="game.php" method="get"><input type="text" name="id" size="4" />&nbsp;<input type="submit" name="submit" value="Go" /></form></td>
                <td><a href="leaderboards.php">Leaderboards</a> (New!)</td>
                <td align="right">Login system TBD.</td>
            </tr>
        </table>