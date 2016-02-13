<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/*
 * WordPress administration page for the plugin will accept user settings and display
 * information about the plugin and the supported operations.
 */

?>

<div class="wrap eawp">
    <h2>Easy!Appointments - WordPress Plugin</h2>
    <p>
        <?php _e('This plugin aims to bridge Easy!Appointments with WordPress and '
                . 'facilitate users in the integration of the appointment booking '
                . 'system to their WP pages. It offers useful functions such as the '
                . 'installation of Easy!Appointments directly from the WordPress backend, '
                . 'the link of an existing installation and of course the display of '
                . 'the appointment booking wizard with the use of a simple shortcode.', 'eawp'); ?>
    </p>

    <h3 class="title"><?php _e('Installation', 'eawp'); ?></h3>
    <p>
        <?php _e('Set the path and URL of your Easy!Appointments installation and '
                . 'press either the "Install" or "Link" button in order to complete '
                . 'the operation.', 'eawp'); ?>
    </p>

    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="path"><?php _e('Path', 'eawp'); ?></label></th>
                <td><input type="text" id="path" class="regular-text"
                        placeholder="<?php echo ABSPATH . 'easyappointments'; ?>"
                        value="<?php echo get_option('eawp_path'); ?>" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="url"><?php _e('URL', 'eawp'); ?></label></th>
                <td><input type="text" id="url" class="regular-text"
                               placeholder="<?php echo get_site_url() . '/easyappointments'; ?>"
                               value="<?php echo get_option('eawp_url'); ?>"/></td>
            </tr>
            <tr>
                <td class="submit link-operations hidden" colspan="2">
                    <button id='install' class="button button-primary"><?php _e('Install', 'eawp'); ?></button>
                    <button id='link' class="button"><?php _e('Link', 'eawp'); ?></button>
                </td>
                <td class="sublime unlink-operations hidden" colspan="2">
                    <fieldset>
                        <label for="remove-files">
                            <input type="checkbox" id="remove-files" >
                            <?php _e('Remove Easy!Appointments Files') ?>
                        </label>

                        <br>

                        <label for="remove-db-tables">
                            <input type="checkbox" id="remove-db-tables" >
                            <?php _e('Remove Easy!Appointments Database Tables') ?>
                        </label>
                    </fieldset>

                    <br>

                    <button id='unlink' class="button"><?php _e('Unlink', 'eawp'); ?></button>
                </td>
            </tr>
        </tbody>
    </table>

    <h3 class="title"><?php _e('Hints', 'eawp'); ?></h3>
    <ul>
        <li>
            <strong><?php _e('Install', 'eawp'); ?>:</strong>
            <?php _e('This operation will create a new installation by placing and configuring '
                    . 'Easy!Appointments files into the requested directory. You will '
                    . 'have to complete the E!A installation by visiting the provided URL.', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Link', 'eawp'); ?>:</strong>
            <?php _e('This operation will link an existing Easy!Appointments installation with '
                    . 'your WordPress website. Make sure that you will set the correct '
                    . 'installation path and URL.', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Unlink', 'eawp'); ?>:</strong>
            <?php _e('This operation will unlink an active connection between Easy!Appointments and '
                    . 'your WordPress website. You might set whether you want the files and database '
                    . 'tables removed as well.', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Shortcode', 'eawp'); ?>:</strong>
            <?php _e('If you want the Easy!Appointments booking wizard to be available in your '
                    . 'website, create a new page and add the [easyappointments] shortcode in it. '
                    . 'When you launch the page you will see the appointment booking wizard.', 'eawp'); ?>
        </li>
    </ul>

    <?php _e('For more information visit the official website of the project at '
            . '<a href="http://easyappointments.org">http://easyappointments.org</a>.', 'eawp'); ?>
</div>
