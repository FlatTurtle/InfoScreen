<?php

class Loader {
    
    private $loaded = array();
    
    public function __get($name) {
        if (isset($this->loaded[$name]))
            return $this->loaded[$name];
    }
    
    public function library($class, $params = null) {
        return $this->load($class, "libraries", $params);
    }
    
    public function model($class, $params = null) {
        return $this->load($class, "models", $params);
    }
    
    public function load($class, $folder, $params = null) {        
        $class = str_replace('.php', '', trim($class));
        $location = $folder . "/" . $class . ".php";
        
        if (!isset($this->loaded[$class]) && file_exists($location)) {
            include_once ($location);
            
            if (class_exists($class)) {
                return $this->loaded[$class] = new $class($params);
            }
        }
        return null;
    }

}