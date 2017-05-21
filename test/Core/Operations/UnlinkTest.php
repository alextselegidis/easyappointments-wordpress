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

class UnlinkTest extends \PHPUnit_Framework_TestCase
{
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
    public function setUp()
    {
        \WpMock::setUp();

        $this->tmpDirectory = __DIR__ . '/tmp-dir';

        if (\file_exists($this->tmpDirectory)) {
            \Filesystem::delete($this->tmpDirectory);
        }

        \mkdir($this->tmpDirectory);

        \Filesystem::copy(__DIR__ . '/../../src/ea-vendor', $this->tmpDirectory);
    }

    /**
     * Test Tear Down
     *
     * Will make sure that the filesystem will remain clean after the test execution.
     */
    public function tearDown()
    {
        \Filesystem::delete($this->tmpDirectory);
    }

    public function testUnlinkMustRemoveWordPressOptions()
    {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
            ->disableOriginalConstructor()
            ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
            ->disableOriginalConstructor()
            ->getMock();
        $testPath = $this->tmpDirectory;
        $path->method('__toString')->willReturn($testPath);

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
            ->disableOriginalConstructor()
            ->getMock();
        $testUrl = 'http://wp/test/easyappointments';
        $url->method('__toString')->willReturn($testUrl);

        $linkInformation = $this->getMockBuilder('\EAWP\Core\ValueObjects\LinkInformation')
            ->disableOriginalConstructor()
            ->getMock();
        $linkInformation->method('getPath')->willReturn($path);
        $linkInformation->method('getUrl')->willReturn($url);

        $link = new Unlink($plugin, $linkInformation, false, false);
        $link->invoke();

        // Assert that the operation was executed successfully.
        $this->assertTrue(\WpMock::isExecuted('delete_option', array('eawp_path')));
        $this->assertTrue(\WpMock::isExecuted('delete_option', array('eawp_url')));
        $this->assertTrue(\file_exists($testPath . '/config.php'));
    }

    public function testUnlinkAndRemoveFilesMustRemoveWordPressOptionsAndDeleteEasyAppointmentsFiles()
    {
        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
            ->disableOriginalConstructor()
            ->getMock();

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
            ->disableOriginalConstructor()
            ->getMock();
        $testPath = $this->tmpDirectory;
        $path->method('__toString')->willReturn($testPath);

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
            ->disableOriginalConstructor()
            ->getMock();
        $testUrl = 'http://wp/test/easyappointments';
        $url->method('__toString')->willReturn($testUrl);

        $linkInformation = $this->getMockBuilder('\EAWP\Core\ValueObjects\LinkInformation')
            ->disableOriginalConstructor()
            ->getMock();
        $linkInformation->method('getPath')->willReturn($path);
        $linkInformation->method('getUrl')->willReturn($url);

        $link = new Unlink($plugin, $linkInformation, true, false);
        $link->invoke();

        // Assert that the operation was executed successfully.
        $this->assertTrue(\WpMock::isExecuted('delete_option', array('eawp_path')));
        $this->assertTrue(\WpMock::isExecuted('delete_option', array('eawp_url')));
        $this->assertNotTrue(\file_exists($testPath . '/config.php'));
    }

    public function testUnlinkAndRemoveDatabaseTablesMustRemoveWordPressOptionsAndDatabaseTables()
    {
        $wpdb = $this->getMockBuilder('\WPDB')->getMock();
        $wpdb->expects($this->exactly(9))->method('query');

        $plugin = $this->getMockBuilder('\EAWP\Core\Plugin')
            ->disableOriginalConstructor()
            ->getMock();
        $plugin->method('getDatabase')->willReturn($wpdb);

        $path = $this->getMockBuilder('\EAWP\Core\ValueObjects\Path')
            ->disableOriginalConstructor()
            ->getMock();
        $testPath = $this->tmpDirectory;
        $path->method('__toString')->willReturn($testPath);

        $url = $this->getMockBuilder('\EAWP\Core\ValueObjects\Url')
            ->disableOriginalConstructor()
            ->getMock();
        $testUrl = 'http://wp/test/easyappointments';
        $url->method('__toString')->willReturn($testUrl);

        $linkInformation = $this->getMockBuilder('\EAWP\Core\ValueObjects\LinkInformation')
            ->disableOriginalConstructor()
            ->getMock();
        $linkInformation->method('getPath')->willReturn($path);
        $linkInformation->method('getUrl')->willReturn($url);

        $link = new Unlink($plugin, $linkInformation, false, true);
        $link->invoke();

        // Assert that the operation was executed successfully.
        $this->assertTrue(\WpMock::isExecuted('delete_option', array('eawp_path')));
        $this->assertTrue(\WpMock::isExecuted('delete_option', array('eawp_url')));
    }
}
