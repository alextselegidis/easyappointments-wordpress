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
use Prophecy\Prophecy\ObjectProphecy;

class InstallTest extends TestCase
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
     * @var Install
     */
    protected $install;

    public function setUp()
    {
        $this->markTestSkipped('Find a way to bypass the HTTP request to integrations.json');

        WPFunctions::setUp();

        $this->root = vfsStream::setup('tmp', 0777);

        if (!defined('EAWP_INTEGRATIONS_INFORMATION_URL')) {
            define('EAWP_INTEGRATIONS_INFORMATION_URL', $this->root->url() . '/integrations.json');
        }

        $zipFile = vfsStream::newFile('easyappointments.zip')->at($this->root);

        $integrationsInformation = [
            'easyappointments' => [
                [
                    'current' => true,
                    'title' => 'Easy!Appointments',
                    'description' => 'Open Source Appointment Scheduler',
                    'version' => '1.0.0',
                    'url' => $zipFile->url()
                ]
            ]
        ];
        vfsStream::newFile('integrations.json')->at($this->root)->setContent(json_encode($integrationsInformation));

        $this->plugin = $this->prophesize(Plugin::class);

        $this->pathValue = vfsStream::url('tmp');
        $this->path = $this->prophesize(Path::class);
        $this->path->__toString()->willReturn($this->pathValue);

        $this->urlValue = $this->faker->url;
        $this->url = $this->prophesize(Url::class);
        $this->url->__toString()->willReturn($this->urlValue);

        $this->linkInformation = $this->prophesize(LinkInformation::class);
        $this->linkInformation->getPath()->willReturn($this->path->reveal());
        $this->linkInformation->getUrl()->willReturn($this->url->reveal());

        $this->install = new Install($this->plugin->reveal(), $this->linkInformation->reveal());
    }

    public function testInvokeMethodMustPlaceAndConfigureApplicationFiles()
    {
        $this->install->invoke();

        // Assert configuration file content.
        $this->assertFileExists($this->pathValue . '/config.php');
        $this->assertTrue(WPFunctions::isExecuted('add_option', array('eawp_path', $this->pathValue)));
        $this->assertTrue(WPFunctions::isExecuted('add_option', array('eawp_url', $this->urlValue)));
    }

    public function testInvokeMethodThrowsExceptionIfDestinationDirectoryIsNotWritable()
    {
        $this->root->chmod(000);

        $this->expectException(\Exception::class);

        $this->install->invoke();
    }
}
