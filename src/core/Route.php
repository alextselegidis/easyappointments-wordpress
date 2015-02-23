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
     * @param callback $callback Callback function for the action. 
     * 
     * @throws InvalidArgumentException If arguments are invalid.
     */
    public function action($name, $callback) {
        if(!is_string($name) || empty($name)) 
            throw new \InvalidArgumentException('Invalid $name argument: ' . print_r($name, true)); 

        if(!is_callable($callback)) 
            throw new \InvalidArgumentException('Invalid $callback argument: ' . print_r($callback, true));

        \add_action($name, $callback);
    }
    
    /**
     * Add WP Filter 
     * 
     * @param string $name Filter name (see WordPress filter hooks). 
     * @param function $callback Callback function for the filter.
     *
     * @throws InvalidArgumentException If arguments are invalid.
     */
    public function filter($name, $callback) {
        if(!is_string($name) || empty($name)) 
            throw new \InvalidArgumentException('Invalid $name argument: ' . print_r($name, true)); 

        if(!is_callable($callback)) 
            throw new \InvalidArgumentException('Invalid $callback argument: ' . print_r($callback, true));
        
        \add_filter($name, $callback);
    }
    
    /**
     * Enqueue JavaScript File 
     * 
     * @param string $url The URL to JavaScript file. 
     * 
     * @throws InvalidArgumentException If argument is invalid. 
     */
    public function script($url) {
        if(!is_string($url) || empty($url)) 
            throw new \InvalidArgumentException('Invalid $url argument: ' . print_r($url, true)); 
        \wp_enqueue_script(md5($url), $url);
    }
    
    /**
     * Enqueue Style File 
     * 
     * @param string $url The URL to Style file. 
     *
     * @throws InvalidArgumentException If argument is invalid.
     */
    public function style($url) {
        if(!is_string($url) || empty($url)) 
            throw new \InvalidArgumentException('Invalid $url argument: ' . print_r($url, true)); 
        \wp_enqueue_style(md5($url), $url); 
    }

    /**  
     * Route view display on a specific hook. 
     * 
     * Example: 
     *     $route->view('some_hook', 'admin');
     * 
     * @param string $hook The hook to enable the view. 
     * @param string $view View file name (without .php extension) to be included 
     * directly from the "views" directory.
     *
     * @throws InvalidArgumentException If argument is invalid.
     * 
     * @todo Implement Method
     */
    public function view($hook, $view) {
        
    }
    
    /**
     * Route AJAX request from JavaScript 
     * 
     * This method must set a rule in order to route a future request from 
     * the user's browser. 
     * 
     * @param name $request The name of the request. 
     * @param function $callback Anonymous function defining the callback.
     * 
     * @todo Implement Method
     */
    public function ajax($request, $callback) {
        
    }
}