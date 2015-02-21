<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPL2+
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * WpFunctions Class
 *  
 * This class will register global functions that will return assigned results used 
 * by the tests in order to mock the WP global functions ecosystem. 
 */
class WpFunctions {
	/**
	 * Register a WordPress function 
	 * 
	 * This method will register a function and return a handle which can be used to 
	 * assert the the certain method is called. It simulates the PHPUnit mocking 
	 * behavior but for the WP functionality.
	 */
    public static function register($name, $returnValue) {
        
    }
} 