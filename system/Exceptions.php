<?php

/**
 * The exceptions component will take care of all error reporting. 
 * @author Jens Segers
 */
class Exceptions {
    
    protected $levels = array(E_ERROR => "Error", E_WARNING => "Warning", E_PARSE => "Parsing Error", E_NOTICE => "Notice", E_CORE_ERROR => "Core Error", E_CORE_WARNING => "Core Warning", E_COMPILE_ERROR => "Compile Error", E_COMPILE_WARNING => "Compile Warning", E_USER_ERROR => "User Error", E_USER_WARNING => "User Warning", E_USER_NOTICE => "User Notice", E_STRICT => "Runtime Notice");
    protected $stati = array(200 => "OK", 201 => "Created", 202 => "Accepted", 203 => "Non-Authoritative Information", 204 => "No Content", 205 => "Reset Content", 206 => "Partial Content", 300 => "Multiple Choices", 301 => "Moved Permanently", 302 => "Found", 304 => "Not Modified", 305 => "Use Proxy", 307 => "Temporary Redirect", 400 => "Bad Request", 401 => "Unauthorized", 403 => "Forbidden", 404 => "Not Found", 405 => "Method Not Allowed", 406 => "Not Acceptable", 407 => "Proxy Authentication Required", 408 => "Request Timeout", 409 => "Conflict", 410 => "Gone", 411 => "Length Required", 412 => "Precondition Failed", 413 => "Request Entity Too Large", 414 => "Request-URI Too Long", 415 => "Unsupported Media Type", 416 => "Requested Range Not Satisfiable", 417 => "Expectation Failed", 500 => "Internal Server Error", 501 => "Not Implemented", 502 => "Bad Gateway", 503 => "Service Unavailable", 504 => "Gateway Timeout", 505 => "HTTP Version Not Supported");
    
    /**
     * Display a 404 error and terminates the current script
     * @param string $page
     */
    public function show404($page = "") {
        $heading = "404 Page Not Found";
        $message = "The page you requested was not found.";
        
        echo $this->showError($heading, $message, 404);
        exit();
    }
    
    /**
     * Handle php errors
     * @param const $severity
     * @param string $message
     * @param string $filepath
     * @param int $line
     */
    public function showPhpError($severity, $message, $filepath, $line) {
        $severity = (!isset($this->levels[$severity])) ? $severity : $this->levels[$severity];
        
        $filepath = str_replace("\\", "/", $filepath);
        
        // for safety reasons we do not show the full file path
        if (FALSE !== strpos($filepath, "/")) {
            $x = explode("/", $filepath);
            $filepath = $x[count($x) - 2] . "/" . end($x);
        }
        
        $heading = "A PHP Error was encountered";
        $message = array("Severity: " . $severity, "Message:  " . $message, "Filename: " . $filepath, "Line Number: " . $line);
        
        echo $this->showError($heading, $message);
    }
    
    /**
     * Display the error message supplied and set the optional status code
     * @param string $heading
     * @param string $message
     * @param int $status_code
     * @return string
     */
    public function showError($heading, $message, $status_code = 500) {
        $this->setStatusHeader($status_code);
        
        $message = "<p>" . implode("</p><p>", (!is_array($message)) ? array($message) : $message) . "</p>";
        
        ob_start();
        include (SYSTEMPATH . "Error.php");
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
    
    /**
     * Set the header status code with a matching message
     * @param unknown_type $code
     * @param unknown_type $text
     */
    private function setStatusHeader($code = 200, $text = "") {
        if ($code == "" || !is_numeric($code)) {
            showError("Status codes must be numeric", 500);
        }
        
        if (isset($this->stati[$code]) && $text == "") {
            $text = $this->stati[$code];
        }
        
        if ($text == "") {
            showError("No status text available. Please check your status code number or supply your own message text.", 500);
        }
        
        $server_protocol = (isset($_SERVER["SERVER_PROTOCOL"])) ? $_SERVER["SERVER_PROTOCOL"] : FALSE;
        
        if ($server_protocol == "HTTP/1.1" or $server_protocol == "HTTP/1.0") {
            header($server_protocol . " {$code} {$text}", TRUE, $code);
        } else {
            header("HTTP/1.1 {$code} {$text}", TRUE, $code);
        }
    }

}