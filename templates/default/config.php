<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>FlatTurtle</title>
	<base href="<?php echo baseUrl(); ?>">
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/style.css"); ?>" />
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/demo.css"); ?>" />
    <link href="http://fonts.googleapis.com/css?family=Asap:400,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo baseUrl("templates/default/colorpicker/css/colorpicker.css");?>" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo baseUrl("templates/default/colorpicker/js/colorpicker.js");?>"></script>
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
      <form name="form" action="index.php/api/" method="POST">
        <label>Infoscreen name</label><br/><input type="text" value="<?php if($mode == "edit") {echo $infoscreen->title;}else{echo "FlatTurtle";} ?>" name="title"/><br/>
        <label>Logo url</label><br/><input type="text" value="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" name="logo"/><br/>
        <label>Color</label><br/><input id="color" style="display:none" type="text" value="#2057A7" name="color"/>
        <div id="colorSelector" style="height:50px;width:50px;display: block;margin-left: auto;margin-right: auto;">
            <div style="height: 100%;width:100%;background-color: #2057A7;border: 1pt solid black"></div>
        </div>
        <!--label>Language</label><br/>--><input type="hidden" value="en" name="lang"/><!--<br/><small>Your language <a href="mailto:support@FlatTurtle.com">not supported?</a></small><br/>-->
        <div>
            <label>Select turtles to be displayed</label><br>
            <input type="checkbox" name="turtle[]" value="airport"/><label> airport</label><br>
            <input type="checkbox" name="turtle[]" value="delijn"/><label> de lijn</label><br>
            <input type="checkbox" name="turtle[]" value="map"/><label> map</label><br>
            <input type="checkbox" name="turtle[]" value="mivbstib"/><label> mivbstib</label><br>
            <input type="checkbox" name="turtle[]" value="news"/><label> news</label><br>
            <input type="checkbox" name="turtle[]" value="nmbs"/><label> nmbs</label><br>
            <input type="checkbox" name="turtle[]" value="ttshuttles"/><label> ttshuttles</label><br>
            <input type="checkbox" name="turtle[]" value="twitter"/><label> twitter</label><br>
            <input type="checkbox" name="turtle[]" value="villo"/><label> villo</label><br>
        </div>
        
        <div>
        <!-- Add this to the database -->
        <input type="button" onclick="javascript:saveAll()" id="submitbtn" value="Experience your display"/><br/><small>(! Warning: This is only a simulation. It does not use real-time data. For real-time data you need a set-top box which you can order at <a href="http://flatturtle.com#sales">FlatTurtle.com</a>).<br/>For a better demo experience, press f11 or cmd-shift-F</small>
        </div>
      </form>
    </section>
  </div>
<script>
    $('#colorSelector').ColorPicker({
        color: '#0000ff',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('#colorSelector div').css('backgroundColor', '#' + hex);
            $('#color').val('#'+hex);
        }
    });
    function saveAll(){
        form.submit();
    }
var infoScreen = "";
var turtles = "";
</script>

</body>
</html>
