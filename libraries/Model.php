<?php

class Model {
    
    function __get($name) {
        $ft = &get_instance();
        return $ft->$name;
    }

}