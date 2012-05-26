<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>FlatTurtle</title>
    <!-- If you're checking out the code and you like what you see at the base uri, you might be interested in a job with us. Contact jobs@flatturtle.com if you're interested! -->
    <base href="<?php echo baseUrl(); ?>">
    <link rel="stylesheet" href="templates/default/css/style.css" />
    <style>
      .color { background-color: #2057A7; }
    </style>
  </head>
  <body>

    <div class="container">
      <section id="main" align="center">
	<div align="center">
	  <a href="http://www.flatturtle.com/">
	    <img border=0 src="http://img.flatturtle.com/flatturtle/logo/FlatTurtle-slogan.png" alt="FlatTurtle.com" />
	  </a>
	  <h1>
	    Your screen is currently asleep.<br/>
	  </h1>
        <!-- dirty inline css.. to fix -->
          <span style="color:#2457A7;">Debug information</span>: <br />
          enableScreen(false); <br /><br />

          <span style="color:#2457A7;">Human readable information</span>: <br />
          The Display is turned off at a set time, and this error page is displayed.<br />
          If you can see this error page, it means the display did not correctly turn off.<br />
          Please get in touch with the FlatTurtle helpdesk.<br /><br /><br />
          <footer align="center">
            <div align="center">
              helpdesk: <span style="color:#0C78BE;">+32 (0) 2 669 09 99</span><br/>
              e-mail: <span style="color:#0C78BE;">help@flatturtle.com</span><br />
              web: <span style="color:#0C78BE;">http://flatturtle.com</span><br/>
              &copy; <?php echo date('Y'); ?> FlatTurtle<br/>
            </div>
          </footer>
        </div>


        <script src="core/underscore.js"></script>
        <script src="core/jquery.js"></script>
        <script src="core/backbone.js"></script>
        <script src="core/jobs.js"></script>
        <script src="templates/default/js/jquery.tmpl.js"></script>
        <script src="templates/default/js/later.min.js"></script>
        <script>
          <?php
             // infoscreen
             echo "          var infoScreen = ".json_encode($infoscreen).";\n";
             echo "          var jobs = cronJobs(".json_encode($jobs).");\n";
          ?>
        </script>

  </body>
</html>
