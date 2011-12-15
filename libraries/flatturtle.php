<?php

define('FT_VERSION', '0.1');

class FlatTurtle {
    
    private static $instance;
    private $autoload = array("config", "db", "model");
    
    public function __construct() {
        self::$instance = & $this;
        
        // initialize the loader
        include_once("libraries/Loader.php");
        $this->load = new Loader();
        
        foreach ($this->autoload as $library)
            $this->load->library($library);
    }
    
    public function __get($name) {
        if($obj = $this->load->{$name})
            return $obj;
    }
    
    public static function &get_instance() {
        if(!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }
}

function &get_instance() {
    return FlatTurtle::get_instance();
}