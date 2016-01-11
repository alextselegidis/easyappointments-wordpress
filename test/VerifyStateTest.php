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

use \EAWP\Core\Operations\VerifyState;

class VerifyStateTest extends PHPUnit_Framework_TestCase {
    /**
     * Temporary Test Directory Path
     *
     * @var string
     */
    protected $tmpDirectory;

    /**
     * Test Setup
     */
    public function setUp() {
        $this->tmpDirectory = __DIR__ . '/tmp-dir';

        if (file_exists($this->tmpDirectory)) {
            Filesystem::delete($this->tmpDirectory);
        }

        mkdir($this->tmpDirectory);
        touch($this->tmpDirectory . '/configuration.php');
    }

    /**
     * Test Tear Down
     */
    public function tearDown() {
        unlink($this->tmpDirectory . '/configuration.php');
        rmdir($this->tmpDirectory);
    }

    public function testVerifyStateMustBeExecutedWithoutThrowingAnException() {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
                ->disableOriginalConstructor()
                ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
                ->disableOriginalConstructor()
                ->getMock();
        $path->method('__toString')->willReturn($this->tmpDirectory);

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
                ->disableOriginalConstructor()
                ->getMock();
        $url->method('__toString')->willReturn('http://easyappointments.org');

        // Assert that the operation will be executed without throwing an exception.
        $verifyState = new VerifyState($plugin, $path, $url);
        $verifyState->invoke();
    }

    public function testVerifyStateMustThrownAnExceptionIfConfigurationFileWasNotFound() {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
                ->disableOriginalConstructor()
                ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
                ->disableOriginalConstructor()
                ->getMock();
        $path->method('__toString')->willReturn($this->tmpDirectory . '/this-one-does-not-exist');

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
                ->disableOriginalConstructor()
                ->getMock();
        $url->method('__toString')->willReturn('http://easyappointments.org');

        // Assert that the operation will be executed without throwing an exception.
        $verifyState = new VerifyState($plugin, $path, $url);
        $this->setExpectedException('\Exception');
        $verifyState->invoke();
    }

    public function testVerifyStateMustThrowAnExceptionIfTheSiteIsNotReachableFromTheWeb() {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
                ->disableOriginalConstructor()
                ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
                ->disableOriginalConstructor()
                ->getMock();
        $path->method('__toString')->willReturn($this->tmpDirectory);

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
                ->disableOriginalConstructor()
                ->getMock();
        $url->method('__toString')->willReturn('http://easyappointments.org/this-one-does-not-exist');

        // Assert that the operation will be executed without throwing an exception.
        $verifyState = new VerifyState($plugin, $path, $url);
        $this->setExpectedException('\Exception');
        $verifyState->invoke();
    }
}
