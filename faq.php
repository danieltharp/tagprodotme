<?php 
require_once('functions.php');
require_once('db.php');
$title = "Tagpro.me Advanced Stats Tracker :: FAQ";
require_once('header.php');
?>
<div style="text-align:center; font-size:large; padding-top:10px;">Tagpro.me FAQ (2014-06-15)</div>
<div style="width:100%"><br /><br />
    
    <strong>Q: So what is all this?</strong><br />
    <em>A: Tagpro.me tracks stats from players via the Tagpro.me Sync Agent. It features advanced stats and gives a look at a player's tendencies over the short- and long-term.</em><br /><br />
    
    <strong>Q: Where do I get the Sync Agent?</strong><br />
    <em>A: <a href="https://chrome.google.com/webstore/detail/tagprome-sync-agent/bdlmbkibaopdckdiabdckbpnjkhmkaic" target="_blank">Here.</a> Currently Chrome only, a Firefox extension will be done at a later date.</em><br /><br />
    
    <strong>Q: How do I know you're not trying to screw me/invade my privacy/etc?</strong><br />
    <em>A: The latest copy of the extension's source is always available from <a href="https://github.com/pxdnbluesoul/tagpro-catstats" target="_blank">Github.</a> Also, Chrome tells you in advance what sites it accesses and what permissions it has.</em><br /><br />
    
    <strong>Q: So what do all the stats mean?</strong><br />
    <em>A: They go like this:<br />
    <strong>Game Page:</strong><br />
    <ul>
    	<li><strong>Score:</strong> This is the Score designated by the Tagpro game server. Explanation <a href="http://www.reddit.com/r/tagpro/wiki/score" target="_blank">here</a>.</li>
        <li><strong>Tags/Kills:</strong> How many times you pop an enemy, either due to them carrying the flag or due to you having a Tagpro and popping them.</li>
        <li><strong>Pops:</strong> How many times you yourself are popped, either as flag carrier or by a Tagpro Kill.</li>
        <li><strong>Grabs:</strong> How many times you grab the flag, regardless of if you scored or not.</li>
        <li><strong>Drops:</strong> How many times you die while holding the flag.</li>
        <li><strong>Caps:</strong> How many times you successfully capture the flag.</li>
        <li><strong>Returns:</strong> How many times you yourself pop an enemy flag carrier.</li>
        <li><strong>Hold:</strong> How long you held the flag, measured in mins:secs.</li>
        <li><strong>Prevent:</strong> How long you were within six tiles of your flag while it's under your control.</li>
        <li><strong>Supports:</strong> Increments by one for pushing a button or blocking for the flag carrier (contact made with enemy within radius of friendly flag-carrier).</li>
        <li><strong>Tagpros (time):</strong> How many Tagpros you picked up (green outline around ball), and how much time you spent in that state in mins:secs.</li>
        <li><strong>Juke Juices (time):</strong> How many Juke Juices you picked up (three arrows at bottom of ball), and how much time you spent in that state in mins:secs.</li>
        <li><strong>Bombs (time):</strong> How many Bombs you picked up (flashing outline around ball), and how much time you spent in that state in mins:secs.</li>
        <li><strong>TPUs:</strong> Total Powerups. Sum of Tagpros + Juke Juices + Bombs.</li>
        <li><strong>Played:</strong> How much time you spent in that game, in mins:secs.</li>
        <li><strong>+/-:</strong> Team captures - Enemy captures while you were in the game. This stat works better over a longer data set.</li>
        <li><strong>K:D:</strong> Kill:Death Ratio. Kills/Deaths. Shows Inf. on zero deaths.</li>
        <li><strong>G:R:</strong> Grabs:Returns Ratio. Grabs/Returns. Shows offensive/defensive efficiency when used in conjunction with H:P.</li>
        <li><strong>OEff:</strong> Offensive Efficiency. How efficient a player is when attacking the flag. round(Grabs/Captures)*100.
        <li><strong>H:P:</strong> Hold:Prevent Ratio. Hold Time/Prevent time. Shows offensive/defensive tendencies.</li>
        <li><strong>KPM:</strong> Kills Per Minute. Tags/((secs)Played/60).</li>
        <li><strong>RPM:</strong> Returns Per Minute. Returns/((secs)Played/60).</li>
        <li><strong>PUP:</strong> Powerup Percentage. Amount of time spent in a powerup state as a percentage of time played. (Tagprotime + Jukejuicetime + Bombtime)/(secs)Played.</li>
        <li><strong>D/R/A%:</strong> Defense/Roaming/Attack Percentage.<br />
        	<ul><li>D = round((secs)Prevent/(secs)Played)*100.</li>
            <li>R = round((secs)Played - (secs)Prevent - (secs)Hold)*100.</li>
            <li>A = round((secs)Hold/(secs)Played)*100.</li></ul>
    </ul><br />
    <strong>Player Detail Page:</strong><br />
    <ul>
    	<li><strong>GP:</strong> Games Played. More specifically, games played under that username that the Sync Agent recorded.</li>
        <li><strong>W-L:</strong> Win-Loss Record over those Games Played.</li>
        <li><strong>ASPG:</strong> Average Score Per Game.</li>
        <li><strong>PMPG:</strong> Plus/Minus Per Game.</li>
        <li><strong>CPM:</strong> Captures Per Minute.</li>
        <li><strong>SPM:</strong> Score Per Minute.</li>
        <li><strong>Actions Per Minute (graph):</strong> This stacked column chart shows how many actions <strong>beneficial to their team</strong> that player performed on average each minute. Deaths are not counted. Of note, grabs and captures are independent numbers. Grabs only reflects failed attempts at a capture. This also gives you a quick insight as to their OEff.</li>
        <li><strong>K/TP:</strong>Kills Per Tagpro.</li>
    </em><br /><br />
    
    <strong>Q: Player A is showing they only picked up one Tagpro but that it lasted for (>20) seconds. What gives?</strong><br />
    <em>A: Via eagles.: "When you pick up a powerup your powerup stat changes from false to true. So if you pickup a tagpro, it will be false -> true for tagpro. Then, if you pick up another tagpro, there's no change in the tagpro state (true -> true). The only way to tell (as far as I know) is to time how long the tagpro is present for (if you have a true on tagpro for 30 seconds) you picked up at least 2 tagpros."</em><br /><br />
    
    <strong>Q: I tried to look myself up and I'm not in the player list. Why not?</strong> or <strong>Q: I've been playing for months but it's only showing games from a few days ago. Why?</strong><br />
    <em>A: Did you install the Sync Agent? That's the only reliable way to get yourself tracked. The agent isn't aware of any game history that it didn't record itself.</em><br /><br />
    
    <strong>Q: I tried to go to my player page and I get a bunch of division by zero errors.</strong><br />
    <em>A: This seems to reliably happen with players that have backslashes in their name. You can edit the URL manually after <strong>http://tagpro.me/player.php?id=</strong> and it should take you to the right place. Or don't use such a goofy username next time. This is a <a href="http://tagpro.me/bugs/view.php?id=2" target="_blank">known bug</a>.</em><br /><br />
    
    <strong>Q: I found a bug not referenced here. Wat do?</strong><br />
    <em>A: Please post it to the bug tracker at <a href="http://tagpro.me/bugs" target="_blank">tagpro.me/bugs</a> and I'll look at it.</em><br /><br />
    
    <strong>Q: I would like to see X on tagpro.me.</strong><br />
    <em>A: Please post it to the bug tracker at <a href="http://tagpro.me/bugs" target="_blank">tagpro.me/bugs</a> as an enhancement and I'll look at it.</em>
    
</div>
<?php require_once('footer.php'); ?>