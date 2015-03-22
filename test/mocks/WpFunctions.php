<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Mock WordPress Functions
 * 
 * Append this file with extra functions that need to be mocked. The 
 * methods must only register their execution in the WpMock class and
 * to nothing else. 
 * 
 * Important: 
 *      Except from the mocking mechanism this file provides a useful 
 *      list of the WordPress methods that are required by the plugin. 
 */
require_once __DIR__ . '/WpMock.php';

// Appendwith Extra WP Functions

$functions = array(
    'add_action',
    'add_filter',
    'wp_enqueue_script',
    'wp_enqueue_style',
    '__',
    '_e',
    'add_option',
    'update_option',
    'delete_option'
);

// Dynamic Declaration of Functions

foreach($functions as $function) {
    eval(
        'function ' . $function . '() {
            WpMock::registerExecution(__FUNCTION__, func_get_args());        
        }'
    );
}