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
 * If there are link information, this module will make an AJAX request to the main plugin
 * in order to trigger the "Verify State" operation and display the result to the settings
 * page of the plugin.
 */
jQuery(function($) {

    'use strict';

    var $path = $('#path');
    var $url = $('#url');

    if ($path.val() === '' || $url.val() === '') {
        EAWP.Plugin.toggleOperationButtons(false);
        return; // no need to check
    }

    var data = {
        action: 'verify-state',
        path: $path.val(),
        url: $url.val(),
        nonce: EAWP.Plugin.nonce
    };

    $.ajax({
        url: window.ajaxurl,
        data: data,
        method: 'POST',
        dataType: 'json'
    })
        .done(function(response) {
            var status = !response.exception;
            EAWP.Plugin.toggleOperationButtons(status);

            $('.eawp .notification').remove();

            if (!response.exception) {
                $('.eawp').prepend(
                    '<div class="updated notification">'
                        + '<span class="dashicons dashicons-yes"></span>'
                        + EAWP.Lang.VerificationSuccess
                    + '</div>'
                );
            } else {
                $('.eawp').prepend(
                    '<div class="error notification">'
                        + '<span class="dashicons dashicons-no"></span>'
                        + EAWP.Lang.VerificationFailure
                    + '</div>'
                );
            }
        })
        .fail(EAWP.Plugin.handleAjaxFailure);

});
