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
 * Widget Class
 * 
 * This class must implement a WP widget feature where users will be able to
 * book appointments through a page widget.
 * 
 * NOT SURE IF THIS WILL BE IMPLEMENTED
 * 
 * @todo Implement Widget Operation
 */
class Widget implements LibrariesInterface {
    /**
     * Easy!Appointments WordPress Plugin Instance
     * 
     * @var type 
     */
    protected $plugin; 

    /**
     * Class Constructor
     * 
     * @param Plugin $plugin 
     */
    public function __construct(Plugin $plugin) {
        $this->plugin = $plugin; 
    }
        
    /**
     * Invoke Widget Operation 
     * 
     * This operation must execute a mechanism that will display the booking wizard
     * as a page widget. It is sure that there will need to be some modifications in
     * the E!A code base but the end result needs to be a smaller booking procedure 
     * that will allow the user to book an appointment directly from the widget 
     * position.
     */
    public function invoke() {
        
    }
}