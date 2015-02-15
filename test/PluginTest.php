<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPL2+
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/../src/core/Plugin.php';

class PluginTest extends PHPUnit_Framework_TestCase {   
    // ------------------------------------------------------------------------
    // TEST OBJECT INSTANTIATION
    // ------------------------------------------------------------------------
    public function testObjectInstantiation() {
        $wpdb = $this->getMock('wpdb'); 
        $route = $this->getMock('EAWP\Core\Route');
        $plugin = new EAWP\Core\Plugin($wpdb, $route);
        $this->assertInstanceOf('EAWP\Core\Plugin', $plugin);
    }
}