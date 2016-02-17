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

use \EAWP\Core\Plugin;
use \EAWP\Core\ValueObjects\LinkInformation;

/**
 * Verify State Operation
 *
 * This class implements the "verify state" operation of the current connection. It will check
 * if Easy!Appointments is correctly connected to WordPress, whether the configuration.php file
 * exists and if the E!A installation is reachable from the web.
 */
class VerifyState implements \EAWP\Core\Interfaces\IOperation {
    /**
     * Instance of Easy!Appointments WP Plugin
     *
     * @var \EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * Easy!Appointments Link Information
     *
     * @var \EAWP\Core\ValueObjects\LinkInformation
     */
    protected $linkInformation;

    /**
     * File name to be hit by the request validation.
     *
     * @var string
     */
    protected $filename;

    /**
     * Expected response status code.
     *
     * @var string
     */
    protected $expectedStatusCode;

    /**
     * Class Constructor
     *
     * @param \EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     * @param \EAWP\Core\ValueObjects\LinkInformation $linkInformation Easy!Appointments Link Information
     * @param string $filename (optional) The filename to be hit by the request validation.
     * @param string $expectedStatusCode (optional) The expected status code of the request response.
     */
    public function __construct(Plugin $plugin, LinkInformation $linkInformation, $filename = 'index.php',
            $expectedStatusCode = '200') {

        if (!is_string($filename)) {
            throw new \InvalidArgumentException('Invalid argument provided (expected string got "'
                    . gettype($filename) . '"): ' . $filename);
        }

        if (!is_string($expectedStatusCode)) {
            throw new \InvalidArgumentException('Invalid argument provided (expected string got "'
                    . gettype($expectedStatusCode) . '"): ' . $expectedStatusCode);
        }

        $this->plugin = $plugin;
        $this->linkInformation = $linkInformation;
        $this->filename = $filename;
        $this->expectedStatusCode = $expectedStatusCode;
    }

    /**
     * Invode the unlink operation.
     *
     * This method will reset the WordPress options which will automatically disable any
     * used shortcodes.
     */
    public function invoke() {
        $this->_verifyConfigurationFile();
        //$this->_performTestRequest(); // Uncomment for extra HTTP request check.
    }

    /**
     * Verify that the configuration file is where it's supposed to be.
     */
    protected function _verifyConfigurationFile() {
        if (!\file_exists((string)$this->linkInformation->getPath() . '/configuration.php')
                && !\file_exists((string)$this->linkInformation->getPath() . '/config.php')) {
            throw new \Exception('Configuration file of Easy!Appointments was not found on the given path.');
        }
    }

    /**
     * Get the headers of the provided installation.
     *
     * @todo Improve the verification done by this method.
     */
    protected function _performTestRequest() {
        $headers = \get_headers((string)$this->linkInformation->getUrl() . '/' . $this->filename);

        if ($headers === false || \strpos($headers[0], $this->expectedStatusCode) === false) {
            throw new \Exception('The installation is not reachable from the web.');
        }
    }
}
