<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>FlatTurtle</title>
	<base href="<?php echo baseUrl(); ?>">
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/style.css"); ?>" />
	<link rel="stylesheet" href="<?php echo baseUrl("templates/default/css/demo.css"); ?>" />
    <link href="http://fonts.googleapis.com/css?family=Asap:400,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo baseUrl("templates/default/colorpicker/css/colorpicker.css");?>" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo baseUrl("templates/default/colorpicker/js/colorpicker.js");?>"></script>
    <script type="text/javascript" src="<?php echo baseUrl("templates/default/js/jquery.bpopup-0.7.0.min.js");?>"></script>
    <script type="text/javascript" src="<?php echo baseUrl("templates/default/js/google.analytics.js"); ?>"></script>
    <style>
    html{
    }
    body{
        height:100%
    }
    section#main{
        margin-top:10px;
    }
    .container{
        height:100%;
        overflow:auto;
    }
    .color {
        background-color: #2057A7;
    }
    .text-color {
        color: #2057A7;
    }
    footer {
        width: 90%;
        max-width: 960px;
        overflow: hidden;
        margin: 0 auto;
        padding: 0 0 0.55em 0;
        color: #0578bd;
    }
    footer h1 {
        width: 369px;
        height: 89px;
        float: left;
        display: inline;
        background: url(../img/logo_960_1x.gif) no-repeat;
        margin: 0.9em 0 0 1.125%;
    }
    footer h1 img {
        float: left;
        width: 100%;
        max-width: 369px;
    }
    footer h2 {
    position: absolute;
    left: -9999px;
    }
    footer .vcard {
        float: right;
        text-align: right;
        display: inline;
        padding: 1.0em 13.5416667% 0  0;
        font-size: 1.05em;
        font-family: "Soho Gothic W01 Light", sans-serif;
        line-height: .25em;
    }
    footer .vcard .adr {
        padding: 0 0 0.45em 0;
    }
    footer .vcard .adr p:last-child {
        font-size: 1em;
    }
    footer .vcard p:last-child {
        font-size: 1.10em;
    }

    @media screen and (-webkit-min-device-pixel-ratio: 2) {
    footer h1 {
        background-image: url(../img/logo_960_2x.gif);
        -webkit-background-size: 369px 89px;
        background-size: 369px 89px;
    }
    }
    @media screen and (max-width: 768px) {
    footer {
        width: 93%;
        max-width: 720px;
    }
    footer h1 {
        margin: 3.55em 0 0.35em 0;
    }
    footer .vcard {
        padding: 4.5625em 0 00;
    }
    }
    #clock {
        color: #fff;
        border-radius: 14px 0 0 14px;
        float: right;
        font-size: 46px;
        font-weight: bold;
        height: 46px;
        line-height: 46px;
        margin-top: 15px;
        padding: 13px 14px 13px 5px;
        text-align: right;
        width: 136px;
        z-index: 0;
        font-family:'FreeUniversalRegular';
    }
    @media screen and (max-width: 500px) {
        #colorSelector {
            display: none;
        }
    }
    @media screen and (min-width: 500px) {
        #color {
            display: none;
        }
    }
    #popup{background-color:#fff;border-radius:10px 10px 10px 10px;box-shadow:0 0 25px 5px #999;color:#111;display:none;min-width:450px;padding:25px}
    </style>
</head>
<body>

  <div class="container">
    <header>
      <div id="clock" class="color"><span id="hour">00</span><img src="templates/default/img/colon.gif"><span id="minutes">00</span></div>
      <div id="logo" style="width:50%"><a href="http://demo.flatturtle.com/"><img height="80px" src="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" alt="FlatTurtle" border="0" /></a></div>
    </header>
    <section id="main">
      <br />
	Here you can create your own screen for test purposes.<br/><br />
      <form name="form" action="index.php/api/" method="POST">
        <label>Infoscreen name:</label><br/><input type="text" value="<?php if($mode == "edit") {echo $infoscreen->title;}else{echo "FlatTurtle";} ?>" name="title"/><br/>
        <label>Logo url:</label><br/><input type="text" value="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" name="logo"/><br/>
        <label>Color picker:</label><br/><input id="color" style="" type="text" value="#2057A7" name="color"/>
        <div id="colorSelector" style="height:50px;width:50px;margin-left: auto;margin-right: auto;">
            <div style="height: 100%;width:100%;background-color: #2057A7;border: 1pt solid black"></div>
        </div>
        <!--label>Language</label><br/>--><input type="hidden" value="en" name="lang"/><!--<br/><small>Your language <a href="mailto:support@FlatTurtle.com">not supported?</a></small><br/>-->
        <div>
            <label>Select turtles to be displayed</label><br>
            <table style="margin-left: auto;margin-right: auto;text-align: left">
                
                <tr><td><input type="checkbox" name="turtle[]" value="airport"/><label> airport</label></td>
                <td><input type="checkbox" name="turtle[]" value="delijn"/><label> de lijn</label></td></tr>
                
                <tr><td><input type="checkbox" checked="checked" name="turtle[]" value="map"/><label> map</label></td>
                <td><input type="checkbox" name="turtle[]" value="mivbstib"/><label> mivbstib</label></td></tr>
                
                <tr><td><input type="checkbox" name="turtle[]" value="news"/><label> news</label></td>
                <td><input type="checkbox" checked="checked" name="turtle[]" value="nmbs"/><label> nmbs</label></td></tr>
                
                <tr><td><input type="checkbox" name="turtle[]" value="ttshuttles"/><label> company shuttle</label></td>
                <td><input type="checkbox" name="turtle[]" value="twitter"/><label> twitter</label></td></tr>
                
                <tr><td><input type="checkbox" name="turtle[]" value="villo"/><label> villo</label></td>
                <td><input type="checkbox" name="turtle[]" value="velo"/><label> vélo</label></td></tr>
            
            </table>
        </div>
        <div id ="popup" style="display:none;left:550px;position: absolute;top 351px">
            <div style="text-align: center">
                <div>
                    <b>This demo is only supported on Google Chrome.</b>
                </div>
            </div>
        </div>
	<div><br />Clicking the button below will create a unique link you can use to share your creation with other people.<br /></div>
        <div>
        <!-- Add this to the database -->
        <input type="button" onclick="javascript:saveAll()" id="submitbtn" value="Experience your display"/><br/><small><br />(Warning: This is only a simulation. It does not use real-time data. For real-time data you need a set-top box which you can order at <a href="http://flatturtle.com#slideshow">FlatTurtle.com</a>).<br/>For a better demo experience, use <a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Google Chrome</a> and press F-11 or CMD-Shift-F</small>
        </div>
      </form>

    </section>
    <footer>
      <h1><img src="http://flatturtle.com/themes/site/img/logo_320_2x.gif" alt="Flat Turtle"></h1>
      <h2>Data &gt; Info &gt;&gt; Comfort</h2>
        <section id="company_address" class="vcard">
        <p class="fn org">sprl FlatTurtle bvba</p>
          <div class="adr">
          <p class="street-address">Avenue du Port 86c - 18 Havenlaan</p>
          <p><span class="postal-code">1000</span> <span class="locality">Brussels</span> - <span class="country-name">Belgium</span></p>
          </div>
        <p>BTW/VAT BE 0445 781 910</p>
        </section>
     </footer>
    
  </div>
  
<script>
    $('#color').live('change',function() {
      console.log('Handler for .change() called.');
    });
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
        //form.submit();
        if($.browser.msie || $.browser.opera){
            $('#popup').bPopup();
        }
        else form.submit();
        
    }
    
    function refresh() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();

        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;

        $("#hour").html(hours);
        $("#minutes").html(minutes);
    }
    var timer = window.setInterval(refresh, 500);
var infoScreen = "";
var turtles = "";
</script>

</body>
</html>
