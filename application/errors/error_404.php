<?php
# 301 Redirects
$urlbits = split('/',$_SERVER['REQUEST_URI']);

if (@$urlbits[2]=='play')
{
	// game, redirect to /games/...
	Header( "HTTP/1.1 301 Moved Permanently" ); 
	Header( "Location: http://www.killthezombies.com/games/".$urlbits[3] ); 
}
elseif (@$urlbits[2]=='games')
{
	// directory, redirect to /games/...
	Header( "HTTP/1.1 301 Moved Permanently" ); 
	Header( "Location: http://www.killthezombies.com/games/folders/".$urlbits[3] );
}
else if (@$urlbits[1]=='online-zombie-games' && empty($urlbits[2]))
{
	Header( "HTTP/1.1 301 Moved Permanently" ); 
	Header( "Location: http://www.killthezombies.com/" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
</body>
</html>
<!--
# 301 Redirects
# Redirect 301 relative/path/to/oldurl/ http://www.domain.com/newurl/

Redirect 301 /online-zombie-games/ http://www.killthezombies.com
Redirect 301 /online-zombie-games/games/crazy-zombie-games/ http://www.killthezombies.com/games/folders/crazy-zombie-games
Redirect 301 /online-zombie-games/play/infectonator:-christmas-edition/ http://www.killthezombies.com/games/infectonator-christmas
Redirect 301 /online-zombie-games/play/infectonator-world-dominator/ http://www.killthezombies.com/games/infectonator-word-dominator
Redirect 301 /online-zombie-games/play/infectonator/ http://www.killthezombies.com/games/infectonator
Redirect 301 /online-zombie-games/play/big-pixel-zombies/ http://www.killthezombies.com/games/big-pixel-zombies
Redirect 301 /online-zombie-games/play/zombie-golf-riot/ http://www.killthezombies.com/games/zombie-golf-riot
Redirect 301 /online-zombie-games/play/hidden-zombie/ http://www.killthezombies.com/games/hidden-zombie
Redirect 301 /online-zombie-games/play/night-of-1000-(or-so)-zombies/ http://www.killthezombies.com/games/night-of-1000-or-so-zombies
Redirect 301 /online-zombie-games/play/zombie-mario/ http://www.killthezombies.com/games/zombie-mario
Redirect 301 /online-zombie-games/play/the-simpsons-zombie-shooter/ http://www.killthezombies.com/games/the-simpsons-zombie-shooter
Redirect 301 /online-zombie-games/play/we-are-legend:-akropolis/ http://www.killthezombies.com/games/we-are-legend-akropolis
Redirect 301 /online-zombie-games/play/mombie/ http://www.killthezombies.com/games/mombie
Redirect 301 /online-zombie-games/play/zombie-nation-(nes)/ http://www.killthezombies.com/games/zombie-nation
Redirect 301 /online-zombie-games/play/tim-the-zombie/ http://www.killthezombies.com/games/time-the-zombie
Redirect 301 /online-zombie-games/play/zombie-hotel/ http://www.killthezombies.com/games/zombie-hotel
Redirect 301 /online-zombie-games/play/attack-of-the-tweetie-zombies/ http://www.killthezombies.com/games/attack-of-the-tweety-zombies
Redirect 301 /online-zombie-games/play/mambo-zombie-surf/ http://www.killthezombies.com/games/mambo-zombie-surf
Redirect 301 /online-zombie-games/play/keep-away!/ http://www.killthezombies.com/games/keep-away
Redirect 301 /online-zombie-games/play/zombie-balls/ http://www.killthezombies.com/games/zombie-balls
Redirect 301 /online-zombie-games/play/zombie-tic-tac-toe/ http://www.killthezombies.com/games/zombie-tic-tac-toe
Redirect 301 /online-zombie-games/play/grave-robber/ http://www.killthezombies.com/games/grave-robber
Redirect 301 /online-zombie-games/play/night-of-the-zombie-kittens/ http://www.killthezombies.com/games/night-of-the-zombie-kittens
Redirect 301 /online-zombie-games/play/zombie-simulator/ http://www.killthezombies.com/games/zombie-simulator
Redirect 301 /online-zombie-games/play/teh-zombie-2/ http://www.killthezombies.com/games/teh-zombie-2
Redirect 301 /online-zombie-games/play/teh-zombie/ http://www.killthezombies.com/games/teh-zombie
Redirect 301 /online-zombie-games/games/side-scrollers/ http://www.killthezombies.com/games/folders/side-scrollers
Redirect 301 /online-zombie-games/play/zombie-hooker-nightmare/ http://www.killthezombies.com/games/zombie-hooker-nightmare
Redirect 301 /online-zombie-games/play/zombie-exploder/ http://www.killthezombies.com/games/zombie-exploder
Redirect 301 /online-zombie-games/play/ninjotic-mayhem/ http://www.killthezombies.com/games/ninjotic-mayhem
Redirect 301 /online-zombie-games/play/attack-of-the-zombies/ http://www.killthezombies.com/games/attack-of-the-zombies
Redirect 301 /online-zombie-games/play/wpn-fire/ http://www.killthezombies.com/games/wpn-fire
Redirect 301 /online-zombie-games/play/the-atonement/ http://www.killthezombies.com/games/the-atonement-prologue
Redirect 301 /online-zombie-games/play/graveyard-of-drunken-souls/ http://www.killthezombies.com/games/graveyard-of-drunken-souls
Redirect 301 /online-zombie-games/play/deady/ http://www.killthezombies.com/games/deady
Redirect 301 /online-zombie-games/play/zombie-patrol/ http://www.killthezombies.com/games/zombie-patrol
Redirect 301 /online-zombie-games/play/zombie-kiss/ http://www.killthezombies.com/games/zombie-kiss
Redirect 301 /online-zombie-games/play/the-invasion-of-the-halloween-monsters/ http://www.killthezombies.com/games/the-invasion-of-the-halloween-monsters
Redirect 301 /online-zombie-games/play/silhouette/ http://www.killthezombies.com/games/silhouette
Redirect 301 /online-zombie-games/play/jason-reinsvold's-zombie-hunter/ http://www.killthezombies.com/games/jason-reinsvolds-zombie-hunter
Redirect 301 /online-zombie-games/play/headshots-only-(unfinished-demo)/ http://www.killthezombies.com/games/headshots-only-demo
Redirect 301 /online-zombie-games/play/commissar-zombie/ http://www.killthezombies.com/games/comissar-zombie
Redirect 301 /online-zombie-games/play/the-deads:-zombie-rising/ http://www.killthezombies.com/games/the-deads-zombie-rising
Redirect 301 /online-zombie-games/play/zombie-slayer/ http://www.killthezombies.com/games/zombie-slayer
Redirect 301 /online-zombie-games/play/ultimate-world-cup-20x6/ http://www.killthezombies.com/games/ultimate-world-cup-20x6
Redirect 301 /online-zombie-games/play/escape-from-helltowers/ http://www.killthezombies.com/games/escape-from-helltowers
Redirect 301 /online-zombie-games/play/deanimator/ http://www.killthezombies.com/games/deanimator
Redirect 301 /online-zombie-games/play/zombie-terror/ http://www.killthezombies.com/games/zombie-terror
Redirect 301 /online-zombie-games/play/ultimate-down/ http://www.killthezombies.com/games/ultimate-down
Redirect 301 /online-zombie-games/play/zombieland/ http://www.killthezombies.com/games/zombieland
Redirect 301 /online-zombie-games/play/funky-disco-zombies/ http://www.killthezombies.com/games/night-of-the-funky-disco-zombies
Redirect 301 /online-zombie-games/play/zombie-grinder/ http://www.killthezombies.com/games/zombie-grinder
Redirect 301 /online-zombie-games/play/divine-intervention/ http://www.killthezombies.com/games/divine-intervention
Redirect 301 /online-zombie-games/play/zombified/ http://www.killthezombies.com/games/zombified
Redirect 301 /online-zombie-games/play/worms:-mission-2/ http://www.killthezombies.com/games/worms-mission-2
Redirect 301 /online-zombie-games/play/worms/ http://www.killthezombies.com/games/worms
Redirect 301 /online-zombie-games/play/zombie-survival:-special-mission/ http://www.killthezombies.com/games/zombie-survival-special-mission
Redirect 301 /online-zombie-games/play/zombie-survival/ http://www.killthezombies.com/games/zombie-survival
Redirect 301 /online-zombie-games/games/zombie-defence/ http://www.killthezombies.com/games/zombie-defence
Redirect 301 /online-zombie-games/play/plants-vs-zombies/ http://www.killthezombies.com/games/plants-vs-zombies
Redirect 301 /online-zombie-games/play/zombie-hole/ http://www.killthezombies.com/games/zombie-hold
Redirect 301 /online-zombie-games/play/days-2-die/ http://www.killthezombies.com/games/days-2-die
Redirect 301 /online-zombie-games/play/when-the-plague-came/ http://www.killthezombies.com/games/when-the-plague-came
Redirect 301 /online-zombie-games/play/survival-of-the-fittest/ http://www.killthezombies.com/games/survival-of-the-fittest
Redirect 301 /online-zombie-games/play/24-days-in-the-mall/ http://www.killthezombies.com/games/24-days-in-the-mall
Redirect 301 /online-zombie-games/play/zombie-war/ http://www.killthezombies.com/games/zombie-war
Redirect 301 /online-zombie-games/play/dawn-of-the-dead/ http://www.killthezombies.com/games/dawn-of-the-dead
Redirect 301 /online-zombie-games/play/zombie-swarm/ http://www.killthezombies.com/games/zombie-swarm
Redirect 301 /online-zombie-games/play/zombie-horde-kung-fu/ http://www.killthezombies.com/games/zombie-horde-kungfu
Redirect 301 /online-zombie-games/play/zombie-massacre/ http://www.killthezombies.com/games/zombie-massacre
Redirect 301 /online-zombie-games/play/night-of-a-billion-zombies-(monkey-poo)/ http://www.killthezombies.com/games/night-of-a-billion-zombies-monkey-poo
Redirect 301 /online-zombie-games/play/undead-cleansing/ http://www.killthezombies.com/games/undead-cleansing
Redirect 301 /online-zombie-games/play/hungry-are-the-dead/ http://www.killthezombies.com/games/hungry-are-the-dead
Redirect 301 /online-zombie-games/play/dawn-of-the-bod/ http://www.killthezombies.com/games/dawn-of-the-bod
Redirect 301 /online-zombie-games/play/zombie-2/ http://www.killthezombies.com/games/zombie-2
Redirect 301 /online-zombie-games/play/mini-zombie-game/ http://www.killthezombies.com/games/mini-zombie-game
Redirect 301 /online-zombie-games/play/zombie-attack/ http://www.killthezombies.com/games/zombie-attack
Redirect 301 /online-zombie-games/play/towely-zombie-killer/ http://www.killthezombies.com/games/towely-zombie-killer
Redirect 301 /online-zombie-games/play/generic-defense/ http://www.killthezombies.com/games/generic-defense-game
Redirect 301 /online-zombie-games/play/zombie-slayer-shooter/ http://www.killthezombies.com/games/zombie-slayer-shooter
Redirect 301 /online-zombie-games/play/zombies-attack!/ http://www.killthezombies.com/games/zombies-attack
Redirect 301 /online-zombie-games/play/shaun-of-the-dead/ http://www.killthezombies.com/games/shaun-of-the-dead
Redirect 301 /online-zombie-games/play/zombie-shooter/ http://www.killthezombies.com/games/zombie-shooter
Redirect 301 /online-zombie-games/play/house-of-1000-(identical)-corpses/ http://www.killthezombies.com/games/house-of-1000-identical-corpses
Redirect 301 /online-zombie-games/play/cemetary-2/ http://www.killthezombies.com/games/cemetary-2
Redirect 301 /online-zombie-games/play/cemetary/ http://www.killthezombies.com/games/cemetary
Redirect 301 /online-zombie-games/play/zombie-defence-2/ http://www.killthezombies.com/games/zombie-defence-2
Redirect 301 /online-zombie-games/play/altex-3/ http://www.killthezombies.com/games/altex-3
Redirect 301 /online-zombie-games/play/monster-mash-2/ http://www.killthezombies.com/games/monster-mash-2
Redirect 301 /online-zombie-games/play/monster-mash/ http://www.killthezombies.com/games/monster-mash
Redirect 301 /online-zombie-games/play/zombie-hunter/ http://www.killthezombies.com/games/zombie-hunter
Redirect 301 /online-zombie-games/play/zombie-defence-xt/ http://www.killthezombies.com/games/zombie-defence-xt
Redirect 301 /online-zombie-games/play/generic-zombie-shoota/ http://www.killthezombies.com/games/generic-zombie-shoota
Redirect 301 /online-zombie-games/play/grave-2/ http://www.killthezombies.com/games/grave-2
Redirect 301 /online-zombie-games/play/zombie-fps/ http://www.killthezombies.com/games/zombie-fps
Redirect 301 /online-zombie-games/play/resident-devil/ http://www.killthezombies.com/games/resident-devil
Redirect 301 /online-zombie-games/play/zombie-killer-2071ad/ http://www.killthezombies.com/games/zombie-killer-2071ad
Redirect 301 /online-zombie-games/play/zombie-killer-2072ad/ http://www.killthezombies.com/games/zombie-killer-2072ad
Redirect 301 /online-zombie-games/play/zombie-erik/ http://www.killthezombies.com/games/zombie-erik
Redirect 301 /online-zombie-games/play/zombie-defence-christmas/ http://www.killthezombies.com/games/zombie-defence-christmas
Redirect 301 /online-zombie-games/play/zombie-defence/ http://www.killthezombies.com/games/zombie-defence
Redirect 301 /online-zombie-games/play/thing-thing-arena/ http://www.killthezombies.com/games/thing-thing-arena
Redirect 301 /online-zombie-games/play/zombie-squirrel-attack/ http://www.killthezombies.com/games/zombie-squirrel-attack
Redirect 301 /online-zombie-games/play/zombie-assault/ http://www.killthezombies.com/games/zombie-assault
Redirect 301 /online-zombie-games/play/zombie-rush/ http://www.killthezombies.com/games/zombie-rush
Redirect 301 /online-zombie-games/play/all-hallows-eve/ http://www.killthezombies.com/games/all-hallows-eve
Redirect 301 /online-zombie-games/games/zombie-rpg/ http://www.killthezombies.com/games/zombie-rpg
Redirect 301 /online-zombie-games/play/zombies-took-my-daughter/ http://www.killthezombies.com/games/zombies-took-my-daughter
Redirect 301 /online-zombie-games/play/sonny-2/ http://www.killthezombies.com/games/sonny-2
Redirect 301 /online-zombie-games/play/sonny/ http://www.killthezombies.com/games/sonny
Redirect 301 /online-zombie-games/play/zombie-nightmare:-part-2/ http://www.killthezombies.com/games/zombie-nightmare-part-2
Redirect 301 /online-zombie-games/play/zombie-nightmare:-part-1/ http://www.killthezombies.com/games/zombie-nightmare-part-1
Redirect 301 /online-zombie-games/play/escape-from-zombie-town-2/ http://www.killthezombies.com/games/escape-from-zombie-town-2
Redirect 301 /online-zombie-games/play/escape-from-zombie-town-0/ http://www.killthezombies.com/games/escape-from-zombie-town-part-0
Redirect 301 /online-zombie-games/play/zombie-inglor/ http://www.killthezombies.com/games/zombie-inglor
Redirect 301 /online-zombie-games/play/diseased-corpse/ http://www.killthezombies.com/games/diseased-corpse
Redirect 301 /online-zombie-games/games/zombie-shooting/ http://www.killthezombies.com/games/zombie-shooting
Redirect 301 /online-zombie-games/play/13-days-in-hell/ http://www.killthezombies.com/games/13-days-in-hell
Redirect 301 /online-zombie-games/play/boxhead:-zombie-wars/ http://www.killthezombies.com/games/boxhead-zombie-wars
Redirect 301 /online-zombie-games/play/dead-frontier:-night-three/ http://www.killthezombies.com/games/dead-frontier-night-three
Redirect 301 /online-zombie-games/play/monster-invade/ http://www.killthezombies.com/games/monster-invade
Redirect 301 /online-zombie-games/play/doom-game/ http://www.killthezombies.com/games/doom-game
Redirect 301 /online-zombie-games/play/close-quarter-combat/ http://www.killthezombies.com/games/close-quarter-combat
Redirect 301 /online-zombie-games/play/dead-frontier:-night-two/ http://www.killthezombies.com/games/dead-frontier-night-two
Redirect 301 /online-zombie-games/play/breaking-point/ http://www.killthezombies.com/games/breaking-point
Redirect 301 /online-zombie-games/play/the-haunted-house-of-gouls/ http://www.killthezombies.com/games/the-haunted-house-of-gouls
Redirect 301 /online-zombie-games/play/zombie-blast/ http://www.killthezombies.com/games/zombie-blast
Redirect 301 /online-zombie-games/play/dead-frontier:-night-one/ http://www.killthezombies.com/games/dead-frontier-night-one
Redirect 301 /online-zombie-games/play/blot-in-hell/ http://www.killthezombies.com/games/blot-in-hell
Redirect 301 /online-zombie-games/play/final-strike/ http://www.killthezombies.com/games/final-strike
Redirect 301 /online-zombie-games/play/zomg-zombies/ http://www.killthezombies.com/games/zomg-zombies
Redirect 301 /online-zombie-games/play/zombie-city/ http://www.killthezombies.com/games/zombie-city
Redirect 301 /online-zombie-games/play/land-of-the-dead/ http://www.killthezombies.com/games/land-of-the-dead
Redirect 301 /online-zombie-games/play/destroy-all-zombies-2/ http://www.killthezombies.com/games/destroy-all-zombies-2
Redirect 301 /online-zombie-games/play/destroy-all-zombies/ http://www.killthezombies.com/games/destroy-all-zombies
Redirect 301 /online-zombie-games/play/shoot-zombies/ http://www.killthezombies.com/games/shoot-zombies
Redirect 301 /online-zombie-games/play/zombie-hunter-2/ http://www.killthezombies.com/games/zombie-hunter-2
Redirect 301 /online-zombie-games/play/zombie-storm/ http://www.killthezombies.com/games/zombie-storm
Redirect 301 /online-zombie-games/play/project-validus:-survival/ http://www.killthezombies.com/games/project-validus-survival
Redirect 301 /online-zombie-games/play/zombie-horde-3/ http://www.killthezombies.com/games/zombie-horde-3
Redirect 301 /online-zombie-games/play/zombie-horde-2/ http://www.killthezombies.com/games/zombie-horde-2
Redirect 301 /online-zombie-games/play/zombie-horde/ http://www.killthezombies.com/games/zombie-horde
Redirect 301 /online-zombie-games/play/endless-zombie-rampage/ http://www.killthezombies.com/games/endless-zombie-rampage
Redirect 301 /online-zombie-games/play/boxhead:-2play/ http://www.killthezombies.com/games/boxhead-2play
Redirect 301 /online-zombie-games/play/boxhead-3:-more-rooms/ http://www.killthezombies.com/games/boxhead-more-rooms
Redirect 301 /online-zombie-games/play/boxhead-2:-the-rooms/ http://www.killthezombies.com/games/boxhead-the-rooms
Redirect 301 /online-zombie-games/play/boxhead/ http://www.killthezombies.com/games/boxhead
Redirect 301 /online-zombie-games/games/zombie-survival/ http://www.killthezombies.com/games/zombie-survival
Redirect 301 /online-zombie-games/play/pandemic-2/ http://www.killthezombies.com/games/pandemic-2
Redirect 301 /online-zombie-games/play/the-last-stand-2/ http://www.killthezombies.com/games/the-last-stand-2
Redirect 301 /online-zombie-games/play/luncheon-of-the-dead/ http://www.killthezombies.com/games/luncheon-of-the-dead
Redirect 301 /online-zombie-games/play/land-of-the-dead-movie-game/ http://www.killthezombies.com/games/land-of-the-dead-movie
Redirect 301 /online-zombie-games/play/dead-of-night/ http://www.killthezombies.com/games/dead-of-night
Redirect 301 /online-zombie-games/play/pandemic:-extinction-of-man/ http://www.killthezombies.com/games/pandemic-extinction-of-man
Redirect 301 /online-zombie-games/play/pandemic/ http://www.killthezombies.com/games/pandemic
Redirect 301 /online-zombie-games/play/rotting-onslaught/ http://www.killthezombies.com/games/rotting-onslaught
Redirect 301 /online-zombie-games/play/the-last-stand/ http://www.killthezombies.com/games/the-last-stand
Redirect 301 /online-zombie-games/play/autumn-war/ http://www.killthezombies.com/games/autumn-war
-->