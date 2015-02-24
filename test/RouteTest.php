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
require_once __DIR__ . '/../src/core/Route.php';

class RouteTest extends PHPUnit_Framework_TestCase {

    /**
     * @var EAWP\Core\Route
     */
    protected $route;

    /**
     * Tests Setup
     */
    public function setUp() {
        WpMock::setUp();
        $this->route = new EAWP\Core\Route();
    }

    // ------------------------------------------------------------------------
    // TEST ACTION METHOD
    // ------------------------------------------------------------------------
    public function testHookWpActionMustRegisterTheCallback() {
        $arguments = array('init', array($this, 'setUp'));
        $this->route->action('init', array($this, 'setUp'));
        $this->assertTrue(WpMock::isExecuted('add_action', $arguments));
    }

    public function testHookWpActionMustThrowAnExceptionOnInvalidHookNameArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->action(null, array($this, 'setUp'));
    }

    public function testHookWpActionMustThrowAnExceptionOnInvalidHookCallbackArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->action('init', null);
    }

    // ------------------------------------------------------------------------
    // TEST FILTER METHOD
    // ------------------------------------------------------------------------
    public function testHookWpFilterMustRegisterACallback() {
        $arguments = array('example_filter', array($this, 'setUp'));
        $this->route->filter('example_filter', array($this, 'setUp'));
        $this->assertTrue(WpMock::isExecuted('add_filter', $arguments));
    }

    public function testHookWpFilterMustThrowAnExceptionOnInvalidHookNameArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->filter(null, array($this, 'setUp'));
    }

    public function testHookWpFilterMustThrowAnExceptionOnInvalidHookCallbackArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->filter('example_filter', null);
    }

    // ------------------------------------------------------------------------
    // TEST SCRIPT METHOD
    // ------------------------------------------------------------------------
    public function testEnqueueScriptMustCallTheWpMethodCorrectly() {
        $arguments = array(
            md5('http://github.com'), // script handle
            'http://github.com'       // script url
        );
        $this->route->script('http://github.com');
        $this->assertTrue(WpMock::isExecuted('wp_enqueue_script', $arguments));
    }

    public function testEnqueueScriptMustThrowAnExceptionOnInvalidUrlArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->script(null);
    }

    // ------------------------------------------------------------------------
    // TEST STYLE METHOD
    // ------------------------------------------------------------------------
    public function testEnqueueStyleMustCallTheWpMethodCorrectly() {
        $arguments = array(
            md5('http://github.com'), // script handle
            'http://github.com'       // script url
        );
        $this->route->style('http://github.com');
        $this->assertTrue(WpMock::isExecuted('wp_enqueue_style', $arguments));
    }

    public function testEnqueueStyleMustThrowAnExceptionOnInvalidUrlArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->style(null);
    }

    // ------------------------------------------------------------------------
    // TEST VIEW METHOD
    // ------------------------------------------------------------------------
    public function testViewMustCallTheWpMethodCorrectly() {
        $this->markTestIncomplete();
    }

    public function testViewMustThrowAnExceptionOnInvalidHookArgument() {
        $this->markTestIncomplete();
    }

    public function testViewMustThrowAnExceptionOnInvalidViewArgument() {
        $this->markTestIncomplete();
    }
    
    // ------------------------------------------------------------------------
    // TEST AJAX METHOD
    // ------------------------------------------------------------------------
    public function testAjaxMustRouteAnAjaxCallback() {
        
    }
}