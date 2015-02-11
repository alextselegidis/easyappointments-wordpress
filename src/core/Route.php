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

/**
 * EAWP Route Class
 * 
 * This class manages WordPress action hooking and data filtering in order to 
 * trigger the required operations through libraries when necessary. 
 */
class Route {
    /**
     * Hook Plugin Action 
     * 
     * @param string $name Action name (see WordPress action hooks)
     * @param function $callback Callback function for the action. 
     */
    public function action($name, $callback) {
        
    }
    
    /**
     * Add WP Filter 
     * 
     * @param string $filter Filter name (see WordPress filter hooks). 
     * @param function $callback Callback function for the filter.
     */
    public function filter($filter, $callback) {
        
    }
    
    /**
     * Enqueue JavaScript File 
     * 
     * @param string $url The URL to JavaScript file. 
     */
    public function script($url) {
        
    }
    
    /**
     * Enqueue Stzle File 
     * 
     * @param string $url The URL to Style file. 
     */
    public function style($url) {
        
    }
}