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
 * This WordPress administration page will accept user settings and display
 * information about the plugin and the supported operations.
 */

?>

<div class="wrap eawp">
    <img class="logo" src="<?php echo plugins_url('assets/img/logo.png', __DIR__); ?>"
            alt="Easy!Appointments Logo" />
    <h2>Easy!Appointments - WordPress Plugin</h2>
    <p>
        <?php _e('This plugin aims to bridge Easy!Appointments with WordPress and '
                . 'facilitate users in the integration of the appointment booking '
                . 'system to their WP pages. It offers useful functions such as the '
                . 'installation of Easy!Appointments directly from WordPress\' backend, '
                . 'the link of an existing installation and of course the display of '
                . 'the appointment booking wizard with the use of a simple shortcode.', 'eawp'); ?>
    </p>

    <h3 class="title"><?php _e('Link Information', 'eawp'); ?></h3>
    <p>
        <?php _e('Set the path and URL of your Easy!Appointments installation and '
                . 'press either the "Install" or "Link" button to proceed with the operation.', 'eawp'); ?>
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
                            <?php _e('Remove Easy!Appointments Files', 'eawp'); ?> *
                        </label>

                        <br>

                        <label for="remove-db-tables">
                            <input type="checkbox" id="remove-db-tables" >
                            <?php _e('Remove Easy!Appointments Database Tables', 'eawp'); ?> *
                        </label>
                    </fieldset>

                    <br>

                    <button id='unlink' class="button"><?php _e('Unlink', 'eawp'); ?></button>

                    <p class="description">* <?php _e('These actions cannot be undone!', 'eawp'); ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

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
            <?php _e('This operation will create a "link" between an existing Easy!Appointments installation '
                    . 'and your WordPress website. Make sure that you will set the correct installation '
                    . 'path and URL.', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Unlink', 'eawp'); ?>:</strong>
            <?php _e('This operation will unlink an active connection between Easy!Appointments and '
                    . 'your WordPress website. You might set whether you want the files and database '
                    . 'tables to be removed as well, even though this is optional.', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Shortcode', 'eawp'); ?>:</strong>
            <?php _e('If you want to show the Easy!Appointments booking wizard in a page of your '
                    . 'website you have to add the [easyappointments] shortcode. The shortcode accepts '
                    . 'optionally the following attributes: "width", "height", "style" which will style '
                    . 'the iframe element of your  page (e.g. [easyappointments width="500px" height="300px" '
                    . 'style="border: 2px solid black"]).', 'eawp'); ?>
        </li>
    </ul>

    <br>

    <h3 class="title"><?php _e('Troubleshooting', 'eawp'); ?></h3>
    <ul>
        <li>
            <strong><?php _e('Permission Problems', 'eawp'); ?>:</strong>
            <?php _e('Some plugin operations perform various filesystem tasks that might be interrupted due to '
                    . 'lack of permissions. This issues are more likely to happen in Unix environments where '
                    . 'PHP does not have the required permissions to read/write/delete files or directories. If '
                    . 'you cannot solve the problem try to perform the operation manually with an FTP user (e.g. '
                    . 'if the "Install" operation fails upload the latest E!A version manually and connect it with '
                    . 'WP through the "Link" operation).', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Broken Connection', 'eawp'); ?>:</strong>
            <?php _e('If this page informs you of a broken Easy!Appointments connection it could be that '
                    . 'the E!A files where moved or the installation URL was changed and the connection '
                    . 'couldn\'t be verified.  "Unlink" the current connection without removing the files '
                    . 'or database tables and then "Link" it again with the new information.', 'eawp'); ?>
        </li>
        <li>
            <strong><?php _e('Support Forum', 'eawp'); ?>:</strong>
            <?php _e('If you encounter problems but you do not know what to do visit the official Easy!Appointments '
                    . 'support group where can discuss them with active users from all over the world.', 'eawp'); ?>
        </li>
    </ul>

    <hr>

    <em>
        <?php _e('For more information visit the official website of the project at ', 'eawp'); ?>
        <a href="http://easyappointments.org">http://easyappointments.org</a>.
    </em>
</div>
