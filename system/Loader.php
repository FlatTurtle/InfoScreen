<?php

/**
 * This class contains is used to load other system components and provides access by method chaining
 * @author Jens Segers
 */
class Loader {
    
    private $loaded = array();
    
    /**
     * Enables method chaining, returns a loaded class
     * @param string $name
     * @return object
     */
    public function __get($name) {
        if (isset($this->loaded[strtolower($name)])) {
            return $this->loaded[strtolower($name)];
        }
    }
    
    /**
     * Load a system component located in the system directory, display an error message if the class or file is not found
     * @param sting $class
     * @param array $params
     * @return object
     */
    public function system($class, $params = null) {
        return $this->load($class, SYSTEMPATH, $params);
    }
    
    /**
     * Load a model class located in the system/models directory, display an error message if the class or file is not found
     * @param string $class
     * @param array $params
     * @return object
     */
    public function model($class, $params = null) {
        return $this->load($class, SYSTEMPATH . "models", $params);
    }
    
    /**
     * Load any class, display an error message if the class or file is not found
     * @param string $class
     * @param string $folder
     * @param array $params
     * @return object
     */
    public function load($class, $folder, $params = null) {
        $class = str_replace('.php', '', trim($class));
        $location = $folder . "/" . $class . ".php";
        
        if (!isset($this->loaded[$class]) && file_exists($location)) {
            include_once ($location);
            
            if (class_exists($class)) {
                return $this->loaded[strtolower($class)] = new $class($params);
            }
        } else {
            showError("Unable to load the requested class: " . $class);
        }
        
        return null;
    }
    
    /**
     * Check if a component is already loaded
     * @param string $class
     */
    public function isLoaded($class) {
        return isset($this->loaded[strtolower($class)]);
    }

}