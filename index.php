<?php

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */

    define('ENVIRONMENT', 'development');

    if (defined('ENVIRONMENT'))
    {
    	switch (ENVIRONMENT)
    	{
    		case 'development':
    			error_reporting(E_ALL | E_NOTICE);
    		break;
    	
    		case 'testing':
    		case 'production':
    			error_reporting(0);
    		break;
    
    		default:
    			exit('The application environment is not set correctly.');
    	}
    }

/*
 * -------------------------------------------------------------------
 *  PATH DETECTION FOR RELIABILITY
 * -------------------------------------------------------------------
 */

    // the location of this file
    $base_path = str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__);
    define('BASEPATH', str_replace("\\", "/", $base_path));
    
    // the location of the system folder
    $system_path = BASEPATH . "system";
    
    if (realpath($system_path) !== FALSE)
        $system_path = realpath($system_path) . '/';
    
    $system_path = rtrim($system_path, '/') . '/';
    if(!is_dir($system_path))
        exit('The system folder could not be found, please check your installation.');
    
    define('SYSTEMPATH', str_replace("\\", "/", $system_path));


/*
 * -------------------------------------------------------------------
 *  FIRE UP THE TURTLES!
 * -------------------------------------------------------------------
 */

    require_once (SYSTEMPATH . "FlatTurtle.php");