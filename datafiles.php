<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: Averages and Deviations";
require_once('header.php');
?><br />
	<div align="center">Data files for statistical use.</div><br />
    
<a href="games20140909.csv.zip">Full Data Set, dumped 2014-09-09</a> (CSV)<br />
<a href="games20140803.csv.zip">Full Data Set, dumped 2014-08-03</a> (CSV)<br />
<a href="elodata.sql.zip">Old game and Elo data from before Elo was scrapped.</a> (SQL)<br />
<a href="temp_corrdata.csv.zip">Anonymous game data, containing Grabs, Captures, Returns, Hold, Prevent and iwon.</a> (CSV) Used in <a href="http://blog.tagpro.me/?p=9">this blog post.</a><br />
<a href="WinProbabilities20140814.xlsb.zip">Pivot-enabled Excel Book with win probabilities based on above CSV.</a> (XLSB) Used in <a href="http://blog.tagpro.me/?p=9">this blog post.</a>

    
<?php
require_once('footer.php');
?>