<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Libraries;

use \EAWP\Core\Plugin;
use \EAWP\Core\ValueObjects\Path;
use \EAWP\Core\ValueObjects\Url;

/**
 * Install Class
 *
 * This class implements the Easy!Appointments installation procedure. It will
 * copy and configure an installation directly through WordPress. The file will
 * create a new Easy!Appointments "configuration.php" file and set the WordPress
 * database credentials to it. In the end it must store the "eawp_path" and
 * "eawp_url" settings to WordPress.
 *
 * Important:
 *      This method does not have to check for Easy!Appointments compatibility
 *      because it will install the latest supported version of project.
 */
class Install implements OperationInterface {
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
     * Invoke Install Operation
     *
     * Copy E!A files to desired location (after checking for writable permissions)
     * and create a new configuration file with the WordPress DB credentials and
     * the provided $base_url value. After that store the path and the url to "eawp_path"
     * and "eawp_url" settings respectively.
     *
     * @link https://codex.wordpress.org/Function_Reference/add_option
     */
    public function invoke() {
        $this->_copyFiles();
        $this->_configure();
        \add_option('eawp_path', (string)$this->path);
        \add_option('eawp_url', (string)$this->url);
    }

    /**
     * Copy Easy!Appointments files to required destination.
     */
    protected function _copyFiles() {
        if (!is_writable(dirname((string)$this->path)))
            throw new \Exception('Destination path is not writable.');

        $this->_recursiveCopy(EAWP_BASEPATH . '/ea-src', (string)$this->path);
    }

    /**
     * Configure Easy!Appointments "configuration.php" with WP information.
     */
    protected function _configure() {
        $configurationPath = (string)$this->path . '/configuration.php';

        // Get "configuration.php" content.
        $configuration = file_get_contents($configurationPath);

        // Replace $base_url variable.
        $this->_setValue('$base_url', (string)$this->url . '/', $configuration);

        // Replace database variables.
        $this->_setValue('$db_host', DB_HOST , $configuration);
        $this->_setValue('$db_name', DB_NAME, $configuration);
        $this->_setValue('$db_username', DB_USER, $configuration);
        $this->_setValue('$db_password', DB_PASSWORD, $configuration);

        // Update "configuration.php" content.
        file_put_contents($configurationPath, $configuration);
    }

    /**
     * Will set a configuration value to the "configuration.php" content.
     *
     * This method uses a regular expression to find the configuration setting to be replaced
     * with the new value.
     *
     * @param string $parameter Name of the "configuration.php" setting to be set (eg '$base_url').
     * @param string $value New value of the configuration setting.
     * @param string $configuration (ByReference) Contains the "configuration.php" file contents.
     */
    protected function _setValue($parameter, $value, &$configuration) {
        $pattern = '/(?:\\' . $parameter . ' * = \'?)(.*)[^\';]/';
        $setting = $parameter . ' = \'' . $value . '\';' . PHP_EOL;
        $configuration = preg_replace($pattern, $setting, $configuration, 1);
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
                    $this->_recursiveCopy($src . '/' . $file,$dst . '/' . $file);
                else
                    copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
        closedir($dir);
    }
}
