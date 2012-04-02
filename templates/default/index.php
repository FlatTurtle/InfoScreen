<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $infoscreen->title ? $infoscreen->title : "FlatTurtle"; ?></title>
	<base href="<?php echo baseUrl(); ?>">
	<link rel="stylesheet" href="<? echo baseUrl("templates/default/css/style.min.css"); ?>" />
	<style>
		.color { background-color: <?php echo $infoscreen->color ? $infoscreen->color : "#FB8B1A"; ?>; }
        .text-color { color: <?php echo $infoscreen->color ? $infoscreen->color : "#FB8B1A"; ?>; }	
	</style>
</head>
<body>

<div class="container">
	<header>
		<div id="clock" class="color"><span id="clockhour"></span><img src="templates/default/img/colon.gif"><span id="clockminutes"></span></div>
		<?php if($infoscreen->logo): ?>
		<div id="logo"><img height="100px" src="<?php echo $infoscreen->logo; ?>" alt="<?php echo $infoscreen->title ? $infoscreen->title : "FlatTurtle"; ?>" /></div>
		<?php endif; ?>
	</header>

	<section id="main"></section>
</div>

<script src="<? echo baseUrl("core/core.min.js"); ?>"></script>
<script src="<? echo baseUrl("templates/default/js/application.min.js"); ?>"></script>

<script>
<?php
// infoscreen
echo "	var infoScreen = ".json_encode($infoscreen).";\n";

// turtles
foreach($turtles as $turtle)
	echo '	Turtles.grow("'.$turtle->module.'", '.json_encode($turtle->options).");\n";
?>
</script>

</body>
</html>
