<?php

/**
 * Controller class
 * @author Jens Segers
 */
class Controller {
    
    /**
     * Constructor, decides which infoscreen and turtles to be loaded
     */
    public function __construct() {
        // get infoscreen alias from uri
        if (!$alias = $this->uri->segment(1)) {
            $alias = $this->config->item("default_infoscreen");
        }
        
        // load infoscreen model
        $this->load->model("Infoscreen");
        
        // get infoscreen information
        if (!$infoscreen = $this->infoscreen->get($alias)) {
            showError("Infoscreen was not found");
        }
        
        // get turtles
        $turtles = $this->infoscreen->turtles($infoscreen->id);
        
        // render the infoscreen
        $template = "templates/" . $this->config->item("default_template") . "/index.php";
        $this->load->view($template, array("infoscreen" => $infoscreen, "turtles" => $turtles));
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