<?php

/**
 * This class contains functions that enable config files to be managed.
 * @author Jens Segers
 */
class Config {
    
    private $config = array();
    
    public function __construct() {
        $this->load("config");
    }
    
    public function load($file = '') {
        $file = ($file == '') ? 'config' : str_replace('.php', '', $file);
        $file_path = BASEPATH . $file . '.php';
        
        if (file_exists($file_path)) {
            include ($file_path);
            
            if (isset($config) && is_array($config)) {
                $this->config = array_merge($this->config, $config);
                unset($config);
                
                return true;
            }
        } else
            show_error("Configuration file was not found.");
    }
    
    public function item($item) {
        if (isset($this->config[$item]))
            return $this->config[$item];
        
        return false;
    }
    
    public function set_item($item, $value) {
        $this->config[$item] = $value;
    }

}