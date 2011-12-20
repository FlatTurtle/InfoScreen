<?php

/**
 * A class used to access the uri in a user-friendly way. 
 * It will detect the uri using different server global values.
 * @author Jens Segers
 */
class URI {
    
    var $uri_string = "";
    var $segments = array();
    
    function __construct() {
        // initialisation
        $this->_detect_uri();
    }
    
    function segment($n) {
        return (!isset($this->segments[$n])) ? FALSE : $this->segments[$n];
    }
    
    function uri_string() {
        return $this->uri_string;
    }
    
    function segment_array() {
        return $this->segments;
    }
    
    function total_segments() {
        return count($this->segments);
    }
    
    private function _detect_uri() {
        // try REQUEST_URI
        if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['SCRIPT_NAME'])) {
            $uri = $_SERVER['REQUEST_URI'];
            if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
                $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
            } elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
                $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
            }
            
            // this section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
            // URI is found, and also fixes the QUERY_STRING server var and $_GET array.
            if (strncmp($uri, '?/', 2) === 0) {
                $uri = substr($uri, 2);
            }
            $parts = preg_split('#\?#i', $uri, 2);
            $uri = $parts[0];
            if (isset($parts[1])) {
                $_SERVER['QUERY_STRING'] = $parts[1];
                parse_str($_SERVER['QUERY_STRING'], $_GET);
            } else {
                $_SERVER['QUERY_STRING'] = '';
                $_GET = array();
            }
            
            if ($uri == '/' || empty($uri)) {
                $this->uri_string = '/';
            } else {
                $uri = parse_url($uri, PHP_URL_PATH);
                $this->uri_string = str_replace(array('//', '../'), '/', trim($uri, '/'));
            }
        }
        // try PATH_INFO
        else if(isset($_SERVER['PATH_INFO']) && trim($_SERVER['PATH_INFO'], '/') != '' && $_SERVER['PATH_INFO'] != "/".SELF) {
            $this->uri_string = $_SERVER['PATH_INFO'];
        }
        // try QUERY_STRING
        else if (isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING'], '/') != '') {
    		$this->uri_string = $_SERVER['QUERY_STRING'];
        }
        // try GET
        else if(is_array($_GET) && count($_GET) == 1 && trim(key($_GET), '/') != '') {
            $this->uri_string = key($_GET);
        }
        
        foreach (explode("/", preg_replace("|/*(.+?)/*$|", "\\1", $this->uri_string)) as $val) {
            if ($val != '') {
                $this->segments[] = $val;
            }
        }
        
        // makes segments start from 1
        array_unshift($this->segments, NULL);
        unset($this->segments[0]);
    }
}