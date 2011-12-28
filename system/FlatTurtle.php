<?php

define("FT_VERSION", "0.2");

/*
 * ------------------------------------------------------
 *  Load common functions
 * ------------------------------------------------------
 */
require (SYSTEMPATH . "Common.php");

/*
 * ------------------------------------------------------
 *  Custom error handler
 * ------------------------------------------------------
 */
set_error_handler("ExceptionHandler");

/**
 * The main FlatTurtle object
 * @author Jens Segers
 */
class FlatTurtle {
    
    private static $instance;
    private $components = array("Config", "URI", "DB", "Model"); // core components
    

    /**
     * Constructor, bootstrap the framework
     */
    public function __construct() {
        self::$instance = & $this;
        
        // bootstrap the loader
        require (SYSTEMPATH . "Loader.php");
        $this->load = new Loader();
        
        // autoload core components
        foreach ($this->components as $component) {
            $this->load->system($component);
        }
        
        // and final, start the controller
        $this->load->system("Controller");
    }
    
    /**
     * Enables method chaining. Passes the request to the loader object
     * @param string $name
     * @return object
     */
    public function __get($name) {
        return $this->load->$name;
    }
    
    /**
     * Returns the static object
     * @return FlatTurtle
     */
    public static function &getInstance() {
        return self::$instance;
    }
}

// create the static object
$ft = new FlatTurtle();

function &getInstance() {
    return FlatTurtle::getInstance();
}