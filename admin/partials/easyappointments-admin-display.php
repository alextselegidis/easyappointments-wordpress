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
        <img class="logo" src="<?= plugins_url('img/logo.png', __DIR__) ?>" alt="Easy!Appointments Logo"/>
        <h1 class="plugin-title">
            Easy!Appointments - WordPress Plugin
            <img class="loading hidden" src="<?= admin_url('images/wpspin_light-2x.gif') ?>" alt="Loading">
        </h1>
    </div>

    <p>
        <?php _e('This plugin will allow you to connect an existing Easy!Appointments installation via URL and use '
            . 'the <strong>[easyappointments]</strong> shortcode into any page so that end-users can book without ever leaving your site.',
            'easyappointments') ?>
    </p>

    <p>
        <a title="<?php _e('How does it work?', 'easyappointments') ?>"
           href="#TB_inline?width=500&height=400&inlineId=hints"
           class="thickbox">
            <?php _e('How does it work?', 'easyappointments') ?>
        </a>
    </p>

    <h3 class="title">
        <?php _e('Connect With Easy!Appointments', 'easyappointments') ?>
    </h3>

    <p>
        <?php _e('Set the public root URL of your Easy!Appointments installation and click the "Connect" button.', 'easyappointments') ?>
    </p>

    <table class="form-table">
        <tbody>
        <tr>
            <td>
                <label for="url">
                    <?php _e('URL', 'easyappointments') ?>
                </label>

                <input type="text" id="url" class="regular-text"
                       value="<?= esc_html(get_option('easyappointments_url')) ?>"/>

                <p class="description">
                    <small>
                        <?php _e('Example: ' . get_site_url() . '/easyappointments') ?>
                    </small>
                </p>
            </td>
        </tr>
        <tr>
            <td class="submit">
                <button id="connect" class="button button-primary connect-action">
                    <?php _e( 'Connect', 'easyappointments') ?>
                </button>

                <button id='disconnect' class="button disconnect-action" style="display: none">
                    <?php _e('Disconnect', 'easyappointments') ?>
                </button>
            </td>
        </tr>
        </tbody>
    </table>

    <br>

    <div id="hints" style="display:none">
        <h3>
            <?php _e('General Info', 'easyappointments') ?>
        </h3>

        <ul>
            <li>
                <h4>
                    <?php _e('Connect', 'easyappointments') ?>
                </h4>
                <?php _e('This button will connect an existing Easy!Appointments installation with your '
                    . 'WordPress site. Make sure that you use the correct installation URL of Easy!Appointments.', 'easyappointments') ?>
            </li>
            <li>
                <h4>
                    <?php _e('Disconnect', 'easyappointments') ?>
                </h4>
                <?php _e('This button will disconnect your WordPress site from the connected Easy!Appointments '
                    . 'installation.', 'easyappointments') ?>
            </li>
            <li>
                <h4>
                    <?php _e('Shortcode', 'easyappointments') ?>
                </h4>
                <?php _e('Display the booking wizard directly in your posts or pages by adding the [easyappointments] '
                    . 'shortcode. This shortcode accepts some optional attributes that will change its appearance, '
                    . 'such as "width", "height", "style". These will be automatically applied to the parent '
                    . 'container element (e.g. [easyappointments width="500px" height="300px" style="border: 2px solid black"]). '
                    . 'Additionally you can use the "provider" and "service" shortcode attributes to pre-select a '
                    . 'provider or a service or both on a certain page (e.g. [easyappointments provider="2" service="1"], '
                    . 'where "2" and "1" are the Easy!Appointments record IDs that can be retrieved from the Easy!Appointments '
                    . '"Users" and "Services" pages, by clicking the dedicated link of a record).',
                    'easyappointments') ?>
            </li>
        </ul>

        <h3>
            <?php _e('Troubleshooting', 'easyappointments') ?>
        </h3>

        <ul>
            <li>
                <h4>
                    <?php _e('Broken Connection', 'easyappointments') ?>
                </h4>
                <?php _e('If this settings page notifies you of a broken Easy!Appointments connection it could be that '
                    . 'the connected the installation URL was changed and the connection couldn\'t be verified. '
                    . '"Disconnect" from the current installation and then "Connect" again with updated information.', 'easyappointments') ?>
            </li>
            <li>
                <h4>
                    <?php _e('Support Forum', 'easyappointments') ?>
                </h4>
                <?php _e('If you encounter issues but you do not know what to do visit the official Easy!Appointments '
                    . 'support group where active users help each other solve their problems.', 'easyappointments') ?>
            </li>
            <li>
                <a href="https://groups.google.com/forum/#!categories/easy-appointments">
                    <?php _e('Support Group') ?>
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
