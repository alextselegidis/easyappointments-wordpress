<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2017
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core\Operations;

use \EAWP\Core\Plugin;
use \EAWP\Core\ValueObjects\LinkInformation;

/**
 * Install Class
 *
 * This class implements the Easy!Appointments installation procedure. It will copy and configure
 * an installation directly through WordPress. The file will create a new Easy!Appointments "config.php"
 * file and set the WordPressdatabase credentials to it. In the end it must store the "eawp_path" and
 * "eawp_url" settings to WordPress.
 *
 * Important:
 *
 * This method does not have to check for Easy!Appointments compatibility because it will install the
 * latest supported version of project.
 */
class Install implements \EAWP\Core\Interfaces\IOperation {
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
     * Class Constructor
     *
     * @param EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     * @param EAWP\Core\ValueObjects\LinkInformation $linkInformation Easy!Appointments Link Information
     */
    public function __construct(Plugin $plugin, LinkInformation $linkInformation) {
        $this->plugin = $plugin;
        $this->linkInformation = $linkInformation;
    }

    /**
     * Invoke Install Operation
     *
     * Copy E!A files to desired location (after checking for writable permissions) and create a
     * new configuration file with the WordPress DB credentials and the provided BASE_URL value.
     * After that store the path and the URL to "eawp_path" and "eawp_url" settings respectively.
     *
     * @link https://codex.wordpress.org/Function_Reference/add_option
     */
    public function invoke() {
        $this->_copyFiles();
        $this->_configure();
        \add_option('eawp_path', (string)$this->linkInformation->getPath());
        \add_option('eawp_url', (string)$this->linkInformation->getUrl());
    }

    /**
     * Copy Easy!Appointments files to required destination.
     */
    protected function _copyFiles() {
        if (!is_writable(dirname((string)$this->linkInformation->getPath())))
            throw new \Exception('Destination path is not writable.');

        $this->_recursiveCopy(EAWP_BASEPATH . '/ea-vendor', (string)$this->linkInformation->getPath());
    }

    /**
     * Configure Easy!Appointments "configuration.php" with WP information.
     */
    protected function _configure() {
        $configPath = (string)$this->linkInformation->getPath() . '/config.php';

        // Get "config.php" content.
        $configContent = file_get_contents($configPath);

        // Replace $base_url variable.
        $this->_setValue('BASE_URL', (string)$this->linkInformation->getUrl(), $configContent);

        // Replace database variables.
        $this->_setValue('DB_HOST', DB_HOST , $configContent);
        $this->_setValue('DB_NAME', DB_NAME, $configContent);
        $this->_setValue('DB_USERNAME', DB_USER, $configContent);
        $this->_setValue('DB_PASSWORD', DB_PASSWORD, $configContent);

        // Update "config.php" content.
        file_put_contents($configPath, $configContent);
    }

    /**
     * Will set a configuration value to the "config.php" content.
     *
     * This method uses a regular expression to find the configuration setting to be replaced with
     * the new value.
     *
     * @param string $parameter Name of the "config.php" setting to be set (eg 'BASE_URL').
     * @param string $value New value of the configuration setting.
     * @param string $configContent (By Reference) Contains the "config.php" file contents.
     */
    protected function _setValue($parameter, $value, &$configContent) {
        $pattern = '/(' . $parameter . ' .*)=.*;/';
        $setting = '$1 = \'' . $value . '\';';
        $configContent = preg_replace($pattern, $setting, $configContent, 1);
    }

    /**
     * Recursively copies source directory and contents to destination path.
     *
     * @param string $src Source directory path.
     * @param string $dst Destination directory path.
     *
     * @link  http://stackoverflow.com/a/2050909/1718162
     */
    protected function _recursiveCopy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file))
                    $this->_recursiveCopy($src . '/' . $file, $dst . '/' . $file);
                else
                    copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
        closedir($dir);
    }
}
