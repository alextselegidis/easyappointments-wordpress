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

class PathTest extends TestCase
{
    public function testGetStringValueOfObject()
    {
        $path = new Path(__DIR__);
        $this->assertEquals(__DIR__, (string)$path);
    }

    public function testThrowsExceptionWhenPathIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Path('');
    }

    public function testThrowsExceptionWithInvalidArgumentType()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Path(null);
    }
}
