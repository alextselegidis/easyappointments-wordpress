<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Operations;

use EAWP\Core\Plugin;
use EAWP\Core\ValueObjects\Path;

/**
 * Verify State Operation
 *
 * This class implements the "verify state" operation of the current connection. This operation
 * will check if Easy!Appointments is correctly connected to WordPress.
 *
 * @todo Implement Operation
 */
class VerifyState implements \EAWP\Interfaces\IOperation {
    /**
     * Instance of Easy!Appointments WP Plugin
     *
     * @var EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * Easy!Appointments Installation Path
     *
     * @var EAWP\Core\ValueObjects\Path
     */
    protected $path;

    /**
     * Easy!Appointments Installation URL ($base_url)
     *
     * @var EAWP\Core\ValueObjects\Url
     */
    protected $url;

    /**
     * Class Constructor
     *
     * @param EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     * @param EAWP\Core\ValueObjects\Path $path Easy!Appointments installation path (provided from user).
     * @param EAWP\Core\ValueObjects\Url $url Easy!Appointments installation url (provided from user).
     */
    public function __construct(Plugin $plugin, Path $path, Url $url) {
        $this->plugin = $plugin;
        $this->path = $path;
        $this->url = $url;
    }

    /**
     * Invode the unlink operation.
     *
     * This method will reset the WordPress options which will automatically disable any
     * used shortcodes.
     */
    public function invoke() {

    }
}
