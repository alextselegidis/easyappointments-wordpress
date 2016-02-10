/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

EAWP.Plugin = EAWP.Plugin || {};

/**
 * Easy!Appointments WP Plugin
 *
 * This module adds common JS functionality that is shared between the other modules.
 */
(function(exports) {

    'use strict';

    /**
     * Handle AJAX exception.
     *
     * This method will display exception information to the user.
     *
     * @param {object} exception
     */
    exports.handleAjaxException = function(exception) {
        // Remove previous message and display a new one with exception information.
        $('.eawp div.error').remove();

        var message = EAWP.Lang.AjaxExceptionMessage
                .replace('%file%', exception.file)
                .replace('%line%', exception.line)
                .replace('%message%', exception.message);

        $('.eawp').prepend(
            '<div class="error">'
                + '<span class="dashicons dashicons-flag"></span>'
                + exception
            + '</div>'
        );

        console.log('AJAX Exception: ', exception);
    };

})(EAWP.Plugin);
