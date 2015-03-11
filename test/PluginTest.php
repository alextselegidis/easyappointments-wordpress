<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
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
    
    // ------------------------------------------------------------------------
    // TEST INITIALIZE METHOD
    // ------------------------------------------------------------------------
    public function testInitializeMustRegisterTheRequiredRoutes() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');
        
        $route->expects($this->once())->method('view')->with(
                $this->anything(),
                $this->anything(),
                $this->anything(),
                $this->equalTo('admin')); 
        
        $route->expects($this->at(2))->method('ajax')->with(
                $this->equalTo('install'),
                $this->anything()); 
        
        $route->expects($this->at(3))->method('ajax')->with(
                $this->equalTo('bridge'),
                $this->anything()); 
        
        $plugin = new EAWP\Core\Plugin($wpdb, $route);
        $plugin->initialize();
    }
    
    // ------------------------------------------------------------------------
    // TEST INITIALIZE METHOD
    // ------------------------------------------------------------------------
    public function testGetDatabaseMustReturnTheWpDatabaseObject() {
        $wpdb = $this->getMock('wpdb'); 
        $route = $this->getMock('EAWP\Core\Route'); 
        $plugin = new EAWP\Core\Plugin($wpdb, $route);
        $this->assertSame($wpdb, $plugin->getDatabase());
    }
}