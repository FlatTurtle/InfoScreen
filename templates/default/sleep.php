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
            Dear <?php echo $alias; ?>,<br/>
	    Your turtle is currently fast asleep.<br/>
	  </h1>
          <h2>Zzzz. Zz. Zzz zz.</h2>
	  <footer align="center">
	    <div align="center">
	      &copy; 2012 FlatTurtle bvba<br/>
	      tel: +32 (0) 2 669 1001<br/>
              web: http://flatturtle.com<br/>
	      e-mail: info@flatturtle.com
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
             echo "          var jobs = cronJobs(".json_encode($jobs).");\n";
          ?>
        </script>

  </body>
</html>
