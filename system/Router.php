<?php

class Router {
    
    public $directory;
    public $class;
    public $method;
    public $default_controller;
    
    private $ci;
    
    public function __construct() {
        // get the default controller from config
        $this->ci = &getInstance();
        $this->default_controller = $this->ci->config->item("default_controller");
    }
    
    public function route() {
        // detect controller from uri
        $segments = $this->ci->uri->segmentArray();
        
        // set starting directory
        $this->directory = SYSTEMPATH . 'controllers/';
        
        // default controller is requested
        if (count($segments) == 0) {
            $this->class = $this->default_controller;
            $this->method = 'index';
            return array_slice($segments, 1);
        }
        
        // check if controller exists
        if (file_exists($this->directory . $segments[1] . '.php')) {
            $this->class = $segments[1];
            $this->method = isset($segments[2]) ? $segments[2] : 'index';
            return TRUE;
        }
        
        // detect controller in sub-directory
        if (is_dir($this->directory . $segments[1])) {
            // remove directory from segments
            $this->directory .= $segments[1] . '/';
            $segments = array_slice($segments, 1);
            
            if (count($segments) > 0) {
                // a controller from sub directory is requested
                if (file_exists($this->directory . $segments[1] . '.php')) {
                    $this->class = $segments[1];
                    $this->method = isset($segments[2]) ? $segments[2] : 'index';
                    return TRUE;
                }
            } else {
                // load default controller from sub directory
                if (file_exists($this->directory . $this->default_controller . '.php')) {
                    $this->class = $this->default_controller;
                    $this->method = 'index';
                    return TRUE;
                }
            }
        }
        
        // controller not found
        return FALSE;
    }

}