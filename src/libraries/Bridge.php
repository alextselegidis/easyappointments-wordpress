<?php 
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPL2+
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Libraries;

use EAWP\Core\Plugin;

/**
 * Bridge Class
 * 
 * This class implements the "bridge" of WordPress and an existing Easy!Appointments 
 * installation. It will set the configuration information for to the WordPress database.
 * 
 * @todo Implement Bridge Operation
 */
class Bridge implements LibrariesInterface {
    /**
     * Instance of Easy!Appointments WP Plugin
     * 
     * @var EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * Easy!Appointments Installation Path
     * 
     * @var string
     */
    protected $path;

    /**
     * Class Constructor
     * 
     * @param EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     * @param string $path Easy!Appointments installation path (provided from user). 
     */
    public function __construct(Plugin $plugin, $path) {
        if (!is_string($path) || empty($path) || !dir($path))
            throw new InvalidArgumentException('Invalid $path argument provided: ' . print_r($path, TRUE));
        
        $this->plugin = $plugin; 
        $this->path = $path; 
        $this->url = $url; 
    }
    
    /**
     * Invoke Bridge Operation
     * 
     * Will bridge an existing installation with current WordPress site. This
     * method must add the "eawp_path" and "eawp_url" setting to WP options so
     * that other operations can use that installation. At first it will read
     * the configuration.php file of E!A and then place these information into 
     * WP options table in order to be available for other operations.
     * 
     * Important: 
     *      The bridge operation might need to do other stuff as well in order
     *      to connect Easy!Appointments with WP. 
     */
    public function invoke() {
        
    }
}