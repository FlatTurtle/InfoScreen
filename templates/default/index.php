<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $infoscreen->title ? $infoscreen->title : "FlatTurtle"; ?></title>
	<base href="<?php echo baseUrl(); ?>">
	<link rel="stylesheet" href="<? echo baseUrl("templates/default/css/style.css"); ?>" />
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
		<div id="logo"><img src="resize.php?height=100&image=<?php echo urlencode($infoscreen->logo); ?>" alt="<?php echo $infoscreen->title ? $infoscreen->title : "FlatTurtle"; ?>" /></div>
		<?php endif; ?>
	</header>

	<section id="main"></section>
</div>

<script src="<? echo baseUrl("core/underscore.js"); ?>"></script>
<script src="<? echo baseUrl("core/jquery.js"); ?>"></script>
<script src="<? echo baseUrl("core/backbone.js"); ?>"></script>
<script src="<? echo baseUrl("core/turtles.js"); ?>"></script>
<script src="<? echo baseUrl("templates/default/js/jquery.tmpl.js"); ?>"></script>
<script src="<? echo baseUrl("templates/default/js/jquery.textfill.js"); ?>"></script>
<script src="<? echo baseUrl("templates/default/js/turtles.loader.js"); ?>"></script>
<script src="<? echo baseUrl("templates/default/js/interface.js"); ?>"></script>

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
