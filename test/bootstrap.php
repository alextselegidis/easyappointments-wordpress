<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

// Load required libraries and classes for the tests.
require_once __DIR__ . '/mocks/WpMock.php';
require_once __DIR__ . '/mocks/WpFunctions.php';
require_once __DIR__ . '/../src/core/Autoload.php'; 

$loader = new EAWP\Core\Autoload; 
$loader->register();
$loader->addNamespace('EAWP\Core', __DIR__ . '/../src/core');
$loader->addNamespace('EAWP\Core\ValueObjects', __DIR__ . '/../src/core/value-objects'); 
$loader->addNamespace('EAWP\Libraries', __DIR__ . '/../src/libraries'); 