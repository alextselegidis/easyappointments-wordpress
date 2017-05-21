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

class InstallTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Temporary Test Directory Path
     *
     * @string
     */
    protected $tmpDirectory;

    /**
     * Test Setup
     *
     * Make sure that the "tmp-dir" directory does not exist prior the test.
     */
    public function setUp()
    {
        $this->tmpDirectory = __DIR__ . '/tmp-dir';

        if (\file_exists($this->tmpDirectory)) {
            \Filesystem::delete($this->tmpDirectory);
        }
    }

    /**
     * Test Tear Down
     *
     * Remove "tmp-dir" directory after the test.
     */
    public function tearDown()
    {
        \Filesystem::delete($this->tmpDirectory);
    }

    public function testInstallMustPlaceAndConfigureApplicationFiles()
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

        $install = new Install($plugin, $linkInformation);
        $install->invoke();

        // Assert configuration file content.
        $this->assertFileExists($testPath . '/config.php');
        $this->assertTrue(\WpMock::isExecuted('add_option', array('eawp_path', $testPath)));
        $this->assertTrue(\WpMock::isExecuted('add_option', array('eawp_url', $testUrl)));
    }
}
