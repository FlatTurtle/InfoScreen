<?php

define('FT_VERSION', '0.2');

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
set_error_handler('ExceptionHandler');

/**
 * The main FlatTurtle object
 * @author Jens Segers
 */
class FlatTurtle {
    
    private static $instance;
    private $components = array("Config", "URI", "DB", "Model");
    
    /**
     * Constructor, bootstrap the framework
     */
    public function __construct() {
        self::$instance = & $this;
        
        // bootstrap the loader
        require (SYSTEMPATH . "Loader.php");
        $this->load = new Loader();
        
        // autoload components
        foreach ($this->components as $component) {
            $this->load->system($component);
        }
        
        /*
         * ------------------------------------------------------
         *  TODO: detect customer, load settings and display
         * ------------------------------------------------------
         */
        $template = BASEPATH . "templates/" . $this->config->item("default_template") . "/index.php";
        
        if (file_exists($template)) {
            include ($template);
        } else {
            showError("The template file " . $template . " was not found.");
        }
    }
    
    /**
     * Enables method chaining. Passes the request to the loader object
     * @param string $name
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