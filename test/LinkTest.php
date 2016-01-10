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

use \EAWP\Core\Operations\Link;

class LinkTest extends PHPUnit_Framework_TestCase {
    /**
     * Test Setup
     *
     * Will create temporary installation files that will be used for testing the
     * Link operation class.
     */
    public function setUp() {
        // Make sure the tmp directory is removed.
        Filesystem::delete(__DIR__ . '/tmp');

        // Create temporary directory.
        mkdir(__DIR__ . '/tmp');

        // Enter some dummy data to the configuration file.
        $configText = '
            public static $db_host     = "http://test-installation.com";
            public static $db_name     = "test_database";
            public static $db_username = "test_username";
            public static $db_password = "test_password";
        ';
        file_put_contents(__DIR__ . '/tmp/configuration.php', $configText);
    }

    /**
     * Test Tear Down
     *
     * Will clear the temporary files created by the tests of the Link operation.
     */
    public function tearDown() {
        Filesystem::delete(__DIR__ . '/tmp');
    }

    public function testLinkAnExistingInstallationMustParseAndCreateTheCorrectOptionsToWordPress() {
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

        $link = new Link($plugin, $path, $url);
        $link->invoke();

        // Assert whether database options where successfully created.
        $this->assertTrue(WpMock::isExecuted('add_option', array('eawp_path', $testPath)));
        $this->assertTrue(WpMock::isExecuted('add_option', array('eawp_url', $testUrl)));
    }
}
