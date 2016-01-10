<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

require_once __DIR__ . '/bootstrap.php';

use \EAWP\Core\ValueObjects\Path;

class PathTest extends PHPUnit_Framework_TestCase {
    public function testGetStringValueOfObject() {
        $path = new Path(__DIR__); 
        $this->assertEquals(__DIR__, (string)$path);
    }

    public function testThrowsExceptionWhenPathIsEmpty() {
        $this->setExpectedException('InvalidArgumentException'); 
        new Path('');
    }

    public function testThrowsExceptionWithInvalidArgumentType() {
        $this->setExpectedException('InvalidArgumentException'); 
        new Path(null);
    }
}