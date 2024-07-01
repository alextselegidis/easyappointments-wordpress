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

    public function connect()
    {

        $url = sanitize_text_field($_POST['url']);

        if (empty($url)) {
            throw new Exception('No URL value available.');
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid URL value detected: ' . $url);
        }

        update_option('easyappointments_url', $url);

    }

    /**
     * @throws Exception
     */
    public function disconnect()
    {
        delete_option('easyappointments_url');
    }

    public function verify_state()
    {
        $url = get_option('easyappointments_url');

        if (empty($url)) {
            throw new Exception('No URL value available.');
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid URL value detected: ' . $url);
        }
    }

    public function menu()
    {
        add_menu_page(
            __( 'Easy!Appts', 'easyappointments' ),
            __( 'Easy!Appts', 'easyappointments' ),
            'manage_options',
            'easyappointments-settings',
                function () {
                    $config = [
                        'Lang' => [
                            'ConnectSuccessMessage' =>
                                __('Easy!Appointments installation was connected successfully! You can now use the '
                                    . '[easyappointments] shortcode in your pages.', 'easyappointments'),
                            'DisconnectSuccessMessage' =>
                                __('Easy!Appointments installation was disconnected successfully!', 'easyappointments'),
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
                },
            'dashicons-calendar-alt'
        );

    }
}
