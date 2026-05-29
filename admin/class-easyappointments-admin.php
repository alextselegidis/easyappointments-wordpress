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
class Easyappointments_Admin {

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
     *
     * @since    1.0.0
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles( $hook ) {
        if ( $hook !== 'toplevel_page_easyappointments-settings' ) {
            return;
        }

        wp_enqueue_style( 'easyappointments-admin', plugin_dir_url( __FILE__ ) . 'css/easyappointments-admin.css', [], $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts( $hook ) {
        if ( $hook !== 'toplevel_page_easyappointments-settings' ) {
            return;
        }

        wp_enqueue_script( 'easyappointments-admin', plugin_dir_url( __FILE__ ) . 'js/easyappointments-admin.js', [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'easyappointments-plugin', plugin_dir_url( __FILE__ ) . 'js/easyappointments-plugin.js', [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'easyappointments-verify-state', plugin_dir_url( __FILE__ ) . 'js/easyappointments-verify-state.js', [ 'jquery' ], $this->version, true );

        $config = [
            'Lang' => [
                'ConnectSuccessMessage'  => __( 'Easy!Appointments installation was connected successfully! You can now embed the booking form in your pages using the [easyappointments] shortcode, the Gutenberg block, or the Elementor widget.', 'easyappointments' ),
                'DisconnectSuccessMessage' => __( 'Easy!Appointments installation was disconnected successfully!', 'easyappointments' ),
                'DisconnectPrompt'       => __( 'Are you sure that you want to disconnect?', 'easyappointments' ),
                'VerificationSuccess'    => __( 'Easy!Appointments connection is active! Embed the booking form using the [easyappointments] shortcode, the Gutenberg block, or the Elementor widget.', 'easyappointments' ),
                'VerificationFailure'    => __( 'Easy!Appointments connection seems to be broken! Make sure Easy!Appointments files are located in the target directory.', 'easyappointments' ),
                'ErrorTitle'             => __( 'Something went wrong', 'easyappointments' ),
                'UnknownError'           => __( 'An unknown error occurred. Please try again.', 'easyappointments' ),
                'ShowTechnicalDetails'   => __( 'Show technical details', 'easyappointments' ),
                'InvalidUrlMessage'      => __( 'Please enter a valid URL starting with http:// or https://.', 'easyappointments' ),
                'AjaxFailureMessage'     => __( 'The request could not be completed. Please check your connection and try again.', 'easyappointments' ),
            ],
            'Ajax' => [
                'nonce' => wp_create_nonce( 'easyappointments' ),
            ],
        ];

        wp_localize_script( 'easyappointments-plugin', 'EasyappointmentsConfig', $config );
    }

    public function connect() {
        try {
            check_admin_referer( 'easyappointments', 'nonce' );

            $this->check_capabilities();

            $url = trim( sanitize_text_field( $_POST['url'] ) );

            if ( empty( $url ) ) {
                throw new Exception( __( 'No URL value provided.', 'easyappointments' ) );
            }

            if ( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
                throw new Exception( __( 'The provided value is not a valid URL.', 'easyappointments' ) );
            }

            update_option( 'easyappointments_url', $url );

            wp_send_json_success();

        } catch ( Exception $e ) {
            wp_send_json( [
                'exception' => [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                ],
            ] );
        }
    }

    public function disconnect() {
        try {
            check_admin_referer( 'easyappointments', 'nonce' );

            $this->check_capabilities();

            delete_option( 'easyappointments_url' );

            wp_send_json_success();

        } catch ( Exception $e ) {
            wp_send_json( [
                'exception' => [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                ],
            ] );
        }
    }

    public function verify_state() {
        try {
            check_admin_referer( 'easyappointments', 'nonce' );

            $this->check_capabilities();

            $url = get_option( 'easyappointments_url' );

            if ( empty( $url ) ) {
                throw new Exception( __( 'No URL value available.', 'easyappointments' ) );
            }

            if ( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
                throw new Exception( __( 'Invalid URL value detected.', 'easyappointments' ) );
            }

            wp_send_json_success();

        } catch ( Exception $e ) {
            wp_send_json( [
                'exception' => [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                ],
            ] );
        }
    }

    public function menu() {
        if ( ! $this->can_manage_options() ) {
            return;
        }

        add_menu_page(
            __( 'Easy!Appts', 'easyappointments' ),
            __( 'Easy!Appts', 'easyappointments' ),
            'manage_options',
            'easyappointments-settings',
            function () {
                include __DIR__ . '/partials/easyappointments-admin-display.php';
            },
            'dashicons-calendar-alt'
        );

    }

    public function add_settings_link( $links ) {
        $settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=easyappointments-settings' ) ) . '">'
            . __( 'Settings', 'easyappointments' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    private function check_capabilities() {
        if ( ! $this->can_manage_options() ) {
            throw new Exception( 'You are not allowed to perform this task' );
        }
    }

    private function can_manage_options() {
        return current_user_can( 'manage_options' );
    }
}
