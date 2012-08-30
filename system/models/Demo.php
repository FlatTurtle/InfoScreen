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
     private $needed_turtles;
     
    function get($referencenumber) {
        $query = $this->db->query("SELECT * FROM `demo_infoscreens` WHERE alias = ? LIMIT 0,1", array($referencenumber));
        return $query->row();
    }
    
    

    function add($data){
        $alias = md5(time());
        if (@getimagesize($data["logo"]))  $logo = $data["logo"];
        else $logo = "http://img.flatturtle.com/infoscreen/logos/flatturtle.png";
        
        $q = $this->db->query("INSERT INTO `demo_infoscreens` (`id`, `customer_id`, `title`, `alias`, `logo`, `color`, `lang`, `interval`) VALUES (NULL, 1, ?, ?, ?, ?, ?, '6000');", array(0 => $data["title"], 1=> $alias, 2=> $logo, 3=> $data["color"], 4=> $data["lang"]));
        $this->needed_turtles = $data["title"];
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
    function turtles($referencenumber,$needed_turtles) {
        //$keys = array("airport","delijn","map","mivstib","news","nmbs","ttshuttles","twitter","villo");
        
        $stationnames = $this->getStationNames(5.31,3.14);
        $turtles = array();
        
        $max_columns = 2;
        $order = 0;
        foreach ($needed_turtles as $index => $item) {
            $i = $index % $max_columns;
            $turtles[$index] = new stdClass();
            $turtles[$index]->id = $index;
            $turtles[$index]->infoscreen_id = 0;
            $turtles[$index]->module = $item;
            $key;
            $value;
            if($item == "airport"){
                $key = "location";
                $value = "BRU";
            }
            elseif($item == "delijn"){
                $key = "location";
                $value = "Sint-Joost-ten-Node Kruidtuin";
            }
            else if($item == "map"){
                $key = "location";
                $value = "Venusstraat 35 Antwerpen";
            }
            else if($item == "mivbstib"){
                $key = "location";
                $value = "DE JAMBLINNE DE MEUX";
            }
            else if($item == "news"){
                $key = "info";
                $value = "FlatTurtle started as a spin-off from iRail, a living lab for supporting digital creativity concerning transport data. After the open-source project The DataTank, which flattens data to become directly usable in web-applications, came to exist as part of iRail, several community members started creating visualizations using this data, leading to more ideas and possibilities.";
            }
            else if($item == "nmbs"){
                $key = "location";
                $value = $stationnames[0];
            }
            else if($item == "ttshuttles"){
                $key = "location";
                $value = "brussel";
            }
            else if($item == "twitter"){
                $key = "hashtag";
                $value = "iRail";
            }
            else if($item == "villo" || $item == "velo"){
                $key = "location";
                $value = "50.866249327319;4.3109249597703";
            }
            $turtles[$index]->options =array("order"=>(string)$order,"group"=>(string)$i,"colspan"=>"1",$key => $value);
            if($i == $max_columns) $order++;   
        }
        /*$turtles[5] = new stdClass();
        $turtles[5]->id = 5;
        $turtles[5]->infoscreen_id = 0;
        $turtles[5]->module = "mivbstib";
        $turtles[5]->options =array("order"=>"0","group"=>"3","colspan"=>"1","location" => "DE JAMBLINNE DE MEUX");*/
        /*
        //First turtle
        $turtles[0] = new stdClass();
        $turtles[0]->id = 0;
        $turtles[0]->infoscreen_id = 0;
        $turtles[0]->module = "nmbs";
        $turtles[0]->options =array("order"=>"0","group"=>"0","colspan"=>"1","location" => $stationnames[0]);

        //First turtle
        $turtles[1] = new stdClass();
        $turtles[1]->id = 1;
        $turtles[1]->infoscreen_id = 0;
        $turtles[1]->module = "map";
        $turtles[1]->options =array("order"=>"0","group"=>"0","colspan"=>"1","location" => $stationnames[1]);

        //First turtle
        $turtles[2] = new stdClass();
        $turtles[2]->id = 2;
        $turtles[2]->infoscreen_id = 0;
        $turtles[2]->module = "twitter";
        $turtles[2]->options =array("order"=>"0","group"=>"1","colspan"=>"1","hashtag" => "iRail");
        
        //First turtle
        $turtles[3] = new stdClass();
        $turtles[3]->id = 3;
        $turtles[3]->infoscreen_id = 0;
        $turtles[3]->module = "airport";
        $turtles[3]->options =array("order"=>"1","group"=>"1","colspan"=>"1","location" => "BRU");
        
        //First turtle
        $turtles[4] = new stdClass();
        $turtles[4]->id = 4;
        $turtles[4]->infoscreen_id = 0;
        $turtles[4]->module = "delijn";
        $turtles[4]->options =array("order"=>"0","group"=>"2","colspan"=>"1","location" => "Sint-Joost-ten-Node Kruidtuin");
        
        //First turtle
        $turtles[5] = new stdClass();
        $turtles[5]->id = 5;
        $turtles[5]->infoscreen_id = 0;
        $turtles[5]->module = "mivbstib";
        $turtles[5]->options =array("order"=>"0","group"=>"3","colspan"=>"1","location" => "DE JAMBLINNE DE MEUX");
        
        //First turtle
        $turtles[6] = new stdClass();
        $turtles[6]->id = 6;
        $turtles[6]->infoscreen_id = 0;
        $turtles[6]->module = "news";
        $turtles[6]->options =array("order"=>"1","group"=>"3","colspan"=>"1","info" => "FlatTurtle started as a spin-off from iRail, a living lab for supporting digital creativity concerning transport data. After the open-source project The DataTank, which flattens data to become directly usable in web-applications, came to exist as part of iRail, several community members started creating visualizations using this data, leading to more ideas and possibilities.");
        
        //First turtle
        $turtles[7] = new stdClass();
        $turtles[7]->id = 7;
        $turtles[7]->infoscreen_id = 0;
        $turtles[7]->module = "ttshuttles";
        $turtles[7]->options =array("order"=>"0","group"=>"3","colspan"=>"1","location" => "brussel");
        
        //First turtle
        $turtles[8] = new stdClass();
        $turtles[8]->id = 8;
        $turtles[8]->infoscreen_id = 0;
        $turtles[8]->module = "villo";
        $turtles[8]->options =array("order"=>"0","group"=>"3","colspan"=>"1","location" => "50.866249327319;4.3109249597703");
        */        
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