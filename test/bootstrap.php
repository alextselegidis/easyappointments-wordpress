<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPL2+
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

// @todo Define autoloader for the plugin classes so that the PHPUnit mock builder
// automatically finds the original classes that need to be mocked.

// Load required libraries and classes for the tests.
require_once __DIR__ . '/mocks/WpMock.php';
require_once __DIR__ . '/mocks/WpFunctions.php';