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
 * Install Class
 * 
 * This class implements the Easy!Appointments installation procedure. It will 
 * copy and configure an installation directly through WordPress. The file will
 * use the create a new Easy!Appointments configuration.php file and set the 
 * WordPress credentials to it. 
 * 
 * @todo Implement Install Operation
 */
class Install implements EAWP\Core\Interfaces\LibraryInterface {
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
     * @param EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     * @param string $path Easy!Appointments installation path (provided from user). 
     * @param string $url Easy!Appointments installation url (provided from user).
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
     * Invoke Install Operation 
     * 
     * Copy E!A files to desired location (after checking for writable permissions)
     * and create a new configuration file with the WordPress DB credentials and 
     * the provided $base_url value. 
     */
    public function invoke() {
        
    }
}