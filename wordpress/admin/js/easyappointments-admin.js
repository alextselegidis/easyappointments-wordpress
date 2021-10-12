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
     * Execute the install operation with the provided data.
     */
    function install() {
        var data = {
            action: 'easyappointments_install',
            path: $('#path').val(),
            url: $('#url').val(),
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
                    + EasyappointmentsConfig.Lang.InstallationSuccessMessage
                    + ' &rarr; '
                    + '<a href="' + data.url + '" target="_blank">' + data.url + '</a>'
                    + '</div>'
                );

                EasyappointmentsPlugin.toggleActionButtons(true);
            })
            .fail(EasyappointmentsPlugin.handleAjaxFailure);
    }

    /**
     * Execute the connect operation with the provided data.
     */
    function connect() {
        var data = {
            action: 'easyappointments_connect',
            path: $('#path').val(),
            url: $('#url').val(),
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
            path: $('#path').val(),
            url: $('#url').val(),
            remove_files: $('#remove-files').prop('checked'),
            remove_db_tables: $('#remove-db-tables').prop('checked'),
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

                $('#path, #url').val('');

                $('#remove-files, #remove-db-tables').prop('checked', false);

                EasyappointmentsPlugin.toggleActionButtons(false);
            })
            .fail(EasyappointmentsPlugin.handleAjaxFailure);
    }

    // ------------------------------------------------------------------------
    //  INITIALIZE PAGE
    // ------------------------------------------------------------------------

    $('#install').on('click', install);

    $('#connect').on('click', connect);

    $('#disconnect').on('click', disconnect);

    $(document).ajaxStart(function () {
        $('.easyappointments img.loading').removeClass('hidden');
    });

    $(document).ajaxComplete(function () {
        $('.easyappointments img.loading').addClass('hidden');
    });
})(jQuery);
