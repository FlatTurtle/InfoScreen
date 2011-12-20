<?php

    define('FT_VERSION', '0.1');

/*
 * ------------------------------------------------------
 *  Load common functions
 * ------------------------------------------------------
 */
    require_once (SYSTEMPATH . "common.php");

/*
 * ------------------------------------------------------
 *  Custom error handler
 * ------------------------------------------------------
 */
    set_error_handler('_exception_handler');

/**
 * The main FlatTurtle object
 * @author Jens Segers
 */
class FlatTurtle {
    
    private static $instance;
    private $components = array("config", "uri", "db", "model");
    
    public function __construct() {
        // singleton
        self::$instance = & $this;
        
        // bootstrap the loader
        include_once (SYSTEMPATH . "loader.php");
        $this->load = new Loader();
        
        // autoload components
        foreach ($this->components as $component)
            $this->load->system($component);
            
        /*
         * ------------------------------------------------------
         *  TODO: detect customer, load settings and display
         * ------------------------------------------------------
         */
        $template = BASEPATH . "templates/" . $this->config->item("default_template") . "/index.php";
        
        if (file_exists($template))
            include ($template);
        else
            show_error("The template file " . $template . " was not found.");
    }
    
    public function __get($name) {
        // pass request to loader since they are storred there
        return $this->load->$name;
    }
    
    public static function &get_instance() {
        return self::$instance;
    }
}

// create the static object
$ft = new FlatTurtle();

function &get_instance() {
    return FlatTurtle::get_instance();
}