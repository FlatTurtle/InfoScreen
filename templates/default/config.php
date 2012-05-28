<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>FlatTurtle</title>
	<base href="<?php echo baseUrl(); ?>">
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/style.css"); ?>" />
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/demo.css"); ?>" />
        <link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>

	<style>
		.color { background-color: #2057A7; }
                .text-color { color: #2057A7;}	
	</style>
</head>
<body>

  <div class="container">
    <header>
      <div id="clock" class="color"><span id="clockhours"><?php echo $mode; ?></span></div>
      <div id="logo"><img height="80px" src="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" alt="FlatTurtle" /></div>
    </header>
    <section id="main">
      Over here you can create your own screen for test purposes.<br/>
      <form name="form" action="api/" method="POST">
        <label>Infoscreen name</label><br/><input type="text" value="<?php if($mode == "edit") {echo $infoscreen->title;}else{echo "FlatTurtle";} ?>" name="title"/><br/>
        <label>Logo url</label><br/><input type="text" value="http://" name="logo"/><br/>
        <label>Color</label><br/><input type="text" value="#" name="color"/><br/>
        <label>Language</label><br/><input type="text" value="en" name="lang"/><br/><small>Your language <a href="mailto:support@FlatTurtle.com">not supported?</a></small><br/>
        <!-- Dynamically add Turtles from here -->

        <!-- Add this to the database -->
        <input type="button" onclick="javascript:saveAll()" id="submitbtn" value="Experience your display"/><br/><small>(Press f11 or cmd-F for a better simulation)</small>
        
      </form>
    </section>
  </div>
<script src="<?php echo baseUrl("core/core.min.js"); ?>"></script>
<script>
function saveAll(){
form.submit();
}
var infoScreen = "";
var turtles = "";
</script>

</body>
</html>
