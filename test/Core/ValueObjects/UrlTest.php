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

class UrlTest extends TestCase
{
    public function testGetStringValueOfObject()
    {
        $url = new Url('http://easyappointments.org');
        $this->assertEquals('http://easyappointments.org', (string)$url);
    }

    public function testThrowsExceptionWhenUrlIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Url('');
    }

    public function testThrowsExceptionWithInvalidArgumentType()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Url(null);
    }

    public function testThrowsExceptionWhenUrlValueIsInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Url('string\is\not/url');
    }
}
