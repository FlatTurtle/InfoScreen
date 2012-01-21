<?php

/**
 * Base url
 *
 * Easy access to the base url
 */
if (!function_exists("baseUrl")) {
    function baseUrl($uri = "") {
        $ft = &getInstance();
        return rtrim($ft->config->item("base_url"), "/") . "/" . ltrim($uri, "/");
    }
}

/**
 * Exception Handler
 *
 * This is the custom exception handler that is declaired at the top of FlatTurtle.php.
 */
if (!function_exists("exceptionHandler")) {
    function exceptionHandler($severity, $message, $filepath, $line) {
        if ($severity == E_STRICT) {
            return;
        }
        
        $ft = &getInstance();
        $ft->load->system("Exceptions");
        if (($severity & error_reporting()) == $severity) {
            $ft->exceptions->showPhpError($severity, $message, $filepath, $line);
        }
    }
}

/**
 * Error Handler
 *
 * This function lets us invoke the exception class and display errors. This function will send the error page directly to the browser and exit.
 */
if (!function_exists("showError")) {
    function showError($message, $status_code = 500, $heading = "An Error Was Encountered") {
        $ft = &getInstance();
        $ft->load->system("Exceptions");
        echo $ft->exceptions->showError($heading, $message, $status_code);
        exit();
    }
}

/**
 * 404 Page Handler
 *
 * This function is similar to the show_error() function above.
 */
if (!function_exists("show4040")) {
    function show4040($page = "") {
        $ft = &getInstance();
        $ft->load->system("Exceptions");
        echo $ft->exceptions->show404($page);
        exit();
    }
}