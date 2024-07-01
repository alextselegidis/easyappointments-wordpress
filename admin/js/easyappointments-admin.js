/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2017
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments Settings Page
 *
 * Defines the JS functionality of the admin settings page.
 */
(function ($) {
    'use strict';

    /**
     * Execute the connect operation with the provided data.
     */
    function connect() {
        var url = $('#url').val();

        if (!url) {
            return;
        }

        var data = {
            action: 'easyappointments_connect',
            url: url,
            nonce: EasyappointmentsConfig.Ajax.nonce
        };

        $.ajax({
            url: window.ajaxurl,
            data: data,
            method: 'POST',
            dataType: 'json'
        })
            .done(function (response) {
                if (response.exception) {
                    return EasyappointmentsPlugin.handleAjaxException(response);
                }

                $('.easyappointments .notification').remove();

                $('.easyappointments').prepend(
                    '<div class="updated notification">'
                    + '<span class="dashicons dashicons-yes"></span>'
                    + EasyappointmentsConfig.Lang.ConnectSuccessMessage
                    + '</div>'
                );

                EasyappointmentsPlugin.toggleActionButtons(true);
            })
            .fail(EasyappointmentsPlugin.handleAjaxFailure);
    }

    /**
     * Execute the disconnect operation with the provided data.
     */
    function disconnect() {
        var data = {
            action: 'easyappointments_disconnect',
            nonce: EasyappointmentsConfig.Ajax.nonce
        };

        $.ajax({
            url: window.ajaxurl,
            data: data,
            method: 'POST',
            dataType: 'json'
        })
            .done(function (response) {
                if (response.exception) {
                    return EasyappointmentsPlugin.handleAjaxException(response);
                }

                $('.easyappointments .notification').remove();

                $('.easyappointments').prepend(
                    '<div class="updated notification">'
                    + '<span class="dashicons dashicons-yes"></span>'
                    + EasyappointmentsConfig.Lang.DisconnectSuccessMesssage
                    + '</div>'
                );

                $('#url').val('');

                EasyappointmentsPlugin.toggleActionButtons(false);
            })
            .fail(EasyappointmentsPlugin.handleAjaxFailure);
    }

    // ------------------------------------------------------------------------
    //  INITIALIZE PAGE
    // ------------------------------------------------------------------------

    $('#connect').on('click', connect);

    $('#disconnect').on('click', disconnect);

    $(document).ajaxStart(function () {
        $('.easyappointments img.loading').removeClass('hidden');
    });

    $(document).ajaxComplete(function () {
        $('.easyappointments img.loading').addClass('hidden');
    });
})(jQuery);
