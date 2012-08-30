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
        $secondargument = $this->uri->segment(2)?$this->uri->segment(2):"";

        // get infoscreen alias from uri
        if (!$referencenumber = $this->uri->segment(1)) {
            $this->load->view("templates/" . $this->config->item("default_template") . "/config.php", array("mode"=>"New"));
            exit(0);
        }

        // load infoscreen model
        $this->load->model("Demo");
        
        if($referencenumber == "api"){
            //we have to deal with a post request
            $referencenumber = $secondargument;
            if($referencenumber == ""){
                //create new one
                $referencenumber = $this->demo->add($_POST);
                if(array_key_exists("turtle", $_POST)) $needed_turtles = $_POST["turtle"];
                else $needed_turtles = array();
                //header("Location: ../" . $referencenumber);
                //get turtles
                $infoscreen = $this->demo->get($referencenumber);
                $turtles = $this->demo->turtles($referencenumber,$needed_turtles);
                $template = "templates/" . $this->config->item("default_template") . "/index.php";
                $this->load->view($template, array("infoscreen" => $infoscreen, "turtles" => $turtles));
                
            }else if($this->uri->segment(3) == "export"){
                //export into a json string
                if (!$infoscreen = $this->demo->get($referencenumber)) {
                    header("location: ../");
                }else{
                    echo(json_encode($infoscreen));
                }
            }else{
                //update existing one
                $this->demo->update($referencenumber, $_POST);
            }
            exit(0);
        }

        // get infoscreen information
        if (!$infoscreen = $this->demo->get($referencenumber)) {
            header("location: ../");
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
