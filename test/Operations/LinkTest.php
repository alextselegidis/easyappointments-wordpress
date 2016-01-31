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

use \EAWP\Core\Operations\Link;

class LinkTest extends PHPUnit_Framework_TestCase {
    /**
     * Temporary Test Directory Path
     *
     * @var string
     */
    protected $tmpDirectory;

    /**
     * Test Setup
     *
     * Will create temporary installation files that will be used for testing the "Link"
     * operation class.
     */
    public function setUp() {
        WpMock::setUp();

        $this->tmpDirectory = __DIR__ . '/tmp-dir';

        // Make sure the tmp directory is removed.
        if (file_exists($this->tmpDirectory)) {
            Filesystem::delete($this->tmpDirectory);
        }

        // Create temporary directory.
        mkdir($this->tmpDirectory);

        // Write some dummy data to the configuration.php file.
        $configText = '
            public static $db_host     = "http://test-installation.com";
            public static $db_name     = "test_database";
            public static $db_username = "test_username";
            public static $db_password = "test_password";
        ';
        file_put_contents($this->tmpDirectory . '/configuration.php', $configText);

        // Write some dummy data to the config.php file.
        $configText = '
            const DB_HOST       = "http://test-installation.com";
            const DB_NAME       = "test_database";
            const DB_USERNAME   = "test_username";
            const DB_PASSWORD   = "test_password";
        ';
        file_put_contents($this->tmpDirectory . '/config.php', $configText);
    }

    /**
     * Test Tear Down
     *
     * Will clear the temporary files created by the tests of the "Link" operation.
     */
    public function tearDown() {
        Filesystem::delete($this->tmpDirectory);
    }

    public function testLinkAnExistingInstallationMustParseAndCreateTheCorrectOptionsToWordPress() {
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

        $link = new Link($plugin, $path, $url);
        $link->invoke();

        // Assert whether database options where successfully created.
        $this->assertTrue(WpMock::isExecuted('add_option', array('eawp_path', $testPath)));
        $this->assertTrue(WpMock::isExecuted('add_option', array('eawp_url', $testUrl)));
    }
}
