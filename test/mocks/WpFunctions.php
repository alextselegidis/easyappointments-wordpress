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
 *      Except from the mocking mecahnism this file provides a useful 
 *      list of the WordPress methods that are required by the plugin. 
 */
require_once __DIR__ . '/WpMock.php';

function add_action() {
    WpMock::registerExecution(__FUNCTION__, func_get_args());
}

function add_filter() {
    WpMock::registerExecution(__FUNCTION__, func_get_args());
}

function wp_enqueue_script() {
    WpMock::registerExecution(__FUNCTION__, func_get_args());
}

function wp_enqueue_style() {
    WpMock::registerExecution(__FUNCTION__, func_get_args());
}

function __() {
    WpMock::registerExecution(__FUNCTION__, func_get_args());
}

function _e() {
    WpMock::registerExecution(__FUNCTION__, func_get_args());
}