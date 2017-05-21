<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

declare(strict_types = 1);
error_reporting(E_ALL);

define('EAWP_BASEPATH', __DIR__ . '/../src');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_name');
define('DB_USER', 'db_user');
define('DB_PASSWORD', 'db_password');

// Load required libraries and classes for the tests.
require_once EAWP_BASEPATH . '/core/Autoload.php';
