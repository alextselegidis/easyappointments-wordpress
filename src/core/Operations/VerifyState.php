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
use \EAWP\Core\ValueObjects\Link;

/**
 * Verify State Operation
 *
 * This class implements the "verify state" operation of the current connection. It will check if Easy!Appointments is
 * correctly connected to WordPress, whether the configuration.php file exists and if the E!A installation is reachable
 * from the web.
 */
class VerifyState implements \EAWP\Core\Interfaces\IOperation {
    /**
     * Instance of Easy!Appointments WP Plugin
     *
     * @var \EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * Easy!Appointments Installation Link
     *
     * @var \EAWP\Core\ValueObjects\Link
     */
    protected $link;

    /**
     * Class Constructor
     *
     * @param \EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     * @param \EAWP\Core\ValueObjects\Link $link Contains installation information.
     */
    public function __construct(Plugin $plugin, Link $link) {
        $this->plugin = $plugin;
        $this->link = $link;
    }

    /**
     * Invode the unlink operation.
     *
     * This method will reset the WordPress options which will automatically disable any
     * used shortcodes.
     */
    public function invoke() {
        $this->_verifyConfigurationFile();
        $this->_performTestRequest();
    }

    /**
     * Verify that the configuration file is where it's supposed to be.
     */
    protected function _verifyConfigurationFile() {
        if (!\file_exists((string)$this->link->getPath() . '/configuration.php')
                && !\file_exists((string)$this->link->getPath() . '/config.php')) {
            throw new \Exception('Configuration file of Easy!Appointments was not found on the given path.');
        }
    }

    /**
     * Get the headers of the provided installation.
     *
     * @todo Improve the verification done by this method.
     */
    protected function _performTestRequest() {
        $headers = \get_headers((string)$this->link->getUrl() . '/index.php');

        if ($headers === false || \strpos($headers[0], '200 OK') === false) {
            throw new \Exception('The installation is not reachable from the web.');
        }
    }
}
