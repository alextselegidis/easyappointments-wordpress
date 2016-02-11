/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
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

    /**
     * Toggle the visibility status of the operation buttons.
     *
     * @param {Boolean} linkStatus A true value states that there is an active connection while
     * a false indicates that there is no active connection.
     */
    function _toggleOperationButtons(linkStatus) {
        if (linkStatus) {
            $('.link-operations').hide();
            $('.unlink-operations').show();
        } else {
            $('.link-operations').show();
            $('.unlink-operations').hide();
        }
    }

    var $path = $('#path'),
        $url = $('#url');

    if ($path.val() === '' || $url.val() === '') {
        _toggleOperationButtons(false);
        return; // no need to check
    }

    var data = {
        action: 'verify-state',
        path: $path.val(),
        url: $url.val()
    };

    $.ajax({
        url: window.ajaxurl,
        data: data,
        method: 'POST',
        dataType: 'json'
    })
        .done(function(response) {
            _toggleOperationButtons(response.success);

            if (response.exception) {
                return EAWP.Plugin.handleAjaxException(response);
            }

            if (response.success) {
                $('.eawp').prepend(
                    '<div class="updated">'
                        + '<span class="dashicons dashicons-yes"></span>'
                        + EAWP.Lang.VerificationSuccess
                    + '</div>'
                );
            } else {
                $('.eawp').prepend(
                    '<div class="error">'
                        + '<span class="dashicons dashicons-no"></span>'
                        + EAWP.Lang.VerificationFailure
                    + '</div>'
                );
            }
        })
        .fail(EAWP.Plugin.handleAjaxFailure);

});
