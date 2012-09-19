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
if (isset($_SERVER['PLATFORM']) && $_SERVER['PLATFORM'] == 'PAGODABOX') {
    $config["database"]["hostname"] = $_SERVER['DB1_HOST'];
    $config["database"]["username"] = $_SERVER['DB1_USER'];
    $config["database"]["password"] = $_SERVER['DB1_PASS'];
    $config["database"]["database"] = $_SERVER['DB1_NAME'];
    $config["database"]["port"] = "";
} elseif (isset($_SERVER['PLATFORM']) && $_SERVER['PLATFORM'] == 'TESTING') {
    $config["database"]["hostname"] = $_SERVER['AMADEUS_HOST'];
    $config["database"]["username"] = $_SERVER['AMADEUS_USER'];
    $config["database"]["password"] = $_SERVER['AMADEUS_PASS'];
    $config["database"]["database"] = $_SERVER['AMADEUS_NAME'];
    $config["database"]["port"] = $_SERVER['AMADEUS_PORT'];
}

/*
|--------------------------------------------------------------------------
| Google Analytics
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to use Google Analytics
| Insert the *whole* JS line in one single line for this to work
*/
$config["google_analytics"] = '<script type="text/javascript">var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-31282630-1"]);_gaq.push(["_setDomainName","flatturtle.com"]);_gaq.push(["_trackPageview"]);(function(){var a=document.createElement("script");a.type="text/javascript";a.async=true;a.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})()</script>';

// EOF
?>
