<?php 
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPLv3
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
 * installation. It will set the configuration information to the WordPress settings 
 * table ("eawp_path" and "eawp_url"). 
 * 
 * Important: 
 *      This operation should also check that the destination path contains a valid E!A 
 *      installation and it is compatible with the current plugin version (very important 
 *      for future releases ***). With this check we can ensure that the "bridged" E!A 
 *      version will work without defects.
 * 
 * @todo Implement Bridge Operation
 */
class Bridge implements EAWP\Core\Interfaces\LibraryInterface {
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
     * Easy!Appointments Installation URL ($base_url)
     * 
     * @var string 
     */
    protected $url; 

    /**
     * Class Constructor
     * 
     * @param EAWP\Core\Plugin $plugin Easy!Appointments WordPress plugin instance.
     * @param string $path Easy!Appointments installation path (provided from user). 
     * @param string $url Easy!Appointments installation URL (provided from user). 
     */
    public function __construct(Plugin $plugin, $path, $url) {
        if (!is_string($path) || empty($path) || !dir($path))
            throw new InvalidArgumentException('Invalid $path argument provided: ' . print_r($path, TRUE));
        
        if (!is_string($url) || empty($url))
            throw new InvalidArgumentException('Invalid $url argument provided: ' . print_r($url, TRUE));
        
        $this->plugin = $plugin; 
        $this->path = $path; 
        $this->url = $url; 
    }
    
    /**
     * Invoke Bridge Operation
     * 
     * Will bridge an existing installation with current WordPress site. This method 
     * must add the "eawp_path" and "eawp_url" setting to WP options so that other 
     * operations can use that installation. At first it will read the "configuration.php" 
     * file of E!A and then place these information into WP options table in order to be 
     * available for other operations.
     */
    public function invoke() {
        
    }
}