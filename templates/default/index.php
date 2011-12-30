<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $infoscreen->title ? $infoscreen->title : "FlatTurtle"; ?></title>
    <base href="<?php echo baseUrl(); ?>">
    <link rel="stylesheet" href="templates/default/css/style.css" />
    
    <style type="text/css">
    .color { background-color: <?php echo $infoscreen->color ? $infoscreen->color : "#FB8B1A"; ?>; }
    </style>
</head>
<body>

<div class="container">
	<header>
		<div id="clock" class="color"></div>
		<?php if($infoscreen->logo): ?>
		<div id="logo"><img src="<?php echo $infoscreen->logo; ?>" /></div>
		<?php endif; ?>
	</header>

	<section id="main"></section>
</div>

<script type="text/javascript" src="core/underscore.js"></script>
<script type="text/javascript" src="core/jquery.js"></script>
<script type="text/javascript" src="core/backbone.js"></script>
<script type="text/javascript" src="core/turtles.js"></script>
<script type="text/javascript" src="templates/default/js/jquery.tmpl.js"></script>
<script type="text/javascript" src="templates/default/js/loader.js"></script>
<script type="text/javascript" src="templates/default/js/interface.js"></script>

<script type="text/javascript">
<?php
foreach($turtles as $turtle)
	echo '	Turtles.grow("'.$turtle->module.'", '.json_encode($turtle->options)."); \n";
?>
</script>

</body>
</html>
