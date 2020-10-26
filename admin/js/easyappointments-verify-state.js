/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2017
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Verify Connection State
 *
 * If there are link information, this module will make an AJAX request to the main plugin in order to trigger the
 * "Verify State" operation and display the result to the settings page of the plugin.
 */
(function ($) {
    'use strict';

    var $path = $('#path');
    var $url = $('#url');

    if ($path.val() === '' || $url.val() === '') {
        EasyappointmentsPlugin.toggleActionButtons(false);
        return; // no need to check
    }

    var data = {
        action: 'easyappointments_verify_state',
        path: $path.val(),
        url: $url.val(),
        nonce: EasyappointmentsConfig.Ajax.nonce
    };

    $.ajax({
        url: window.ajaxurl,
        data: data,
        method: 'POST',
        dataType: 'json'
    })
        .done(function (response) {
            var status = !response.exception;
            EasyappointmentsPlugin.toggleActionButtons(status);

            $('.easyappointments .notification').remove();

            if (!response.exception) {
                $('.easyappointments').prepend(
                    '<div class="updated notification">'
                    + '<span class="dashicons dashicons-yes"></span>'
                    + EasyappointmentsConfig.Lang.VerificationSuccess
                    + '</div>'
                );
            } else {
                $('.easyappointments').prepend(
                    '<div class="error notification">'
                    + '<span class="dashicons dashicons-no"></span>'
                    + EasyappointmentsConfig.Lang.VerificationFailure
                    + '</div>'
                );
            }
        })
        .fail(EasyappointmentsPlugin.handleAjaxFailure);
})(jQuery);
