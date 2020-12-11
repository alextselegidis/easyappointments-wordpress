<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://alextselegidis.com
 * @since      1.0.0
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/admin
 * @author     Alex Tselegidis <info@alextselegidis.com>
 */
class Easyappointments_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Easyappointments_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Easyappointments_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Easyappointments_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Easyappointments_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

    }

    public function install()
    {

        $path = sanitize_text_field($_POST['path']);
        $url = sanitize_text_field($_POST['url']);

        // Fetch integration info.
        $curl = curl_init(EASYAPPOINTMENTS_INTEGRATIONS_INFORMATION_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $integrations = json_decode(curl_exec($curl), true);
        curl_close($curl);

        foreach ($integrations['easyappointments'] as $package) {
            if ($package['current'] === true) {
                if (!is_dir($path)) {
                    // dir doesn't exist, make it
                    mkdir($path, 0777, true);
                }

                $curl = curl_init($package['url']);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $zip = curl_exec($curl);
                curl_close($curl);
                file_put_contents($path . '/easyappointments.zip', $zip);
                break;
            }
        }

        // Unzip file.
        $zip_path = $path . '/easyappointments.zip';
        $zip = new ZipArchive;
        $resource = $zip->open($zip_path);

        if (!$resource) {
            throw new Exception('Could not open Easy!Appointments zip file.');
        }

        $zip->extractTo($path);
        $zip->close();

        @unlink($zip_path);

        // Configure

        $config_path = $path . '/config.php';

        if (!file_exists($config_path)) {
            copy($path . '/config-sample.php', $config_path);
        }

        // Get "config.php" content.
        $config_content = file_get_contents($config_path);

        // Replace $base_url variable.
        $this->set_config_value('BASE_URL', $url, $config_content);

        // Replace database variables.
        $this->set_config_value('DB_HOST', DB_HOST, $config_content);
        $this->set_config_value('DB_NAME', DB_NAME, $config_content);
        $this->set_config_value('DB_USERNAME', DB_USER, $config_content);
        $this->set_config_value('DB_PASSWORD', DB_PASSWORD, $config_content);

        // Update "config.php" content.
        file_put_contents($config_path, $config_content);

        add_option('easyappointments_path', $path);
        add_option('easyappointments_url', $url);

    }

    public function connect()
    {

        $path = sanitize_text_field($_POST['path']);
        $url = sanitize_text_field($_POST['url']);

        $path = rtrim($path, '/');

        if (!file_exists($path . '/configuration.php') && !file_exists($path . '/config.php')) {
            throw new Exception('Provided path does not point to an Easy!Appointments installation: "' . $path . '"');
        }

        update_option('easyappointments_path', $path);
        update_option('easyappointments_url', $url);

    }

    public function disconnect()
    {

        $path = sanitize_text_field($_POST['path']);
        $remove_files = filter_var($_POST['remove_files'], FILTER_VALIDATE_BOOLEAN);
        $remove_db_tables = filter_var($_POST['remove_db_tables'], FILTER_VALIDATE_BOOLEAN);

        delete_option('easyappointments_path');
        delete_option('easyappointments_url');

        if ($remove_db_tables) {
            global $wpdb;
            $wpdb->query('SET FOREIGN_KEY_CHECKS=0;');
            $wpdb->query('DROP TABLE IF EXISTS ea_appointments;');
            $wpdb->query('DROP TABLE IF EXISTS ea_secretaries_providers;');
            $wpdb->query('DROP TABLE IF EXISTS ea_services_providers;');
            $wpdb->query('DROP TABLE IF EXISTS ea_settings;');
            $wpdb->query('DROP TABLE IF EXISTS ea_services;');
            $wpdb->query('DROP TABLE IF EXISTS ea_service_categories;');
            $wpdb->query('DROP TABLE IF EXISTS ea_user_settings;');
            $wpdb->query('DROP TABLE IF EXISTS ea_users;');
            $wpdb->query('DROP TABLE IF EXISTS ea_roles;');
            $wpdb->query('DROP TABLE IF EXISTS ea_consents;');
            $wpdb->query('DROP TABLE IF EXISTS ea_migrations;');
            $wpdb->query('SET FOREIGN_KEY_CHECKS=1;');
        }

        if ($remove_files) {
            if (!is_writable((string)$path)) {
                throw new Exception('Cannot remove installation files, permission denied.');
            }

            $entries = [
                'application/',
                'assets/',
                'engine/',
                'storage/',
                'system/',
                'vendor/'
            ];

            foreach ($entries as $entry) {
                $this->recursive_delete($path . '/' . $entry);
            }

            @unlink($path . '/autoload.php');
            @unlink($path . '/CHANGELOG.md');
            @unlink($path . '/config.php');
            @unlink($path . '/config-sample.php');
            @unlink($path . '/index.php');
            @unlink($path . '/LICENSE');
            @unlink($path . '/README.md');
        }

    }

    public function verify_state()
    {
        $path = sanitize_text_field($_POST['path']);

        if (
            !file_exists((string)$path . '/configuration.php')
            && !file_exists((string)$path . '/config.php')
        ) {
            throw new Exception('Configuration file of Easy!Appointments was not found on the given path.');
        }

    }

    public function menu()
    {

        add_options_page(
            'Easy!Appointments',
            'Easy!Appointments',
            'manage_options',
            'easyappointments-settings',
            function () {
                $config = [
                    'Lang' => [
                        'InstallationSuccessMessage' =>
                            __('Easy!Appointments files were installed successfully! Navigate to your installation URL '
                                . 'complete the configuration of the application.', 'easyappointments'),
                        'ConnectSuccessMessage' =>
                            __('Easy!Appointments installation was connected successfully! You can now use the '
                                . '[easyappointments] shortcode in your pages.', 'easyappointments'),
                        'DisconnectSuccessMesssage' =>
                            __('Easy!Apppointments installation was disconnected successfully!', 'easyappointments'),
                        'VerificationSuccess' =>
                            __('Easy!Appointments connection is active! Use the [easyappointments] shortcode in your pages/posts.', 'easyappointments'),
                        'VerificationFailure' =>
                            __('Easy!Appointments connection seems to be broken! Make sure Easy!Appointments files are located in the target directory.', 'easyappointments'),
                        'AjaxExceptionMessage' =>
                            __('An unexpected error occurred in file %file% (line %line%): %message%', 'easyappointments'),
                        'AjaxFailureMessage' =>
                            __('The AJAX request could not be completed due to an unexpected error: %message%', 'easyappointments')
                    ],
                    'Ajax' => [
                        'nonce' => wp_create_nonce('easyappointments')
                    ]
                ];

                wp_enqueue_script('easyappointments-admin', plugin_dir_url(__FILE__) . 'js/easyappointments-admin.js', ['jquery'], $this->version, false);
                wp_enqueue_script('easyappointments-plugin', plugin_dir_url(__FILE__) . 'js/easyappointments-plugin.js', ['jquery'], $this->version, false);
                wp_enqueue_script('easyappointments-verify-state', plugin_dir_url(__FILE__) . 'js/easyappointments-verify-state.js', ['jquery'], $this->version, false);
                wp_enqueue_style('easyappointments-admin', plugin_dir_url(__FILE__) . 'css/easyappointments-admin.css', [], $this->version, 'all');
                wp_localize_script('easyappointments-plugin', 'EasyappointmentsConfig', $config);

                include __DIR__ . '/partials/easyappointments-admin-display.php';
            }
        );

    }

    /**
     * Recursive removal of a directory.
     *
     * @param string $directory Directory path to be deleted.
     */
    protected function recursive_delete($directory)
    {

        if (is_dir($directory)) {
            $objects = scandir($directory);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($directory . "/" . $object) == "dir") {
                        $this->recursive_delete($directory . "/" . $object);
                    } else {
                        @unlink($directory . "/" . $object);
                    }
                }
            }
            @reset($objects);
            @rmdir($directory);
        }

    }

    /**
     * Set a configuration value to the "config.php" content.
     *
     * This method uses a regular expression to find the configuration setting to be replaced with the new value.
     *
     * @param string $parameter Name of the "config.php" setting to be set (eg 'BASE_URL').
     * @param string $value New value of the configuration setting.
     * @param string $config_content (By Reference) Contains the "config.php" file contents.
     */
    protected function set_config_value($parameter, $value, &$config_content)
    {
        $pattern = '/(' . $parameter . ' .*)=.*;/';
        $setting = '$1 = \'' . $value . '\';';
        $config_content = preg_replace($pattern, $setting, $config_content, 1);
    }

}
