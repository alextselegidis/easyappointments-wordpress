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
    var $path = $('#path'),
        $url = $('#url');

    if ($path.val() === '' || $url.val() === '') {
        return; // no need to check
    }

    var data = {
        action: 'verify',
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
                        + '<span class="dashicons dashicons-yes"></span>'
                        + EAWP.Lang.VerificationFailure
                    + '</div>'
                );
            }
        })
        .fail(EAWP.Plugin.handleAjaxFailure);
});
