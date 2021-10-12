<?php

/**
 * Fired during plugin activation
 *
 * @link       https://alextselegidis.com
 * @since      1.0.0
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Easyappointments
 * @subpackage Easyappointments/includes
 * @author     Alex Tselegidis <info@alextselegidis.com>
 */
class Easyappointments_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {

        self::rename_option('eawp_path', 'easyappointments_path');
        self::rename_option('eawp_url', 'easyappointments_url');

    }

    protected static function rename_option($old_option_name, $new_option_name)
    {

        $option_value = get_option($old_option_name);

        if (!empty($option_value)) {
            delete_option($old_option_name);
            add_option($new_option_name, $option_value);
        }

    }

}
