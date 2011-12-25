<?php

/**
 * This class contains is used to load other system components and provides access by method chaining
 * @author Jens Segers
 */
class Loader {
    
    // used to store an object of each loaded class
    private $loaded = array();
    
    public function __get($name) {
        if (isset($this->loaded[$name]))
            return $this->loaded[$name];
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
                return $this->loaded[$class] = new $class($params);
        }
        return null;
    }

}