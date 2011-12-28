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
        return $this->loadClass($class, SYSTEMPATH, $params);
    }
    
    /**
     * Load a model class located in the system/models directory, display an error message if the class or file is not found
     * @param string $class
     * @param array $params
     * @return object
     */
    public function model($class, $params = null) {
        return $this->loadClass($class, SYSTEMPATH . "models", $params);
    }
    
    /**
     * Alias function for load, include a view file with optional parameters
     * @param string $file
     * @param array $params
     * @param bool $return
     */
    public function view($file, $params = null, $return = FALSE) {
        $this->load($file, $params);
    }
    
    /**
     * Load any file, display an error message if the class or file is not found
     * @param string $file
     * @param array $params
     * @param bool $return
     * @return string
     */
    public function load($file, $params = null, $return = FALSE) {
        if (!file_exists($file)) {
            showError("Unable to load the requested file: " . $file);
        }
        
        // import variables from an array into the current symbol table.
        if ($params)
            extract($params);
        
        ob_start();
        include ($file);
        
        if ($return === TRUE) {
            $buffer = ob_get_contents();
            @ob_end_clean();
            return $buffer;
        }
        
        ob_end_flush();
    }
    
    /**
     * Load any class and create one object, display an error message if the class or file is not found
     * @param string $class
     * @param string $folder
     * @param array $params
     * @return object
     */
    public function loadClass($class, $folder, $params = null) {
        $class = str_replace(".php", "", trim($class));
        $location = $folder . "/" . $class . ".php";
        
        if ($this->isLoaded($class)) {
            return $this->loaded[strtolower($class)];
        } elseif (file_exists($location)) {
            include_once ($location);
            
            if (class_exists($class)) {
                return $this->loaded[strtolower($class)] = new $class($params);
            } else {
                showError("Unable to load the requested class: " . $class);
            }
        } else {
            showError("Unable to locate the requested class: " . $class);
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