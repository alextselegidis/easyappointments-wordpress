<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Test\Core;

use EAWP\Core\Plugin;
use EAWP\Core\Route;
use EAWP\Test\PhpUnit\TestCase;
use Prophecy\Argument;

require_once __DIR__ . '/../../wordpress/wp-includes/wp-db.php';

class PluginTest extends TestCase
{
    /**
     * @var \EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * @var \wpdb|\Prophecy\Prophecy\ObjectProphecy
     */
    protected $wpdb;

    /**
     * @var \EAWP\Core\Route|\Prophecy\Prophecy\ObjectProphecy
     */
    protected $route;

    public function setUp()
    {
        $this->route = $this->prophesize(Route::class);
        $this->wpdb = $this->prophesize(\wpdb::class);
        $this->plugin = new Plugin($this->wpdb->reveal(), $this->route->reveal());
    }

    // ------------------------------------------------------------------------
    // TEST OBJECT INSTANTIATION
    // ------------------------------------------------------------------------

    public function testObjectInstantiation()
    {
        $this->assertInstanceOf(Plugin::class, $this->plugin);
    }

    // ------------------------------------------------------------------------
    // TEST INITIALIZE METHOD
    // ------------------------------------------------------------------------

    public function testInitializeMethodMustRegisterTheRequiredRoutes()
    {
        $this->route->action('plugins_loaded', Argument::any())->shouldBeCalled();

        $this->route->ajax('install', Argument::any())->shouldBeCalled();
        $this->route->ajax('link', Argument::any())->shouldBeCalled();
        $this->route->ajax('unlink', Argument::any())->shouldBeCalled();
        $this->route->ajax('verify-state', Argument::any())->shouldBeCalled();

        $this->route->shortcode('easyappointments', Argument::any())->shouldBeCalled();

        $this->plugin->initialize();
    }

    // ------------------------------------------------------------------------
    // TEST GET DATABASE METHOD
    // ------------------------------------------------------------------------

    public function testGetDatabaseMethodMustReturnTheWordPressDatabaseObject()
    {
        $this->assertSame($this->wpdb->reveal(), $this->plugin->getDatabase());
    }
}
