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
 * This class implements the "unlink" operation of a given connection between WordPress and Easy!Appointments. It is
 * also possible to entirely remove the installation files and database tables.
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
     * Remove E!A Files & Database
     *
     * @var bool
     */
    protected $removeFilesAndDatabase;

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

        $this->plugin = $plugin;
        $this->path = $path;
        $this->removeFilesAndDatabase = $removeFilesAndDatabase;
    }

    /**
     * Invoke the unlink operation.
     *
     * This method will reset the WordPress options which will automatically disable any used shortcodes.
     */
    public function invoke() {
        $this->_removeOptions();
        if ($this->removeFilesAndDatabase) {
            $this->_removeFilesAndDatabase();
        }
    }

    /**
     * Remove WordPress Options of Plugin
     *
     * Without the eawp_path and eawp_url options there is no connection with E!A and WordPress. The plugin shortcode
     * will not work anymore.
     */
    protected function _removeOptions() {
        \delete_option('eawp_path');
        \delete_option('eawp_url');
    }

    /**
     * Remove E!A files and database tables.
     *
     * This method will completely remove the Easy!Appointments files.
     */
    protected function _removeFilesAndDatabase() {
        $this->_recursiveDelete((string)$this->path);
        $db = $this->plugin->getDatabase();
        $db->query('
            DROP TABLE IF EXISTS ea_appointments;
            DROP TABLE IF EXISTS ea_secretaries_providers;
            DROP TABLE IF EXISTS ea_services_providers;
            DROP TABLE IF EXISTS ea_settings;
            DROP TABLE IF EXISTS ea_services;
            DROP TABLE IF EXISTS ea_services_categories;
            DROP TABLE IF EXISTS ea_user_settings;
            DROP TABLE IF EXISTS ea_users;
            DROP TABLE IF EXISTS ea_roles;
        ');
    }

    /**
     * Recursive removal of a directory.
     *
     * @param string @dir Directory path to be deleted.
     *
     * @link http://stackoverflow.com/a/3338133/1718162
     */
    protected function _recursiveDelete($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        $this->_recursiveDelete($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}
