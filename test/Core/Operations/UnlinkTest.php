<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core\Operations;

use EAWP\Core\Plugin;
use EAWP\Core\ValueObjects\LinkInformation;
use EAWP\Core\ValueObjects\Path;
use EAWP\Core\ValueObjects\Url;
use EAWP\Test\PhpUnit\Mocks\WPFunctions;
use EAWP\Test\PhpUnit\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

require_once __DIR__ . '/../../../wordpress/wp-includes/wp-db.php';

class UnlinkTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    protected $root;

    /**
     * @var \wpdb
     */
    protected $wpdb;

    /**
     * @var ObjectProphecy
     */
    protected $plugin;

    /**
     * @var ObjectProphecy
     */
    protected $path;

    /**
     * @var string
     */
    protected $pathValue;

    /**
     * @var ObjectProphecy
     */
    protected $url;

    /**
     * @var string
     */
    protected $urlValue;

    /**
     * @var ObjectProphecy
     */
    protected $linkInformation;

    /**
     * @var Unlink
     */
    protected $unlink;

    public function setUp()
    {
        WPFunctions::setUp();

        $this->root = vfsStream::setup('tmp', 0777, [
            'config.php' => 'Contains E!A configuration values.'
        ]);

        $this->wpdb = $this->prophesize(\wpdb::class);
        $this->wpdb->query(Argument::any())->willReturn(null);

        $this->plugin = $this->prophesize(Plugin::class);
        $this->plugin->getDatabase()->willReturn($this->wpdb);

        $this->pathValue = vfsStream::url('tmp');
        $this->path = $this->prophesize(Path::class);
        $this->path->__toString()->willReturn($this->pathValue);

        $this->urlValue = $this->faker->url;
        $this->url = $this->prophesize(Url::class);
        $this->url->__toString()->willReturn($this->urlValue);

        $this->linkInformation = $this->prophesize(LinkInformation::class);
        $this->linkInformation->getPath()->willReturn($this->path->reveal());
        $this->linkInformation->getUrl()->willReturn($this->url->reveal());

        $this->unlink = new Unlink($this->plugin->reveal(), $this->linkInformation->reveal(), true, true);
    }

    public function testUnlinkMethodMustRemoveWordPressOptions()
    {
        $this->unlink->invoke();
        $this->assertTrue(WPFunctions::isExecuted('delete_option', array('eawp_path')));
        $this->assertTrue(WPFunctions::isExecuted('delete_option', array('eawp_url')));
    }

    public function testUnlinkMethodRemovesEasyAppointmentFiles()
    {
        $this->unlink->invoke();
        $this->assertFalse($this->root->hasChild('config.php'));
    }

    public function testUnlinkMethodRemovesEasyAppointmentsDatabaseTables()
    {
        $this->wpdb->query(Argument::containingString('ea_appointments'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_secretaries_providers'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_services_providers'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_settings'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_services'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_service_categories'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_user_settings'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_users'))->shouldBeCalled();
        $this->wpdb->query(Argument::containingString('ea_roles'))->shouldBeCalled();

        $this->unlink->invoke();
    }
}
