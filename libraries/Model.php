<?php

class Model {
    
    private $ft;
    
    function __construct() {
        $this->ft = &get_instance();
    }
    
    function __get($name) {
        if (isset($this->ft->{$name}))
            return $this->ft->{$name};
    }
    
    function __call($name, $args) {
        if (method_exists($this->ft, $name))
            return call_user_func_array(array($this->ft, $name), $args);
    }

}