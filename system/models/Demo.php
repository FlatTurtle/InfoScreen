<?php

/**
 * The Infoscreen model class - This will get the closest to a certain location
 * @author Jens, Pieter
 */
class Demo extends Model {
    
    /**
     * Get infoscreen information
     * @param string $alias
     * @return object
     */
    function get($referencenumber) {
        $query = $this->db->query("SELECT * FROM `demo_infoscreens` WHERE alias = ? LIMIT 0,1", array($referencenumber));
        return $query->row();
    }

    function add($data){
        $alias = md5(time());
        $q = $this->db->query("INSERT INTO `demo_infoscreens` (`id`, `customer_id`, `title`, `alias`, `logo`, `color`, `lang`, `interval`) VALUES (NULL, 1, ?, ?, ?, ?, ?, '1500');", array(0 => $data["title"], 1=> $alias, 2=> $data["logo"], 3=> $data["color"], 4=> $data["lang"]));
        return $alias;
    }

    function update($referencenumber, $data){
        //TODO
    }
    
    /**
     * Get all turtles of an infoscreen
     * @param int $infoscreen_id
     * @return array
     */
    function turtles($referencenumber) {
        $stationnames = $this->getStationNames(5.31,3.14);
        $turtles = array();
        //First turtle
        $turtles[0] = new stdClass();
        $turtles[0]->id = 0;
        $turtles[0]->infoscreen_id = 0;
        $turtles[0]->module = "nmbs";
        $turtles[0]->order = 0;
        $turtles[0]->group = 0;
        $turtles[0]->colspan = 1;
        $turtles[0]->options =array("location" => $stationnames[0]);

        //add a second one
        $turtles[1] = new stdClass();
        $turtles[1]->id = 1;
        $turtles[1]->infoscreen_id = 0;
        $turtles[1]->module = "nmbs";
        $turtles[1]->order = 0;
        $turtles[1]->group = 0;
        $turtles[1]->colspan = 1;
        $turtles[1]->options =array("location" => $stationnames[1]);
        return $turtles;
    }

    /**
     *
     */
    function getStationNames($latitude,$longitude){
        // make sure curl is installed
        $content = "";
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://data.iRail.be/spectql/NMBS/Stations%7Bname,longitude,latitude%7D?in_radius('. $latitude. ',' . $longitude.',5).limit(2):json');
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $content = json_decode(curl_exec($ch));
            curl_close($ch);
        }else{
            echo "Curl is not installed on this system";
            exit(0);
        }        
        if(count($content->spectql) == 0){
            return array("Brussel Centraal", "Gent Sint Pieters");
        }else if(count($content->spectql) == 1){
            return array($content->spectql[0]->name, "Gent Sint Pieters");
        }else{
            return array($content->spectql[0]->name,$content->spectql[1]->name);
        }
    }
    
}