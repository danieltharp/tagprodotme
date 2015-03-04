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
                                                                                <option value="map.php?map=Map%3A+45+by+Salamander">Map: 45 by Salamander</option>
                                                                                <option value="map.php?map=Map%3A+Arena+by+Swingman">Map: Arena by Swingman</option>
                                                                                <option value="map.php?map=Map%3A+Battery+by+Saint+Enigma">Map: Battery by Saint Enigma</option>
                                                                                <option value="map.php?map=Map%3A+Big+Vird+by+LuckySpambasdf">Map: Big Vird by LuckySpambasdf</option>
                                                                                <option value="map.php?map=Map%3A+Blast+Off+by+Noobkin">Map: Blast Off by Noobkin</option>
                                                                                <option value="map.php?map=Map%3A+Bombing+Run+by+LuckySpammer">Map: Bombing Run by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Boombox+by+%26Berk">Map: Boombox by &amp;Berk</option>
                                                                                <option value="map.php?map=Map%3A+Boostsv2.1+by+Danny">Map: Boostsv2.1 by Danny</option>
                                                                                <option value="map.php?map=Map%3A+Bounce+by+ravenJesusInc">Map: Bounce by ravenJesusInc</option>
                                                                                <option value="map.php?map=Map%3A+Bunny+Hop+by+Liquid">Map: Bunny Hop by Liquid</option>
                                                                                <option value="map.php?map=Map%3A+Caravan+by+Swingman">Map: Caravan by Swingman</option>
                                                                                <option value="map.php?map=Map%3A+Center+Flag+by+LuckySpammer">Map: Center Flag by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+CFB+by+DISTRACTION">Map: CFB by DISTRACTION</option>
                                                                                <option value="map.php?map=Map%3A+CFM+by+Flail">Map: CFM by Flail</option>
                                                                                <option value="map.php?map=Map%3A+Clutch+by+LuckySpammer">Map: Clutch by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Cobb+0.3+by+DaEvil1">Map: Cobb 0.3 by DaEvil1</option>
                                                                                <option value="map.php?map=Map%3A+Colors+by+steppin">Map: Colors by steppin</option>
                                                                                <option value="map.php?map=Map%3A+Command+Center+by+bad">Map: Command Center by bad</option>
                                                                                <option value="map.php?map=Map%3A+Danger+Zone+3+by+bad">Map: Danger Zone 3 by bad</option>
                                                                                <option value="map.php?map=Map%3A+Diagon+Twist+by+Ball-E">Map: Diagon Twist by Ball-E</option>
                                                                                <option value="map.php?map=Map%3A+Diamond+Faces+by+Antero_Rin">Map: Diamond Faces by Antero_Rin</option>
                                                                                <option value="map.php?map=Map%3A+Dumbell+by+LuckySpammer">Map: Dumbell by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Figure+8+by+LuckySpammer">Map: Figure 8 by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Foozball+by+Pancake">Map: Foozball by Pancake</option>
                                                                                <option value="map.php?map=Map%3A+GamePad+by+WreckingBall">Map: GamePad by WreckingBall</option>
                                                                                <option value="map.php?map=Map%3A+GeoKoala+by+LuckySpammer">Map: GeoKoala by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Glory+Hole+by+LuckySpammer">Map: Glory Hole by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Grail+of+Speed+by+DaEvil1">Map: Grail of Speed by DaEvil1</option>
                                                                                <option value="map.php?map=Map%3A+Hockey+by+Swingman">Map: Hockey by Swingman</option>
                                                                                <option value="map.php?map=Map%3A+Hourglass+by+WreckingBall">Map: Hourglass by WreckingBall</option>
                                                                                <option value="map.php?map=Map%3A+Hurricane+2+by+Bowtie">Map: Hurricane 2 by Bowtie</option>
                                                                                <option value="map.php?map=Map%3A+Hyper+Reactor+by+bad">Map: Hyper Reactor by bad</option>
                                                                                <option value="map.php?map=Map%3A+Lold+by+asdf">Map: Lold by asdf</option>
                                                                                <option value="map.php?map=Map%3A+Mars+Ball+Explorer+by+LuckySpammer+">Map: Mars Ball Explorer by LuckySpammer </option>
                                                                                <option value="map.php?map=Map%3A+Mars+Game+Mode+by+LuckySpammer">Map: Mars Game Mode by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Micky+M.+0.1+by+DaEvil1">Map: Micky M. 0.1 by DaEvil1</option>
                                                                                <option value="map.php?map=Map%3A+Micro+by+Dethos">Map: Micro by Dethos</option>
                                                                                <option value="map.php?map=Map%3A+Nimbus+by+ppppow">Map: Nimbus by ppppow</option>
                                                                                <option value="map.php?map=Map%3A+Open+Field+Masters+by+PrivateMajor">Map: Open Field Masters by PrivateMajor</option>
                                                                                <option value="map.php?map=Map%3A+Oval+by+Grapefruit">Map: Oval by Grapefruit</option>
                                                                                <option value="map.php?map=Map%3A+Penalties+by+DrMcDonald">Map: Penalties by DrMcDonald</option>
                                                                                <option value="map.php?map=Map%3A+Pokeball+by+IRC+Channel">Map: Pokeball by IRC Channel</option>
                                                                                <option value="map.php?map=Map%3A+Puffer+by+Prizm">Map: Puffer by Prizm</option>
                                                                                <option value="map.php?map=Map%3A+Push+It+by+Salt+N+Pepa+also+Noobkin">Map: Push It by Salt N Pepa also Noobkin</option>
                                                                                <option value="map.php?map=Map%3A+Reflex2+by+Flail">Map: Reflex2 by Flail</option>
                                                                                <option value="map.php?map=Map%3A+Ricochet+by+bad">Map: Ricochet by bad</option>
                                                                                <option value="map.php?map=Map%3A+Rink+by+Swingman">Map: Rink by Swingman</option>
                                                                                <option value="map.php?map=Map%3A+Shortcut+by+LuckySpammer">Map: Shortcut by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Simplicity+by+BBQchicken">Map: Simplicity by BBQchicken</option>
                                                                                <option value="map.php?map=Map%3A+Smirk+by+Noobkin">Map: Smirk by Noobkin</option>
                                                                                <option value="map.php?map=Map%3A+SNES+Rainbow+road+by+Ball-E">Map: SNES Rainbow road by Ball-E</option>
                                                                                <option value="map.php?map=Map%3A+SNES+v2+by+Ron+Burgundy">Map: SNES v2 by Ron Burgundy</option>
                                                                                <option value="map.php?map=Map%3A+Snipers3+by+NewCompte">Map: Snipers3 by NewCompte</option>
                                                                                <option value="map.php?map=Map%3A+Snoo+Track+by+Ball-E">Map: Snoo Track by Ball-E</option>
                                                                                <option value="map.php?map=Map%3A+Speedway+by+LuckySpammer">Map: Speedway by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Spiders+by+Dino">Map: Spiders by Dino</option>
                                                                                <option value="map.php?map=Map%3A+Star+by+LuckySpammer">Map: Star by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+SuperDuperStamp+by+BBQchicken">Map: SuperDuperStamp by BBQchicken</option>
                                                                                <option value="map.php?map=Map%3A+Swoop+by+David+Stern">Map: Swoop by David Stern</option>
                                                                                <option value="map.php?map=Map%3A+Tester+by+LuckySpammer+">Map: Tester by LuckySpammer </option>
                                                                                <option value="map.php?map=Map%3A+The+End+Zone+by+Jungle+Spice">Map: The End Zone by Jungle Spice</option>
                                                                                <option value="map.php?map=Map%3A+The+Holy+See+by+OP">Map: The Holy See by OP</option>
                                                                                <option value="map.php?map=Map%3A+Thinking+With+Portals+by+WreckingBall">Map: Thinking With Portals by WreckingBall</option>
                                                                                <option value="map.php?map=Map%3A+Twister+by+David+Stern">Map: Twister by David Stern</option>
                                                                                <option value="map.php?map=Map%3A+Untitled+by+Anonymous">Map: Untitled by Anonymous</option>
                                                                                <option value="map.php?map=Map%3A+Vee+by+LuckySpammer">Map: Vee by LuckySpammer</option>
                                                                                <option value="map.php?map=Map%3A+Velocity+by+David+Stern">Map: Velocity by David Stern</option>
                                                                                <option value="map.php?map=Map%3A+Whirlwind+2+by+BBQchicken">Map: Whirlwind 2 by BBQchicken</option>
                                                                                <option value="map.php?map=Map%3A+Wormy+by+Flail">Map: Wormy by Flail</option>
                                                                                <option value="map.php?map=Map%3A+yiss+3.2+by+Wumbo">Map: yiss 3.2 by Wumbo</option>
                                       					                </select>
                
                </td>
                <td>Enter Game ID: <form action="game.php" method="get"><input type="text" name="id" size="4" />&nbsp;<input type="submit" name="submit" value="Go" /></form></td>
                <td><a href="leaderboards.php">Leaderboards</a> (New!)</td>
                <td align="right">Login system TBD.</td>
            </tr>
        </table>