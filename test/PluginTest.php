<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core;

require_once __DIR__ . '/bootstrap.php';

class PluginTest extends \PHPUnit_Framework_TestCase {
    // ------------------------------------------------------------------------
    // TEST OBJECT INSTANTIATION
    // ------------------------------------------------------------------------

    public function testObjectInstantiation() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');
        $plugin = new Plugin($wpdb, $route);
        $this->assertInstanceOf('EAWP\Core\Plugin', $plugin);
    }

    // ------------------------------------------------------------------------
    // TEST INITIALIZE METHOD
    // ------------------------------------------------------------------------

    public function testInitializeMustRegisterTheRequiredRoutes() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');

        $route->expects($this->at(0))->method('action')->with(
                $this->equalTo('plugins_loaded'),
                $this->anything());


        $route->expects($this->at(1))->method('ajax')->with(
                $this->equalTo('install'),
                $this->anything());

        $route->expects($this->at(2))->method('ajax')->with(
                $this->equalTo('link'),
                $this->anything());

        $route->expects($this->at(3))->method('ajax')->with(
                $this->equalTo('unlink'),
                $this->anything());

        $route->expects($this->at(4))->method('ajax')->with(
                $this->equalTo('verify-state'),
                $this->anything());

        $route->expects($this->at(5))->method('shortcode')->with(
                $this->equalTo('easyappointments'),
                $this->anything());

        $plugin = new Plugin($wpdb, $route);
        $plugin->initialize();
    }

    // ------------------------------------------------------------------------
    // TEST GET DATABASE METHOD
    // ------------------------------------------------------------------------

    public function testGetDatabaseMustReturnTheWpDatabaseObject() {
        $wpdb = $this->getMock('wpdb');
        $route = $this->getMock('EAWP\Core\Route');
        $plugin = new Plugin($wpdb, $route);
        $this->assertSame($wpdb, $plugin->getDatabase());
    }
}
