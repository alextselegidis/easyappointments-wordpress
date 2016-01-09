<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core;

use \wpdb;
use \EAWP\Core\ValueObjects\Path;
use \EAWP\Core\ValueObjects\Url;
use \EAWP\Core\Exceptions\AjaxException;

/**
 * EAWP Plugin Class
 *
 * This class handles the core operations of the plugin. It coordinates the
 * libraries and registers the required hooks for WordPresss.
 */
class Plugin {
    /**
     * WordPress Database Handler
     *
     * @var mixed(WPDB)
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
        $this->db = $wpdb;
        $this->route = $route;
    }

    /**
     * Initialize Plugin
     *
     * Bind necessary actions and filters, register WP admin menu.
     */
    public function initialize() {
        $plugin = $this; // Closure Argument
        $route = $this->route;

        $this->route->action('plugins_loaded', function() use ($plugin, $route) {
            load_plugin_textdomain('eawp', false, dirname(plugin_basename(__DIR__)) . '/assets/lang');

            $jsData = array(
                'Lang' => array(
                    'InstallationSuccessMessage' => __('Easy!Appointments files were installed successfully! Navigate to your installation URL '
                                                      . 'complete the configuration of the application.', 'eawp'),
                    'BridgeSuccessMessage' => __('Easy!Appointments installation was bridged successfully! You can now use the '
                                                . '[easyappointments] shortcode in your pages.', 'eawp'),
                    'AjaxExceptionMessage' => __('An unexpected error occured in file %file% (line %line%): %message%', 'eawp')
                )
            );

            $route->view('Easy!Appointments', 'Easy!Appointments',
                    'eawp-settings', 'admin', array('admin.js', 'style.css'), $jsData);
        });

        $this->route->ajax('install', function() use($plugin) {
            try {
                $path = new Path($_POST['path']);
                $url = new Url($_POST['url']);
                $library = new \EAWP\Libraries\Install($plugin, $path, $url);
                $library->invoke();
            } catch(AjaxException $ex) {
                echo $ex->response();
            }
        });

        $this->route->ajax('bridge', function() use($plugin) {
            try {
                $path = new Path($_POST['path']);
                $url = new Url($_POST['url']);
                $library = new \EAWP\Libraries\Bridge($plugin, $path, $url);
                $library->invoke();
            } catch(AjaxException $ex) {
                echo $ex->response();
            }
        });

        $this->route->shortcode('easyappointments', function() use($plugin) {
            $library = new \EAWP\Libraries\Shortcode($plugin);
            $library->invoke();
        });
    }

    /**
     * Get WordPress Database Object.
     *
     * @return db
     */
    public function getDatabase() {
        return $this->db;
    }

    /**
     * Install Plugin
     *
     * Performs the required actions for installing this plugin.
     */
    public function install() {
        // Add the required operations here ...
        return;
    }

    /**
     * Uninstall Plugin
     *
     * Performs the required actions for uninstalling this plugin.
     */
    public function uninstall() {
        // Add the required operations here ...
        return;
    }
}
