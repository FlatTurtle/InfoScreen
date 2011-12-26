<?php

/**
 * Basic model class
 * @author Jens Segers
 */
class Model {
    
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