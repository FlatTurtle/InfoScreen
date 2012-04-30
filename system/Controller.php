<?php

/**
 * Controller class
 * @author Jens Segers
 * @author Pieter Colpaert
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

        $secondargument = $this->uri->segment(2)?$this->uri->segment(2):"";

        // load infoscreen model
        $this->load->model("Infoscreen");
        
        // get infoscreen information
        if (!$infoscreen = $this->infoscreen->get($alias)) {
            showError("Infoscreen was not found");
        }
        
        // get cron jobs needed to be run by javascript
        $jobs = $this->infoscreen->jobs($infoscreen->id);
        
        if($secondargument == "sleep"){
            //Your infoscreen is sleeping. Only a splash screen will be shown, but the jobs remain scheduled
            $template = "templates/" . $this->config->item("default_template") . "/sleep.php";
            $this->load->view($template, array("alias" => $alias,"infoscreen" => $infoscreen, "jobs" => $this->infoscreen->jobs($infoscreen->id)));
        }else{
            //get turtles
            $turtles = $this->infoscreen->turtles($infoscreen->id);
            // render the infoscreen
            $template = "templates/" . $this->config->item("default_template") . "/index.php";
            $this->load->view($template, array("infoscreen" => $infoscreen, "turtles" => $turtles, "jobs" => $jobs));
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