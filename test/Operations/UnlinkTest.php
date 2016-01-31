<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

require_once __DIR__ . '/../bootstrap.php';

use \EAWP\Core\Operations\Unlink;

class UnlinkTest extends PHPUnit_Framework_TestCase {
    /**
     * Temporary Test Directory Path
     *
     * @var string
     */
    protected $tmpDirectory;

    /**
     * Test Setup
     *
     * Will create sample copy of the installation files.
     */
    public function setUp() {
        WpMock::setUp();

        $this->tmpDirectory = __DIR__ . '/tmp-dir';

        if (file_exists($this->tmpDirectory)) {
            Filesystem::delete($this->tmpDirectory);
        }

        mkdir($this->tmpDirectory);

        Filesystem::copy(__DIR__ . '/../src/ea-vendor/1.0', $this->tmpDirectory);
    }

    /**
     * Test Tear Down
     *
     * Will make sure that the filesystem will remain clean after the test execution.
     */
    public function tearDown() {
        Filesystem::delete($this->tmpDirectory);
    }

    public function testUnlinkMustRemoveTheWordPressOptionsAndSeparateTheInstallations() {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
                        ->disableOriginalConstructor()
                        ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
                     ->disableOriginalConstructor()
                     ->getMock();
        $testPath = $this->tmpDirectory;
        $path->method('__toString')->willReturn($testPath);

        $link = new Unlink($plugin, $path, false);
        $link->invoke();

        // Assert that the operation was executed successfully.
        $this->assertTrue(WpMock::isExecuted('delete_option', array('eawp_path')));
        $this->assertTrue(WpMock::isExecuted('delete_option', array('eawp_url')));
        $this->assertTrue(file_exists($testPath . '/configuration.php'));
    }

    public function testUnlinkAndRemoveFilesMustSeparateTheTwoInstallationsAndRemoveAllTheDataFromEasyAppointments() {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
                        ->disableOriginalConstructor()
                        ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
                     ->disableOriginalConstructor()
                     ->getMock();
        $testPath = $this->tmpDirectory;
        $path->method('__toString')->willReturn($testPath);

        // Mock the WPDB object.
        $wpdb = $this->getMock('WPDB');
        $wpdb->expects($this->once())->method('query');
        $plugin->method('getDatabase')->willReturn($wpdb);

        $link = new Unlink($plugin, $path, true);
        $link->invoke();

        // Assert that the operation was executed successfully.
        $this->assertTrue(WpMock::isExecuted('delete_option', array('eawp_path')));
        $this->assertTrue(WpMock::isExecuted('delete_option', array('eawp_url')));
        $this->assertNotTrue(file_exists($testPath . '/configuration.php'));
    }
}
