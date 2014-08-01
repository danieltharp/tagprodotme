<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Reporting Game ".$_GET['game'];
require_once('header.php');
?>
<?php if(isset($_POST['report'])) { 
	$gameno = mysql_real_escape_string($_POST['gameno']);
	$type = mysql_real_escape_string($_POST['type']);
	$reason = mysql_real_escape_string($_POST['reason']);
	
	$addreport=query("INSERT INTO reports (reportid,gameno,type,reason) VALUES (NULL,".$gameno.",".$type.",'".$reason."')");
	
	killpage("Your report has been received. The game may not disappear immediately as I examine it, or possibly leave it up for longer study, but I do go through the reports regularly. Please do not submit multiple reports for the same game.");

} else { ?>

<div style="clear:both; padding:10px 0; width:100%">
<form method="post" action="">
<table align="center">
	<tr>
    	<td>Select reason for report:</td>
        <td>
        	<select name="type">
            	<option value="1">Duplicate Game</option>
                <option value="2">Hacked Game</option>
                <option value="3">Buggy Game Results</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Comments: (Optional, limit 140 chars.</td>
        <td><input type="text" maxlength="140" name="reason" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><input type="hidden" name="gameno" value="<?php echo $_GET['game']; ?>" /><input type="submit" name="report" value="Submit" /></td>
    </tr>
</table>
</form></div>
<?php } require_once('footer.php'); ?>