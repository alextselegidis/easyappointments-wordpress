<?php 
/**
 * Plugin Name: Easy!Appointments - WordPress Plugin
 * Plugin URI: http://easyappointments.org
 * Description: Creates a bridge between Easy!Appointments and WordPress.
 * Version: 1.0.0
 * Author: A.Tselegidis
 * Author URI: http://alextselegidis.com
 * Text Domain: eawp
 * License: GPLv3
 */

/** Base Plugin Path */
define('EAWP_BASEPATH', __DIR__); 

/** Supported Versiosn */
define('EAWP_MIN_VERSION', '1.0');
define('EAWP_MAX_VERSION', '1.0');

/** Setup Autoloader */
require EAWP_BASEPATH . '/core/Autoload.php'; 
$loader = new EAWP\Core\Autoload; 
$loader->register();
$loader->addNamespace('EAWP\Core', EAWP_BASEPATH . '/core');
$loader->addNamespace('EAWP\Libraries', EAWP_BASEPATH . '/libraries'); 

/** Initialize Plugin */
global $wpdb; 
$route = new EAWP\Core\Route(); 
$plugin = new EAWP\Core\Plugin($wpdb, $route);
$plugin->initialize();