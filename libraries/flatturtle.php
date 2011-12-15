<?php

define('FT_VERSION', '0.1');

class FlatTurtle {
    
    private static $instance;
    
    private $autoload = array("config", "db");
    private $loaded = array();
    
    public function __construct() {
        self::$instance = & $this;
        
        foreach ($this->autoload as $library)
            $this->load($library);
    }
    
    public function load($class) {
        $class = str_replace('.php', '', trim($class, '/'));
        $location = "libraries/" . $class . ".php";
        
        if (!isset($this->loaded[$class]) && file_exists($location)) {
            include_once ($location);
            
            if (class_exists($class)) {
                $this->{$class} = new $class();
                $this->loaded[$class] = true;
                
                return true;
            }
        }
        return false;
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