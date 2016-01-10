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
use \EAWP\Core\ValueObjects\Path;

/**
 * Unlink Operation
 *
 * This class implements the "unlink" operation of a given connection between WordPress
 * and Easy!Appointments. It is also possible to entirely remove the installation files
 * and database tables.
 *
 * @todo Implement Operation
 */
class Unlink implements \EAWP\Core\Interfaces\IOperation {
    /**
     * Plugin Instance
     *
     * @var \EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * Easy!Appointments Installation Path
     *
     * @var \EAWP\Core\ValueObjects\Path
     */
    protected $path;

    /**
     * Class Constructor
     *
     * @param Plugin $plugin The plugin instance.
     * @param Path $path Contains the Easy!Appointments installation path.
     * @param bool $removeFilesAndDatabase (optional) Whether to also remove the E!A files and database tables.
     */
    public function __construct(Plugin $plugin, Path $path, $removeFilesAndDatabase = false) {
        if (!is_bool($removeFilesAndDatabase)) {
            throw new \InvalidArgumentException('Invalid argument provided (expected bool got "'
                    . gettype($removeFilesAndDatabase) . '"): ' . $removeFilesAndDatabase);
        }
    }

    /**
     * Invoke the unlink operation.
     *
     * This method will reset the WordPress options which will automatically disable any
     * used shortcodes.
     */
    public function invoke() {

    }
}
