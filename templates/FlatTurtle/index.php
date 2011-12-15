<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="templates/FlatTurtle/style.css" />
</head>
<body>

<div class="container">
	<header>
		<div id="clock"></div>
		<img src="templates/FlatTurtle/amadeussquare.jpg" />
	</header>

	<div id="main"></div>
	
</div>

<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.tmpl.js"></script>
<script type="text/javascript" src="core/underscore.js"></script>
<script type="text/javascript" src="core/backbone.js"></script>
<script type="text/javascript" src="core/turtles.js"></script>
<script type="text/javascript" src="templates/FlatTurtle/interface.js"></script>
<script type="text/javascript" src="templates/FlatTurtle/loader.js"></script>

<script type="text/javascript">
<?php
$turtles = array();
$turtles[] = array("module" => "airport", "options" => array("code" => "BRU", "direction" => "departures", "lang" => "en"));
$turtles[] = array("module" => "airport", "options" => array("code" => "BRU", "direction" => "arrivals", "lang" => "en"));
$turtles[] = array("module" => "map", "options" => array("location" => "Gent"));

foreach($turtles as $turtle)
	echo 'Turtles.grow("'.$turtle["module"].'", '.json_encode($turtle["options"])."); \n";
?>
</script>

</body>
</html>
