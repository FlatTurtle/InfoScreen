<?php

/**
 * A class used to access the uri in a user-friendly way. It will detect the uri using different server global values
 * @author Jens Segers
 */
class URI {
    
    private $uri_string = "";
    private $segments = array();
    
    /**
     * Constructor, initialise the URI component
     */
    public function __construct() {
        $this->detectUri();
    }
    
    /**
     * Retrieve a specific segment. Where n is the segment number you wish to retrieve. Segments are numbered from left to right. Returns FALSE if the segment is missing
     * @param int $n
     * @return string
     */
    public function segment($n) {
        return (!isset($this->segments[$n])) ? FALSE : $this->segments[$n];
    }
    
    /**
     * Returns a string with the complete URI
     * @return string
     */
    public function uriString() {
        return $this->uri_string;
    }
    
    /**
     * Returns an array containing the URI segments
     * @return array
     */
    public function segmentArray() {
        return $this->segments;
    }
    
    /**
     * Returns the total number of segments
     * @return int
     */
    public function totalSegments() {
        return count($this->segments);
    }
    
    /**
     * Private function that will detect the URI string
     */
    private function detectUri() {
        if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['SCRIPT_NAME'])) {
            // try REQUEST_URI
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
        } elseif (isset($_SERVER['PATH_INFO']) && trim($_SERVER['PATH_INFO'], '/') != '' && $_SERVER['PATH_INFO'] != "/" . SELF) {
            // try PATH_INFO
            $this->uri_string = $_SERVER['PATH_INFO'];
        } elseif (isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING'], '/') != '') {
            // try QUERY_STRING
            $this->uri_string = $_SERVER['QUERY_STRING'];
        } elseif (is_array($_GET) && count($_GET) == 1 && trim(key($_GET), '/') != '') {
            // try GET
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