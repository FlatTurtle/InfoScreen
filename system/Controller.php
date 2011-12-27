<?php

/**
 * Controller class
 * @author Jens Segers
 */
class Controller {
    
    /**
     * Constructor, decides which template to load
     */
    public function __construct() {
        $template = BASEPATH . "templates/" . $this->config->item("default_template") . "/index.php";
        
        if (file_exists($template)) {
            include ($template);
        } else {
            showError("The template file " . $template . " was not found.");
        }
    }
    
	/**
     * Provides easy access to the main object
     * @param string $name
     * @return object
     */
    function __get($name) {
        $ft = &getInstance();
        return $ft->$name;
    }
    
}