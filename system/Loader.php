<?php

/**
 * This class contains is used to load other system components and provides access by method chaining
 * @author Jens Segers
 */
class Loader {
    
    // used to store an object of each loaded class
    private $loaded = array();
    
    public function __get($name) {
        if (isset($this->loaded[strtolower($name)]))
            return $this->loaded[strtolower($name)];
    }
    
    public function system($class, $params = null) {
        return $this->load($class, SYSTEMPATH, $params);
    }
    
    public function model($class, $params = null) {
        return $this->load($class, SYSTEMPATH . "models", $params);
    }
    
    public function load($class, $folder, $params = null) {
        $class = str_replace('.php', '', trim($class));
        $location = $folder . "/" . $class . ".php";
        
        // only load 1 time
        if (!isset($this->loaded[$class]) && file_exists($location)) {
            include_once ($location);
            
            if (class_exists($class))
                return $this->loaded[strtolower($class)] = new $class($params);
        }
        else
            show_error("Unable to load the requested class: ".$class);
        
        return null;
    }
    
    public function is_loaded($class) {
        return isset($this->loaded[strtolower($class)]);
    }

}