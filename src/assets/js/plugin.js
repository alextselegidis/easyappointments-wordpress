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
(function(exports, $) {

    'use strict';

    /**
     * Create an error message HTML output for the plugin page.
     *
     * @param  {string} message
     */
    function _showErrorMessage(message) {
        // Remove previous message and display a new one with exception information.
        $('.eawp div.error').remove();

        $('.eawp').prepend(
            '<div class="error">'
                + '<span class="dashicons dashicons-no"></span>'
                + message
            + '</div>'
        );
    }

    /**
     * Handle AJAX Exception
     *
     * This method will display exception information to the user.
     *
     * @param {object} exception
     */
    exports.handleAjaxException = function(exception) {
        var message = EAWP.Lang.AjaxExceptionMessage
                .replace('%file%', exception.file)
                .replace('%line%', exception.line)
                .replace('%message%', exception.message);

        _showErrorMessage(message)

        console.log('AJAX Exception: ', exception);
    };

    /**
     * Handle AJAX Failure
     *
     * This method must be bound to the "fail" method of the jqXHR object and must be executed whenever
     * the AJAX request was failed. It will also display a user friendly message to the plugin page.
     *
     * @param  {jqXHR} jqXHR
     * @param  {string} textStatus
     * @param  {Error} errorThrown
     */
    exports.handleAjaxFailure = function(jqXHR, textStatus, errorThrown) {
        var message = EAWP.Lang.AjaxFailureMessage.replace('%message%', errorThrown.message);

        _showErrorMessage(message);

        console.log('AJAX Failure: ', jqXHR, textStatus, errorThrown);
    };

})(EAWP.Plugin, jQuery);
