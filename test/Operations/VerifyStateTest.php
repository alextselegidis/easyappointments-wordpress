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

require_once __DIR__ . '/../bootstrap.php';

class VerifyStateTest extends \PHPUnit_Framework_TestCase {
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

        if (\file_exists($this->tmpDirectory)) {
            \Filesystem::delete($this->tmpDirectory);
        }

        \mkdir($this->tmpDirectory);
        \touch($this->tmpDirectory . '/config.php');
    }

    /**
     * Test Tear Down
     */
    public function tearDown() {
        \unlink($this->tmpDirectory . '/config.php');
        \rmdir($this->tmpDirectory);
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
        $url->method('__toString')->willReturn('http://localhost');

        $linkInformation = $this->getMockBuilder('\EAWP\Core\ValueObjects\LinkInformation')
                     ->disableOriginalConstructor()
                     ->getMock();
        $linkInformation->method('getPath')->willReturn($path);
        $linkInformation->method('getUrl')->willReturn($url);

        // Assert that the operation will be executed without throwing an exception.
        $verifyState = new VerifyState($plugin, $linkInformation, 'index.php', '404');
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

        $linkInformation = $this->getMockBuilder('\EAWP\Core\ValueObjects\LinkInformation')
                     ->disableOriginalConstructor()
                     ->getMock();
        $linkInformation->method('getPath')->willReturn($path);
        $linkInformation->method('getUrl')->willReturn($url);

        // Assert that the operation will be executed without throwing an exception.
        $verifyState = new VerifyState($plugin, $linkInformation);
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

        $linkInformation = $this->getMockBuilder('\EAWP\Core\ValueObjects\LinkInformation')
                     ->disableOriginalConstructor()
                     ->getMock();
        $linkInformation->method('getPath')->willReturn($path);
        $linkInformation->method('getUrl')->willReturn($url);

        // Assert that the operation will be executed without throwing an exception.
        $verifyState = new VerifyState($plugin, $linkInformation);
        $this->setExpectedException('\Exception');
        $verifyState->invoke();
    }
}
