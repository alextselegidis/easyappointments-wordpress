<?php 
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPL2+
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core;

use wpdb;

/**
 * Plugin Class
 * 
 * This class handles the core operations of the plugin. It coordinates the 
 * libraries and registers the required hooks for WordPresss. 
 */
class Plugin {
    /**
     * WordPress Database Handler
     * 
     * @var WPDB
     */
    protected $db; 
    
    /**
     * Handles WordPress Action + Filters Routing
     * 
     * @var Route
     */
    protected $route;

    /**
     * Class Constructor
     * 
     * @param \WPDB $wpdb WordPress database handler.
     */
    public function __construct(wpdb $wpdb, Route $route) {
        
    }
    
    /**
     * Initialize Plugin 
     * 
     * Bind necessary actions and filters, register WP admin menu. 
     */
    public function initialize() {
        
    }
    
    /**
     * Install Plugin 
     * 
     * Performs the required actions for installing this plugin.
     */
    public function install() {
        
    }
    
    /**
     * Uninstall Plugin 
     * 
     * Performs the required actions for uninstalling this plugin.
     */
    public function uninstall() {
        
    } 
}