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
use org\bovigo\vfs\vfsStreamFile;
use Prophecy\Prophecy\ObjectProphecy;

class LinkTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    protected $root;

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
     * @var Link
     */
    protected $link;

    public function setUp()
    {
        WPFunctions::setUp();

        $this->root = vfsStream::setup('tmp', 0777);

        $configFile = new vfsStreamFile('config.php', 0777);
        $configText = '
            public static $db_host     = "http://test-installation.com";
            public static $db_name     = "test_database";
            public static $db_username = "test_username";
            public static $db_password = "test_password";
        ';
        $configFile->setContent($configText);

        $this->root->addChild($configFile);

        $this->pathValue = vfsStream::url('tmp');
        $this->path = $this->prophesize(Path::class);
        $this->path->__toString()->willReturn($this->pathValue);

        $this->urlValue = $this->faker->url;
        $this->url = $this->prophesize(Url::class);
        $this->url->__toString()->willReturn($this->urlValue);

        $this->linkInformation = $this->prophesize(LinkInformation::class);
        $this->linkInformation->getPath()->willReturn($this->path->reveal());
        $this->linkInformation->getUrl()->willReturn($this->url->reveal());

        $this->plugin = $this->prophesize(Plugin::class);

        $this->link = new Link($this->plugin->reveal(), $this->linkInformation->reveal());
    }

    public function testInvokeMethodDelegatesToUpdateOption()
    {
        $this->link->invoke();
        $this->assertTrue(WPFunctions::isExecuted('update_option', ['eawp_path', $this->pathValue]));
        $this->assertTrue(WPFunctions::isExecuted('update_option', ['eawp_url', $this->urlValue]));
    }

    public function testInvokeMethodThrowsExceptionIfDestinationDirectoryDoesNotExist()
    {
        $path = $this->prophesize(Path::class);
        $path->__toString()->willReturn('vfs://dir-does-not-exist');

        $this->linkInformation->getPath()->willReturn($path);

        $link = new Link($this->plugin->reveal(), $this->linkInformation->reveal());

        $this->expectException(\Exception::class);

        $link->invoke();
    }
}
