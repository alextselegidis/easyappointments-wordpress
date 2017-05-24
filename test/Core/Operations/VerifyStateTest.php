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

class VerifyStateTest extends TestCase
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
     * @var VerifyState
     */
    protected $verifyState;

    public function setUp()
    {
        WPFunctions::setUp();

        $this->root = vfsStream::setup('tmp', 0777);

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

        $this->verifyState = new VerifyState($this->plugin->reveal(), $this->linkInformation->reveal());
    }

    public function testVerifyStateMethodThrowsExceptionIfNoConfigurationFileIsFound()
    {
        $this->expectException(\Exception::class);
        $this->verifyState->invoke();
    }
}
