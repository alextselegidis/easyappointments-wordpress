<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://alextselegidis.com
 * @since      1.0.0
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/public
 * @author     Alex Tselegidis <info@alextselegidis.com>
 */
class Easyappointments_Public
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
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/easyappointments-public.css', [], $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/easyappointments-iframe.js', ['jquery'], $this->version, false);

    }

    public function init()
    {

        add_shortcode('easyappointments', function ($attributes) {

            $path = get_option('easyappointments_path');
            $url = get_option('easyappointments_url');

            if (empty($path) || empty($url)) {
                return ''; // There are no options set so do not proceed with the operation.
            }

            $attributes = is_array($attributes) ? $attributes : [];

            $query_data = [];

            if (!empty($attributes['provider'])) {
                $query_data['provider'] = $attributes['provider'];
            }

            if (!empty($attributes['service'])) {
                $query_data['service'] = $attributes['service'];
            }

            if (!empty($query_data)) {
                if (strpos($url, '?') === false) {
                    $url .= '?';
                }

                $url .= http_build_query($query_data);
            }

            // wp_enqueue_script(md5('iframe.js'), plugins_url('../../assets/js/iframe.js', __FILE__));

            $width = isset($attributes['width']) ? $attributes['width'] : '100%';
            $height = isset($attributes['height']) ? $attributes['height'] : '700px';
            $style = isset($attributes['style']) ? $attributes['style'] : '';

            return "
                <iframe
                    class='easyappointments-iframe'
                    src='$url'
                    width='$width'
                    height='$height'
                    style='$style'
                >
                </iframe>
            ";
        });

    }

}
