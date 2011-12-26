<?php

/**
 * The Config class provides a means to retrieve configuration preferences. These preferences can come from the default config file (config.php) or from your own custom config files.
 * @author Jens Segers
 */
class Config {
    
    private $config = array();
    
    /**
     * Constructor, will load the default config.php file.
     */
    public function __construct() {
        $this->load("config");
    }
    
    /**
     * Load a custom config file
     * @param string $file
     * @return boolean
     */
    public function load($file = '') {
        $file = ($file == '') ? "config" : str_replace(".php", "", $file);
        $file_path = BASEPATH . $file . ".php";
        
        if (file_exists($file_path)) {
            include ($file_path);
            
            if (isset($config) && is_array($config)) {
                $this->config = array_merge($this->config, $config);
                unset($config);
                
                return TRUE;
            }
        } else {
            showError("Configuration file was not found.");
        }
    }
    
    /**
     * Retrieve an item from the config, returns FALSE when the item does not exist
     * @param string $item
     * @return mixed
     */
    public function item($item) {
        if (isset($this->config[$item])) {
            return $this->config[$item];
        }
        
        return FALSE;
    }
    
    /**
     * Dynamically set a config item or change an existing one
     * @param string $item
     * @param mixed $value
     */
    public function set($item, $value) {
        $this->config[$item] = $value;
    }

}