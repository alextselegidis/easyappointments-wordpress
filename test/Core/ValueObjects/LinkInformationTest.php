<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core\ValueObjects;

use EAWP\Test\PhpUnit\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class LinkInformationTest extends TestCase
{
    /**
     * @var LinkInformation
     */
    protected $linkInformation;

    /**
     * @var Path|ObjectProphecy
     */
    protected $path;

    /**
     * @var Url|ObjectProphecy
     */
    protected $url;

    public function setUp()
    {
        $this->path = $this->prophesize(Path::class);
        $this->url = $this->prophesize(Url::class);
        $this->linkInformation = new LinkInformation($this->path->reveal(), $this->url->reveal());
    }

    public function testGetPathReturnsPathObject()
    {
        $this->assertSame($this->path->reveal(), $this->linkInformation->getPath());
    }

    public function testGetUrlReturnsUrlObject()
    {
        $this->assertSame($this->url->reveal(), $this->linkInformation->getUrl());
    }
}
