<?php 
/**
 * Plugin Name: Easy!Appointments - WordPress Plugin
 * Plugin URI: http://easyappointments.org
 * Description: Creates a bridge between Easy!Appointments and WordPress.
 * Version: 1.0.0
 * Author: A.Tselegidis
 * Author URI: http://alextselegidis.com
 * Text Domain: easyappointments-wp
 * License: GPL2+
 */

/** Base Plugin Path */
define('EAWP_BASEPATH', __DIR__); 

/** Setup Autoloader */
require EAWP_BASEPATH . '/core/Autoload.php'; 
$loader = new EAWP\Core\Autoload; 
$loader->register();
$loader->addNamespace('EAWP\Core', EAWP_BASEPATH . '/core');
$loader->addNamespace('EAWP\Libraries', EAWP_BASEPATH . '/libraries'); 

/** Initialize Plugin */
use EAWP\Core\Plugin;
use EAWP\Core\Route;

global $wpdb; 
$route = new Route; 

$plugin = new Plugin($wpdb, $route);
$plugin->initialize();