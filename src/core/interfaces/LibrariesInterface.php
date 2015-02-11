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

/**
 * Libraries Interface
 * 
 * Defines a solid interface for all plugin interfaces so that they have the 
 * same internal API. 
 */
interface LibrariesInterface {
    /**
     * Invoke Library 
     * 
     * This method must define the library logic that will execute a specific 
     * task. Every plugin library must define a single task. 
     */
    public function invoke();
}