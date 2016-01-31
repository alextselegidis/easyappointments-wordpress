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

require_once __DIR__ . '/../bootstrap.php';

class LinkInformationTest extends \PHPUnit_Framework_TestCase {
    protected $link;

    protected $path;

    protected $url;

    public function setUp() {
        $this->path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')->disableOriginalConstructor()->getMock();
        $this->url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')->disableOriginalConstructor()->getMock();
        $this->link = new Link($this->path, $this->url);
    }

    public function testGetPathReturnsPathObject() {
        $this->assertSame($this->path, $this->link->getPath());
    }

    public function testGetUrlReturnsUrlObject() {
        $this->assertSame($this->url, $this->link->getUrl());
    }
}
