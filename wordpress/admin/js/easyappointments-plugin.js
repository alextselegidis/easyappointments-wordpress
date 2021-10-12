/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2017
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments WP Plugin
 *
 * This module adds common JS functionality that is shared between the other modules.
 */
(function ($) {
    'use strict';

    /**
     * Create an error message HTML output for the plugin page.
     *
     * @param  {string} message
     */
    function showErrorMessage(message) {
        // Remove previous message and display a new one with exception information.
        $('.easyappointments .notification').remove();

        $('.easyappointments').prepend(
            '<div class="error notification">'
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
    function handleAjaxException(exception) {
        var message = EasyappointmentsConfig.Lang.AjaxExceptionMessage
            .replace('%file%', exception.file)
            .replace('%line%', exception.line)
            .replace('%message%', exception.message);

        showErrorMessage(message);

        console.log('AJAX Exception: ', exception);
    }

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
    function handleAjaxFailure(jqXHR, textStatus, errorThrown) {
        var message = EasyappointmentsConfig.Lang.AjaxFailureMessage.replace('%message%', errorThrown.message);

        showErrorMessage(message);

        console.log('AJAX Failure: ', jqXHR, textStatus, errorThrown);
    }

    /**
     * Toggle the visibility status of the action buttons.
     *
     * @param {Boolean} connectionStatus A true value states that there is an active connection while
     * a false indicates that there is no active connection.
     */
    function toggleActionButtons(connectionStatus) {
        if (connectionStatus) {
            $('.connect-actions').hide();
            $('.disconnect-actions').show();
        } else {
            $('.connect-actions').show();
            $('.disconnect-actions').hide();
        }
    }

    window.EasyappointmentsPlugin = {
        handleAjaxException: handleAjaxException,
        handleAjaxFailure: handleAjaxFailure,
        toggleActionButtons: toggleActionButtons
    };

})(jQuery);
