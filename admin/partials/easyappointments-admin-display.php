<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2017
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/*
 * This WordPress administration page will accept user settings and display
 * information about the plugin and the supported operations.
 */

add_thickbox();

?>

<div class="wrap easyappointments">
    <div class="header">
        <img class="logo" src="<?= plugins_url('img/logo.png', __DIR__) ?>"
             alt="Easy!Appointments Logo"/>
        <h1>
            Easy!Appointments - WordPress Plugin
            <img class="loading hidden" src="<?= admin_url('images/wpspin_light-2x.gif') ?>">
        </h1>
    </div>
    <p>
        <?php _e('Integrate the booking form of Easy!Appointments directly into your WordPress pages. This plugin will  '
            . 'let you create a new Easy!Appointments installation or use an existing one directly from the WordPress '
            . 'back-end section. Add the [easyappointments] shortcode into your pages and leverage your conversion rates.',
            'easyappointments') ?>
    </p>

    <p>
        <a title="<?php _e('Hints', 'easyappointments') ?>"
           href="#TB_inline?width=500&height=400&inlineId=hints"
           class="thickbox"><?php _e('Hints', 'easyappointments') ?></a>
        |
        <a title="<?php _e('Troubleshooting', 'easyappointments') ?>"
           href="#TB_inline?width=500&height=400&inlineId=troubleshooting"
           class="thickbox"><?php _e('Troubleshooting', 'easyappointments') ?></a>
        |
        <a title="<?php _e('About', 'easyappointments') ?>"
           href="#TB_inline?width=500&height=400&inlineId=about"
           class="thickbox"><?php _e('About', 'easyappointments') ?></a>
    </p>

    <h3 class="title"><?php _e('Connection Information', 'easyappointments') ?></h3>
    <p>
        <?php _e('Set the path and URL of your Easy!Appointments installation and '
            . 'press either the "Install" or "Connect" button.', 'easyappointments') ?>
    </p>

    <table class="form-table">
        <tbody>
        <tr>
            <td>
                <label for="path"><?php _e('Path', 'easyappointments') ?></label>

                <input type="text" id="path" class="regular-text"
                       value="<?= esc_html(get_option('easyappointments_path')) ?>"/>
                <p class="description">
                    <?php _e('Example: ' . str_replace('\\', '/', ABSPATH . 'easyappointments')); ?>
                </p>

                <p class="description">
                    <?php _e('* Make sure that the target directory exists on the server and it\'s writable.') ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <label for="url"><?php _e('URL', 'easyappointments') ?></label>

                <input type="text" id="url" class="regular-text"
                       value="<?= esc_html(get_option('easyappointments_url')) ?>"/>
                <p class="description">
                    <?php _e('Example: ' . get_site_url() . '/easyappointments') ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="submit connect-actions hidden">
                <button id='install' class="button button-primary"><?php _e('Install', 'easyappointments') ?></button>
                <button id='connect' class="button"><?php _e('Connect', 'easyappointments') ?></button>
            </td>
            <td class="sublime disconnect-actions hidden">
                <fieldset>
                    <label for="remove-files">
                        <input type="checkbox" id="remove-files">
                        <?php _e('Remove Easy!Appointments Files', 'easyappointments') ?> *
                    </label>

                    <br>

                    <label for="remove-db-tables">
                        <input type="checkbox" id="remove-db-tables">
                        <?php _e('Remove Easy!Appointments Database Tables', 'easyappointments') ?> *
                    </label>
                </fieldset>

                <br>

                <button id='disconnect' class="button"><?php _e('Disconnect', 'easyappointments') ?></button>

                <p class="description">* <?php _e('These actions cannot be undone!', 'easyappointments') ?></p>
            </td>
        </tr>
        </tbody>
    </table>

    <br>

    <div id="hints" style="display:none">
        <ul>
            <li>
                <h4><?php _e('Install', 'easyappointments') ?></h4>
                <?php _e('This button will create a new installation by placing and configuring '
                    . 'Easy!Appointments files into the requested directory. You will '
                    . 'have to complete the installation by opening the target URL in your browser.', 'easyappointments') ?>
            </li>
            <li>
                <h4><?php _e('Connect', 'easyappointments') ?></h4>
                <?php _e('This button will connect an existing Easy!Appointments installation and your '
                    . 'WordPress website. Make sure that you use the correct installation '
                    . 'path and URL of Easy!Appointments.', 'easyappointments') ?>
            </li>
            <li>
                <h4><?php _e('Disconnect', 'easyappointments') ?></h4>
                <?php _e('This button will disconnect an active connection between Easy!Appointments and '
                    . 'your WordPress website. You can remove the files and database tables as well, even '
                    . 'though this is optional.', 'easyappointments') ?>
            </li>
            <li>
                <h4><?php _e('Shortcode', 'easyappointments') ?></h4>
                <?php _e('Display the booking form directly in your pages or posts by adding the [easyappointments] '
                    . 'shortcode. This shortcode accepts some optional attributes that will change its appearance. '
                    . 'These attibutes are "width", "height", "style" and will be applied automatically to the parent '
                    . 'container element (e.g. [easyappointments width="500px" height="300px" style="border: 2px solid black"]). '
                    . 'Additionally you can use the "provider" and "service" shortcode attributes to preselect a '
                    . 'provider or a service or both on a certain page (e.g. [easyappointments provider="2" service="1"], '
                    . 'where "2" and "1" are the record IDs, they can be fetched from the Easy!Appointments backend section, '
                    . 'in the users and services page accordingly by clicking the dedicated link of a record).',
                    'easyappointments') ?>
            </li>
        </ul>
    </div>

    <br>

    <div id="troubleshooting" style="display:none">
        <ul>
            <li>
                <h4><?php _e('Permission Problems', 'easyappointments') ?></h4>
                <?php _e('Some plugin operations perform various filesystem tasks that might be interrupted due to '
                    . 'lack of permissions. This issues mostly happen in Unix environments because '
                    . 'PHP does not have the required permissions to read/write/delete files or directories. If '
                    . 'you cannot solve the problem try to continue the operation manually with an FTP user (e.g. '
                    . 'if the "Install" operation fails, upload the latest Easy!Appointments version manually and '
                    . 'connect it with WordPress with the "Connect" action).', 'easyappointments') ?>
            </li>
            <li>
                <h4><?php _e('Broken Connection', 'easyappointments') ?></h4>
                <?php _e('If this settings page notifies you of a broken Easy!Appointments connection it could be that '
                    . 'the Easy!Appointments files where moved or the installation URL was changed and the connection '
                    . 'couldn\'t be verified.  "Disconnect" the current connection without removing the files '
                    . 'or database tables and then "Connect" it again with the new information.', 'easyappointments') ?>
            </li>
            <li>
                <h4><?php _e('Support Forum', 'easyappointments') ?></h4>
                <?php _e('If you encounter issues but you do not know what to do visit the official Easy!Appointments '
                    . 'support group where active users help each other solve their problems.', 'easyappointments') ?>
            </li>
            <li>
                <a href="https://groups.google.com/forum/#!categories/easy-appointments"><?php _e('Support Group') ?></a>
            </li>
        </ul>
    </div>

    <div id="about" style="display:none">
        <ul>
            <li>
                <img src="<?= esc_url(plugins_url('img/about.png', __DIR__)) ?>"
                     alt="Easy!Appointments appointment scheduling integration for WordPress.">
            </li>
            <li>
                <h4><?php _e('Easy!Appointments - WordPress Plugin', 'easyappointments') ?></h4>

                <?php _e('Leverage your conversion rates by integrating the booking form directly in your WordPress pages. '
                    . 'Customers will never have to leave your website for booking an appointment. Take advantage of '
                    . 'the scheduling power of Easy!Appointment which will run smoothly with your WordPress installation.'
                    . 'Include the booking form in your pages with the [easyappointments] shortcode.',
                    'easyappointments') ?>
            </li>

            <li>
                <h4><?php _e('Get Involved', 'easyappointments') ?></h4>
                <?php _e('Found a problem or want to add a new feature? Contributors are more than welcome so feel '
                    . 'free to file an issue or make pull requests on the GitHub page of the plugin.', 'easyappointments') ?>

            </li>
            <li>
                <a href="https://github.com/alextselegidis/easyappointments-wordpress-plugin">
                    Star and Fork on GitHub
                </a>
            </li>
        </ul>
    </div>

    <hr>

    <em>
        <?php _e('For more information visit the official website of the project at ', 'easyappointments') ?>
        <a href="https://easyappointments.org">easyappointments.org</a>.
    </em>
</div>
