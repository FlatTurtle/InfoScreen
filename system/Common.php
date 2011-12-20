<?php

/**
 * Exception Handler
 *
 * This is the custom exception handler that is declaired at the top
 * of FlatTurtle.php.
 */
if (!function_exists('_exception_handler')) {
    function _exception_handler($severity, $message, $filepath, $line) {
        if ($severity == E_STRICT)
            return;
        
        $ft = &get_instance();
        $ft->load->system("exceptions");
        if (($severity & error_reporting()) == $severity)
            $ft->exceptions->show_php_error($severity, $message, $filepath, $line);
    }
}

/**
 * Error Handler
 *
 * This function lets us invoke the exception class and
 * display errors. This function will send the error page 
 * directly to the browser and exit.
 */
if (!function_exists('show_error')) {
    function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered') {
        $ft = &get_instance();
        $ft->load->system("exceptions");
        echo $ft->exceptions->show_error($heading, $message, $status_code);
        exit();
    }
}

/**
 * 404 Page Handler
 *
 * This function is similar to the show_error() function above.
 */
if (!function_exists('show_404')) {
    function show_404($page = '') {
        $ft = &get_instance();
        $ft->load->system("exceptions");
        echo $ft->exceptions->show_404($page);
        exit();
    }
}