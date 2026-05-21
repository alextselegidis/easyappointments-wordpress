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
     * Check whether a string is a valid http/https URL.
     *
     * @param  {string} value
     * @return {boolean}
     */
    function isValidUrl(value) {
        try {
            var url = new URL(value.trim());
            return url.protocol === 'http:' || url.protocol === 'https:';
        } catch (_) {
            return false;
        }
    }

    /**
     * Execute the connect operation with the provided data.
     */
    function connect() {
        var url = $('#url').val().trim();

        if (!url) {
            return;
        }

        if (!isValidUrl(url)) {
            EasyappointmentsPlugin.showErrorMessage(EasyappointmentsConfig.Lang.InvalidUrlMessage);
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
                if (response && response.exception) {
                    return EasyappointmentsPlugin.handleAjaxException(response.exception);
                }

                EasyappointmentsPlugin.showSuccessMessage(EasyappointmentsConfig.Lang.ConnectSuccessMessage);
                EasyappointmentsPlugin.toggleActionButtons(true);
            })
            .fail(EasyappointmentsPlugin.handleAjaxFailure);
    }

    /**
     * Execute the disconnect operation with the provided data.
     */
    function disconnect() {
        if (!confirm(EasyappointmentsConfig.Lang.DisconnectPrompt)) {
            return;
        }

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
                if (response && response.exception) {
                    return EasyappointmentsPlugin.handleAjaxException(response.exception);
                }

                EasyappointmentsPlugin.showSuccessMessage(EasyappointmentsConfig.Lang.DisconnectSuccessMessage);

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

    $(document).on('click', '.ea-method-card', function () {
        var method = $(this).data('method');

        $('.ea-method-card').removeClass('active');
        $(this).addClass('active');

        $('.ea-instruction-panel').hide();
        $('#ea-instructions-' + method).show();
        $('#ea-instructions').slideDown(200);
    });

    $(document).ajaxStart(function () {
        $('.easyappointments .ea-loading').removeClass('hidden');
    });

    $(document).ajaxComplete(function () {
        $('.easyappointments .ea-loading').addClass('hidden');
    });
})(jQuery);
