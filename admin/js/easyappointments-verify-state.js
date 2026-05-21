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

    var $url = $('#url');

    if ($url.val() === '') {
        EasyappointmentsPlugin.toggleActionButtons(false);
        return; // no need to check
    }

    var data = {
        action: 'easyappointments_verify_state',
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
            var connected = !(response && response.exception);

            EasyappointmentsPlugin.toggleActionButtons(connected);

            if (connected) {
                EasyappointmentsPlugin.showSuccessMessage(EasyappointmentsConfig.Lang.VerificationSuccess);
            } else {
                EasyappointmentsPlugin.handleAjaxException(response.exception);
            }
        })
        .fail(EasyappointmentsPlugin.handleAjaxFailure);
})(jQuery);
