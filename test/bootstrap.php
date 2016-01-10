<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

define('EAWP_BASEPATH', __DIR__ . '/../src');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_name');
define('DB_USER', 'db_user');
define('DB_PASSWORD', 'db_password');

// Load required libraries and classes for the tests.
require_once __DIR__ . '/includes/Filesystem.php';
require_once __DIR__ . '/mocks/WpMock.php';
require_once __DIR__ . '/mocks/WpFunctions.php';
require_once EAWP_BASEPATH . '/core/Autoload.php';

$loader = new EAWP\Core\Autoload;
$loader->register();
$loader->addNamespace('EAWP\Core', EAWP_BASEPATH . '/core');
