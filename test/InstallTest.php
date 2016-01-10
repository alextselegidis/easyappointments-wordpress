<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

require_once __DIR__ . '/bootstrap.php';

use \EAWP\Core\Operations\Install;

class InstallTest extends PHPUnit_Framework_TestCase {
    /**
     * Test Setup
     *
     * Make sure that the "tmp" directory does not exist prior the test.
     */
    public function setUp() {
        Filesystem::delete(__DIR__ . '/tmp');
    }

    /**
     * Test Tear Down
     *
     * Remove "tmp" directory (if needed).
     */
    public function tearDown() {
        Filesystem::delete(__DIR__ . '/tmp');
    }

    public function testInstallMustPlaceAndConfigureApplicationFiles() {
        $testPath = __DIR__ . '/tmp';
        $testUrl = 'http://wp/test-ea';

        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
                        ->disableOriginalConstructor()
                        ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
                     ->disableOriginalConstructor()
                     ->getMock();
        $path->method('__toString')->willReturn($testPath);

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
                     ->disableOriginalConstructor()
                     ->getMock();
        $url->method('__toString')->willReturn($testUrl);

        $install = new Install($plugin, $path, $url);

        $install->invoke();

        // Assert configuration file content.
        $this->assertFileExists($testPath . '/configuration.php');
        $this->assertTrue(WpMock::isExecuted('add_option', array('eawp_path', $testPath)));
        $this->assertTrue(WpMock::isExecuted('add_option', array('eawp_url', $testUrl)));
    }
}
