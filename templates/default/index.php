<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $infoscreen->title; ?></title>
<link rel="stylesheet" href="templates/default/style.css" />

<style type="text/css">
.color { background-color: <?php echo $infoscreen->color; ?>; }
</style>

</head>
<body>

<div class="container">
	<header>
		<div id="clock" class="color"></div>
		<img src="<?php echo $infoscreen->logo; ?>" />
	</header>

	<div id="main"></div>
	
</div>

<script type="text/javascript" src="core/underscore.js"></script>
<script type="text/javascript" src="core/jquery.js"></script>
<script type="text/javascript" src="core/backbone.js"></script>
<script type="text/javascript" src="core/jquery.tmpl.js"></script>
<script type="text/javascript" src="core/turtles.js"></script>
<script type="text/javascript" src="templates/default/loader.js"></script>
<script type="text/javascript" src="templates/default/interface.js"></script>

<script type="text/javascript">
<?php
foreach($turtles as $turtle)
	echo 'Turtles.grow("'.$turtle->module.'", '.json_encode($turtle->options)."); \n";
?>
</script>

</body>
</html>
