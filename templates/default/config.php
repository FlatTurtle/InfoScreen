<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>FlatTurtle</title>
	<base href="<?php echo baseUrl(); ?>">
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/style.css"); ?>" />
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/demo.css"); ?>" />
    <link href="http://fonts.googleapis.com/css?family=Asap:400,700" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
        <label>Logo url</label><br/><input type="text" value="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" name="logo"/><br/>
        <label>Color</label><br/><input id="color" type="text" value="#2057A7" name="color"/><br/>
        <!--label>Language</label><br/>--><input type="hidden" value="en" name="lang"/><!--<br/><small>Your language <a href="mailto:support@FlatTurtle.com">not supported?</a></small><br/>-->
        <!-- Dynamically add Turtles from here -->
        <input type="button" value="(+) add turtle (+)" onClick="addForm()"/>
        <div id="turtles">
          <span class="clearfix"></span>
        </div>
        <div>
        <!-- Add this to the database -->
        <input type="button" onclick="javascript:saveAll()" id="submitbtn" value="Experience your display"/><br/><small>(! Warning: This is only a simulation. It does not use real-time data. For real-time data you need a set-top box which you can order at <a href="http://flatturtle.com#sales">FlatTurtle.com</a>).<br/>For a better demo experience, press f11 or cmd-shift-F</small>
        </div>
      </form>
    </section>
  </div>
<script>
    function saveAll(){
        form.submit();
    }
    var turtlenr = 0;
    function addForm(){
        $("#turtles").prepend("<div class='turtlecontainer' id='turtle" + turtlenr +"'>\
<select name='turtle'> \
  <option value='NMBS' >NMBS/SNCB</option>\
  <option value='MIVBSTIB' >MIVB/STIB</option>\
  <option value='Airport' >Airport</option>\
</select><br/><label>Location:</label><input type='text' value='Brussel North'/><br/><input type='button' value='(-) Delete turtle (-)' onclick='javascript:deleteTurtle(" + turtlenr + ");'/></div>");
        turtlenr++;
    }
    function deleteTurtle(number){
        $("#turtle" + number).remove();
    }
var infoScreen = "";
var turtles = "";
</script>

</body>
</html>
