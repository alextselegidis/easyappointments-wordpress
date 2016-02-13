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
 * Unlink Operation
 *
 * This class implements the "unlink" operation of a given connection between WordPress and Easy!Appointments. It is
 * also possible to entirely remove the installation files and database tables.
 */
class Unlink implements \EAWP\Core\Interfaces\IOperation {
    /**
     * Plugin Instance
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
     * Remove E!A Files
     *
     * @var bool
     */
    protected $removeFiles;

    /**
     * Remove E!A Database Tables
     *
     * @var bool
     */
    protected $removeDbTables;

    /**
     * Class Constructor
     *
     * @param \EAWP\Core\Plugin $plugin Easy!Appointments WordPress plugin instance.
     * @param \EAWP\Core\ValueObjects\LinkInformation $linkInformation Easy!Appointments Link Information
     * @param bool $removeFiles (optional) Whether to remove the Easy!Appointments files.
     * @param bool $removeDbTables (optional) Whether to remove the Easy!Appointments database tables.
     */
    public function __construct(Plugin $plugin, LinkInformation $linkInformation, $removeFiles = false,
            $removeDbTables = false) {
        if (!is_bool($removeFiles)) {
            throw new \InvalidArgumentException('Invalid argument provided (expected bool got "'
                    . gettype($removeFiles) . '"): ' . $removeFiles);
        }

        if (!is_bool($removeDbTables)) {
            throw new \InvalidArgumentException('Invalid argument provided (expected bool got "'
                    . gettype($removeDbTables) . '"): ' . $removeDbTables);
        }

        $this->plugin = $plugin;
        $this->linkInformation = $linkInformation;
        $this->removeFiles = $removeFiles;
        $this->removeDbTables = $removeDbTables;
    }

    /**
     * Invoke the unlink operation.
     *
     * This method will reset the WordPress options which will automatically disable any used shortcodes.
     */
    public function invoke() {
        $this->_removeOptions();

        if ($this->removeDbTables) {
            $this->_removeDbTables();
        }

        if ($this->removeFiles) {
            $this->_removeFiles();
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
     * Remove E!A files.
     */
    protected function _removeFiles() {
        if (!is_writable(dirname((string)$this->linkInformation->getPath())))
            throw new \Exception('Cannot remove installation files, permission denied.');

        $this->_recursiveDelete((string)$this->linkInformation->getPath());
    }

    /**
     * Remove E!A database tables.
     */
    protected function _removeDbTables() {
        $db = $this->plugin->getDatabase();
        $db->query('DROP TABLE IF EXISTS ea_appointments;');
        $db->query('DROP TABLE IF EXISTS ea_secretaries_providers;');
        $db->query('DROP TABLE IF EXISTS ea_services_providers;');
        $db->query('DROP TABLE IF EXISTS ea_settings;');
        $db->query('DROP TABLE IF EXISTS ea_services;');
        $db->query('DROP TABLE IF EXISTS ea_service_categories;');
        $db->query('DROP TABLE IF EXISTS ea_user_settings;');
        $db->query('DROP TABLE IF EXISTS ea_users;');
        $db->query('DROP TABLE IF EXISTS ea_roles;');
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
                        @\unlink($dir . "/" . $object);
                }
            }
            @\reset($objects);
            @\rmdir($dir);
        }
    }
}
