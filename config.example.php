<?php

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| Your base URL with a trailing slash. If this is not set then we will
| guess the protocol, domain and path to your installation.
*/
$config["base_url"] = "";


/*
|--------------------------------------------------------------------------
| Infoscreen settings
|--------------------------------------------------------------------------
|
| The alias of the default infoscreen when no alias is given. And the
| folder name of the template to use.
*/
$config["default_infoscreen"] = "demo";
$config["default_template"] = "default";


/*
|--------------------------------------------------------------------------
| Turtle settings
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| turtles/ folder. Use a relative path.
*/
$config["turtle_path"] = "";


/*
| -------------------------------------------------------------------
| Database connectivity settings
| -------------------------------------------------------------------
| The database settings needed to access your database.
|
|	["hostname"] The hostname of your database server.
|	["username"] The username used to connect to the database
|	["password"] The password used to connect to the database
|	["database"] The name of the database you want to connect to
|	["port"]     The port used to connect to the database
*/
$config["database"]["hostname"] = "localhost";
$config["database"]["username"] = "flatturtle";
$config["database"]["password"] = "password";
$config["database"]["database"] = "flatturtle";
$config["database"]["port"] = "";

/*
|--------------------------------------------------------------------------
| Google Analytics
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to use Google Analytics
| Insert the *whole* JS line in one single line for this to work
*/
$config["google_analytics"] = "";

// EOF
?>
