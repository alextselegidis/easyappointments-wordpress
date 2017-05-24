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

use EAWP\Test\PhpUnit\Mocks\WPFunctions;
use EAWP\Test\PhpUnit\TestCase;

require_once __DIR__ . '/../../wordpress/wp-includes/wp-db.php';

class RouteTest extends TestCase
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * Tests Setup
     */
    public function setUp()
    {
        WPFunctions::setUp();
        $this->route = new Route();
    }

    // ------------------------------------------------------------------------
    // TEST ACTION METHOD
    // ------------------------------------------------------------------------

    public function testHookWpActionMustRegisterTheCallback()
    {
        $arguments = ['init', [$this, 'setUp']];
        $this->route->action('init', [$this, 'setUp']);
        $this->assertTrue(WPFunctions::isExecuted('add_action', $arguments));
    }

    public function testHookWpActionMustThrowAnExceptionOnInvalidHookNameArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->action(null, [$this, 'setUp']);
    }

    public function testHookWpActionMustThrowAnExceptionOnInvalidHookCallbackArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->action('init', null);
    }

    // ------------------------------------------------------------------------
    // TEST FILTER METHOD
    // ------------------------------------------------------------------------

    public function testHookWpFilterMustRegisterACallback()
    {
        $arguments = ['example_filter', [$this, 'setUp']];
        $this->route->filter('example_filter', [$this, 'setUp']);
        $this->assertTrue(WPFunctions::isExecuted('add_filter', $arguments));
    }

    public function testHookWpFilterMustThrowAnExceptionOnInvalidHookNameArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->filter(null, [$this, 'setUp']);
    }

    public function testHookWpFilterMustThrowAnExceptionOnInvalidHookCallbackArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->filter('example_filter', null);
    }

    // ------------------------------------------------------------------------
    // TEST SCRIPT METHOD
    // ------------------------------------------------------------------------

    public function testEnqueueScriptMustCallTheWpMethodCorrectly()
    {
        $arguments = [
            md5('http://github.com'), // script handle
            'http://github.com'       // script url
        ];
        $this->route->script('http://github.com');
        $this->assertTrue(WPFunctions::isExecuted('wp_enqueue_script', $arguments));
    }

    public function testEnqueueScriptMustThrowAnExceptionOnInvalidUrlArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->script(null);
    }

    // ------------------------------------------------------------------------
    // TEST STYLE METHOD
    // ------------------------------------------------------------------------

    public function testEnqueueStyleMustCallTheWpMethodCorrectly()
    {
        $arguments = [
            md5('http://github.com'), // script handle
            'http://github.com'       // script url
        ];
        $this->route->style('http://github.com');
        $this->assertTrue(WPFunctions::isExecuted('wp_enqueue_style', $arguments));
    }

    public function testEnqueueStyleMustThrowAnExceptionOnInvalidUrlArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->style(null);
    }

    // ------------------------------------------------------------------------
    // TEST VIEW METHOD
    // ------------------------------------------------------------------------

    public function testViewMustCallTheWpMethodCorrectly()
    {
        $this->route->view('Page Title', 'Menu Title', 'Menu Slug', 'view-file');
        $this->assertTrue(WPFunctions::isExecuted('add_action'));
    }

    public function testViewMustThrowAnExceptionOnInvalidPageTitleArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->view(null, 'Menu Title', 'Menu Slug', 'view-file');
    }

    public function testViewMustThrowAnExceptionOnInvalidMenuTitleArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->view('Page Title', null, 'Menu Slug', 'view-file');
    }

    public function testViewMustThrowAnExceptionOnInvalidMenuSlugArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->view('Page Title', 'Menu Title', null, 'view-file');
    }

    public function testViewMustThrowAnExceptionOnInvalidViewFileArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->view('Page Title', 'Menu Title', 'Menu Slug', null);
    }

    // ------------------------------------------------------------------------
    // TEST AJAX METHOD
    // ------------------------------------------------------------------------

    public function testAjaxMustRouteAnAjaxCallback()
    {
        $this->route->ajax('install', [$this, 'setUp']);
        $this->assertTrue(WPFunctions::isExecuted('add_action'));
    }

    public function testAjaxMustThrowAnExceptionOnInvalidActionArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->ajax(null, [$this, 'setUp']);
    }

    public function testAjaxMustThrowAnExceptionOnInvalidCallbackArgument()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->route->ajax('install', null);
    }

    // ------------------------------------------------------------------------
    // TEST SHORTCODE METHOD
    // ------------------------------------------------------------------------

    public function testShortcodeMustRegisterAValidWpShortcode()
    {
        $this->route->ajax('install', [$this, 'setUp']);
        $this->assertTrue(WPFunctions::isExecuted('add_action'));
    }
}
