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
    protected $wpdb; 
    
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
        $this->wpdb = $wpdb; 
        $this->route = $route;
    }
    
    /**
     * Initialize Plugin 
     * 
     * Bind necessary actions and filters, register WP admin menu. 
     */
    public function initialize() {
        $this->route->view('Easy!Appointments', 'Easy!Appointments', 'admin');
        
        $this->route->ajax('install', function() {
            $library = new EAWP\Libraries\Install($path, $url); 
            $library->invoke();
        });
        
        $this->route->ajax('bridge', function() {
            $library = new EAWP\Libraries\Bridge($path, $url); 
            $library->invoke();
        });
        
        $this->route->shortcode('easyappointments', function() {
            $library = new EAWP\Libraries\Shortcode(); 
            $library->invoke();
        }); 
        
    }
    
    /**
     * Install Plugin 
     * 
     * Performs the required actions for installing this plugin.
     */
    public function install() {
        // Add the required commands here ... 
    }
    
    /**
     * Uninstall Plugin 
     * 
     * Performs the required actions for uninstalling this plugin.
     */
    public function uninstall() {
        // Add the required commands here ... 
    } 
}