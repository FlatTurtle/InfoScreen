<?php  

error_reporting(E_ALL);
ini_set('display_errors', '1');

// fire up the turtles!
require("libraries/FlatTurtle.php");

$ft = &get_instance();

$template = $ft->config->item("template");
include("templates/".$template."/index.php");