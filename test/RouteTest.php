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

class RouteTest extends \PHPUnit_Framework_TestCase {
    /**
     * Route instance to test.
     *
     * @var \EAWP\Core\Route
     */
    protected $route;

    /**
     * Tests Setup
     */
    public function setUp() {
        \WpMock::setUp();
        $this->route = new Route();
    }

    // ------------------------------------------------------------------------
    // TEST ACTION METHOD
    // ------------------------------------------------------------------------

    public function testHookWpActionMustRegisterTheCallback() {
        $arguments = array('init', array($this, 'setUp'));
        $this->route->action('init', array($this, 'setUp'));
        $this->assertTrue(\WpMock::isExecuted('add_action', $arguments));
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
        $this->assertTrue(\WpMock::isExecuted('add_filter', $arguments));
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
        $this->assertTrue(\WpMock::isExecuted('wp_enqueue_script', $arguments));
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
        $this->assertTrue(\WpMock::isExecuted('wp_enqueue_style', $arguments));
    }

    public function testEnqueueStyleMustThrowAnExceptionOnInvalidUrlArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->style(null);
    }

    // ------------------------------------------------------------------------
    // TEST VIEW METHOD
    // ------------------------------------------------------------------------

    public function testViewMustCallTheWpMethodCorrectly() {
        $this->route->view('Page Title', 'Menu Title', 'Menu Slug', 'view-file');
        $this->assertTrue(\WpMock::isExecuted('add_action'));
    }

    public function testViewMustThrowAnExceptionOnInvalidPageTitleArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->view(null, 'Menu Title', 'Menu Slug', 'view-file');
    }

    public function testViewMustThrowAnExceptionOnInvalidMenuTitleArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->view('Page Title', null, 'Menu Slug', 'view-file');
    }

    public function testViewMustThrowAnExceptionOnInvalidMenuSlugArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->view('Page Title', 'Menu Title', null, 'view-file');
    }

    public function testViewMustThrowAnExceptionOnInvalidViewFileArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->view('Page Title', 'Menu Title', 'Menu Slug', null);
    }

    // ------------------------------------------------------------------------
    // TEST AJAX METHOD
    // ------------------------------------------------------------------------

    public function testAjaxMustRouteAnAjaxCallback() {
        $arguments = array('wp_ajax_install', array($this, 'setUp'));
        $this->route->ajax('install', array($this, 'setUp'));
        $this->assertTrue(\WpMock::isExecuted('add_action'));
    }

    public function testAjaxMustThrowAnExceptionOnInvalidActionArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->ajax(null, array($this, 'setUp'));
    }

    public function testAjaxMustThrowAnExceptionOnInvalidCallbackArgument() {
        $this->setExpectedException('InvalidArgumentException');
        $this->route->ajax('install', null);
    }

    // ------------------------------------------------------------------------
    // TEST SHORTCODE METHOD
    // ------------------------------------------------------------------------

    public function testShortcodeMustRegisterAValidWpShortcode() {
        $arguments = array('wp_ajax_install', array($this, 'setUp'));
        $this->route->ajax('install', array($this, 'setUp'));
        $this->assertTrue(\WpMock::isExecuted('add_action'));
    }
}
