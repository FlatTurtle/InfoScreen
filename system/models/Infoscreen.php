<?php

/**
 * The Infoscreen model class
 * @author Jens
 */
class Infoscreen extends Model {
    
    /**
     * Get infoscreen information from the database
     * @param string $alias
     * @return object
     */
    function get($alias) {
        $query = $this->db->query("SELECT * FROM infoscreens WHERE alias = ? LIMIT 0,1", array($alias));
        return $query->row();
    }
    
    /**
     * Get all turtles of an infoscreen
     * @param int $infoscreen_id
     * @return array
     */
    function turtles($infoscreen_id) {
        $query = $this->db->query("SELECT * FROM turtles WHERE infoscreen_id = ? ORDER BY CASE WHEN `order`<0 THEN id ELSE `order` END ASC", $infoscreen_id);
        $turtles = $query->result();
        
        // default turtle path location
        $turtle_path = $this->config->item("turtle_path");
        if (!$turtle_path)
            $turtle_path = "turtles/";
        
        foreach ($turtles as &$turtle) {
            // set the turtle source location
            if (!$turtle->source) {
                $turtle->source = baseUrl($turtle_path . $turtle->module . "/" . $turtle->module . ".js");
            }
            
            // standard options
            $turtle->options = array("id" => $turtle->id, "colspan" => $turtle->colspan, "group" => $turtle->group, "source" => $turtle->source);
            
            // optional options
            $options = $this->turtleOptions($turtle->id);
            foreach ($options as $option) {
                // if multiple options are found with the same name they are storred in an array
                if (isset($turtle->options[$option->key])) {
                    if (is_array($turtle->options[$option->key])) {
                        $turtle->options[$option->key][] = $option->value;
                    } else {
                        $turtle->options[$option->key] = array($turtle->options[$option->key], $option->value);
                    }
                } else {
                    $turtle->options[$option->key] = $option->value;
                }
            }
        }
        
        return $turtles;
    }
    
    /**
     * Get turtle options
     * @param int $turtle_id
     * @return array
     */
    function turtleOptions($turtle_id) {
        $query = $this->db->query("SELECT * FROM turtle_options WHERE turtle_id = ?", $turtle_id);
        return $query->result();
    }

    /**
     * Get all cron jobs
     */
    function jobs($infoscreen_id) {
        $query = $this->db->query("SELECT * FROM jobs JOIN jobtab ON jobs.id like jobtab.job_id WHERE jobtab.infoscreen_id = ?", $infoscreen_id);
        return $query->result();
    }

}