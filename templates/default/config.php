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
    <script type="text/javascript" src="<?php echo baseUrl("templates/default/js/jquery.bpopup-0.7.0.min.js");?>"></script>
    <style>
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
        padding: 0 0 3.55em 0;
        color: #0578bd;
    }
    /* line 1586, ../sass/partials/_page.scss */
    footer h1 {
        width: 369px;
        height: 89px;
        float: left;
        display: inline;
        background: url(../img/logo_960_1x.gif) no-repeat;
        margin: 2.9em 0 0 3.125%;
    }
    /* line 1593, ../sass/partials/_page.scss */
    footer h1 img {
        float: left;
        width: 100%;
        max-width: 369px;
    }
    /* line 1599, ../sass/partials/_page.scss */
    footer h2 {
    position: absolute;
    left: -9999px;
    }
    /* line 1603, ../sass/partials/_page.scss */
    footer .vcard {
        float: right;
        text-align: right;
        display: inline;
        padding: 4.5625em 13.5416667% 0  0;
        font-size: 1.05em;
        font-family: "Soho Gothic W01 Light", sans-serif;
    /* using Soho Gothic W01 Light makes IE8 go to quirks mode on reload */
        line-height: .25em;
    }
    /* line 1612, ../sass/partials/_page.scss */
    footer .vcard .adr {
        padding: 0 0 1.25em 0;
    }
    /* line 1614, ../sass/partials/_page.scss */
    footer .vcard .adr p:last-child {
        font-size: 1em;
    }
    /* line 1618, ../sass/partials/_page.scss */
    footer .vcard p:last-child {
        font-size: 1.10em;
    /* 12/16 */
    }
    
    @media screen and (-webkit-min-device-pixel-ratio: 2) {
    /* line 1627, ../sass/partials/_page.scss */
    footer h1 {
        background-image: url(../img/logo_960_2x.gif);
        -webkit-background-size: 369px 89px;
        background-size: 369px 89px;
    }
    }
    /* tablet */
    @media screen and (max-width: 768px) {
    /* line 1637, ../sass/partials/_page.scss */
    footer {
        width: 93%;
        max-width: 720px;
    }
    /* line 1640, ../sass/partials/_page.scss */
    footer h1 {
        margin: 3.55em 0 3.35em 0;
    }
    /* line 1643, ../sass/partials/_page.scss */
    footer .vcard {
        padding: 4.5625em 0 00;
    }
    }
    #popup{background-color:#fff;border-radius:10px 10px 10px 10px;box-shadow:0 0 25px 5px #999;color:#111;display:none;min-width:450px;padding:25px}
        </style>
</head>
<body>

  <div class="container">
    <header>
      <div id="clock" class="color"><span id="clockhours"><?php echo $mode; ?></span></div>
      <div id="logo"><img height="80px" src="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" alt="FlatTurtle" /></div>
    </header>
    <section id="main">
      <br />
	Here you can create your own screen for test purposes.<br/><br />
      <form name="form" action="index.php/api/" method="POST">
        <label>Infoscreen name:</label><br/><input type="text" value="<?php if($mode == "edit") {echo $infoscreen->title;}else{echo "FlatTurtle";} ?>" name="title"/><br/>
        <label>Logo url:</label><br/><input type="text" value="http://img.flatturtle.com/infoscreen/logos/flatturtle.png" name="logo"/><br/>
        <label>Color picker:</label><br/><input id="color" style="" type="text" value="#2057A7" name="color"/>
        <div id="colorSelector" style="height:50px;width:50px;display: block;margin-left: auto;margin-right: auto;">
            <div style="height: 100%;width:100%;background-color: #2057A7;border: 1pt solid black"></div>
        </div>
        <!--label>Language</label><br/>--><input type="hidden" value="en" name="lang"/><!--<br/><small>Your language <a href="mailto:support@FlatTurtle.com">not supported?</a></small><br/>-->
        <div>
            <label>Select turtles to be displayed</label><br>
            <table style="margin-left: auto;margin-right: auto;text-align: left">
                
                <tr><td><input type="checkbox" name="turtle[]" value="airport"/><label> airport</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="delijn"/><label> de lijn</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="map"/><label> map</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="mivbstib"/><label> mivbstib</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="news"/><label> news</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="nmbs"/><label> nmbs</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="ttshuttles"/><label> company shuttle</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="twitter"/><label> twitter</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="villo"/><label> villo</label><br></td></tr>
                <tr><td><input type="checkbox" name="turtle[]" value="velo"/><label> vélo</label><br></td></tr>
            
            </table>
        </div>
        <div id ="popup" style="display:none;left:550px;position: absolute;top 351px">
            <div style="text-align: center">
                <div>
                    <b>This demo is only supported on Google Chrome.</b>
                </div>
            </div>
        </div>
	<br />
        <div>
        <!-- Add this to the database -->
        <input type="button" onclick="javascript:saveAll()" id="submitbtn" value="Experience your display"/><br/><small>(Warning: This is only a simulation. It does not use real-time data. For real-time data you need a set-top box which you can order at <a href="http://flatturtle.com#slideshow">FlatTurtle.com</a>).<br/>For a better demo experience, use <a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Google Chrome</a> and press F-11 or CMD-Shift-F</small>
        </div>
      </form>

    </section>
<br />
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
var infoScreen = "";
var turtles = "";
</script>

</body>
</html>
