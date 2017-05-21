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

class UrlTest extends \PHPUnit_Framework_TestCase {
    public function testGetStringValueOfObject() {
        $url = new Url('http://easyappointments.org');
        $this->assertEquals('http://easyappointments.org', (string)$url);
    }

    public function testThrowsExceptionWhenUrlIsEmpty() {
        $this->setExpectedException('InvalidArgumentException');
        new Url('');
    }

    public function testThrowsExceptionWithInvalidArgumentType() {
        $this->setExpectedException('InvalidArgumentException');
        new Url(null);
    }

    public function testThrowsExceptionWhenUrlValueIsInvalid() {
        $this->setExpectedException('InvalidArgumentException');
        new Url('string\is\not/url');
    }
}
