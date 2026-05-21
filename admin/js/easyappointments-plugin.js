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
     * Display a user-friendly error notification.
     *
     * Accepts either a plain string or an object with:
     *   { title, message, details }
     *
     * @param {string|object} payload
     */
    function showErrorMessage(payload) {
        var title, message, details;

        if (typeof payload === 'string') {
            title   = EasyappointmentsConfig.Lang.ErrorTitle;
            message = payload;
            details = null;
        } else {
            title   = payload.title   || EasyappointmentsConfig.Lang.ErrorTitle;
            message = payload.message || EasyappointmentsConfig.Lang.UnknownError;
            details = payload.details || null;
        }

        var detailsHtml = '';
        if (details) {
            detailsHtml = '<details class="ea-notification-details">'
                + '<summary>' + EasyappointmentsConfig.Lang.ShowTechnicalDetails + '</summary>'
                + '<pre>' + details + '</pre>'
                + '</details>';
        }

        $('.easyappointments .notification').remove();
        $('.easyappointments').prepend(
            '<div class="notification ea-notification ea-notification--error">'
            + '<span class="dashicons dashicons-warning ea-notification-icon"></span>'
            + '<div class="ea-notification-content">'
            + '<strong class="ea-notification-title">' + title + '</strong>'
            + '<p class="ea-notification-message">' + message + '</p>'
            + detailsHtml
            + '</div>'
            + '</div>'
        );
    }

    /**
     * Display a user-friendly success notification.
     *
     * @param {string} message
     */
    function showSuccessMessage(message) {
        $('.easyappointments .notification').remove();
        $('.easyappointments').prepend(
            '<div class="notification ea-notification ea-notification--success">'
            + '<span class="dashicons dashicons-yes-alt ea-notification-icon"></span>'
            + '<div class="ea-notification-content">'
            + '<p class="ea-notification-message">' + message + '</p>'
            + '</div>'
            + '</div>'
        );
    }

    /**
     * Handle a structured AJAX exception object ({ message, file, line }).
     *
     * @param {object} exception
     */
    function handleAjaxException(exception) {
        var details = null;
        if (exception && (exception.file || exception.line)) {
            var parts = [];
            if (exception.file) { parts.push(exception.file); }
            if (exception.line) { parts.push('(line ' + exception.line + ')'); }
            details = parts.join(' ');
        }

        showErrorMessage({
            title:   EasyappointmentsConfig.Lang.ErrorTitle,
            message: (exception && exception.message)
                ? exception.message
                : EasyappointmentsConfig.Lang.UnknownError,
            details: details
        });

        console.error('AJAX Exception:', exception);
    }

    /**
     * Handle a low-level AJAX / network failure.
     *
     * @param {jqXHR}  jqXHR
     * @param {string} textStatus
     * @param {Error}  errorThrown
     */
    function handleAjaxFailure(jqXHR, textStatus, errorThrown) {
        showErrorMessage({
            title:   EasyappointmentsConfig.Lang.ErrorTitle,
            message: EasyappointmentsConfig.Lang.AjaxFailureMessage,
            details: errorThrown || textStatus || null
        });

        console.error('AJAX Failure:', jqXHR, textStatus, errorThrown);
    }

    /**
     * Toggle the visibility of the action buttons.
     *
     * @param {boolean} connectionStatus  true = connected, false = disconnected
     */
    function toggleActionButtons(connectionStatus) {
        $('.connect-action').show();

        if (connectionStatus) {
            $('.disconnect-action').show();
        } else {
            $('.disconnect-action').hide();
        }
    }

    window.EasyappointmentsPlugin = {
        handleAjaxException:  handleAjaxException,
        handleAjaxFailure:    handleAjaxFailure,
        toggleActionButtons:  toggleActionButtons,
        showErrorMessage:     showErrorMessage,
        showSuccessMessage:   showSuccessMessage
    };

})(jQuery);

