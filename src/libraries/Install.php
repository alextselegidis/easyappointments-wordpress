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
 * Install Class
 * 
 * This class implements the Easy!Appointments installation procedure. It will 
 * copy and configure an installation directly through WordPress. The file will
 * create a new Easy!Appointments configuration.php file and set the WordPress 
 * database credentials to it. In the end it must store the "eawp_path" and 
 * "eawp_url" settings to WordPress. 
 * 
 * Important: 
 *      This method does not have to check for Easy!Appointments compatibility 
 *      because it will install the latest supported version of project. 
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
     * the provided $base_url value. After that store the path and the url to "eawp_path"
     * and "eawp_url" settings respectively.
     */
    public function invoke() {
        
    }
}