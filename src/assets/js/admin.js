/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Admin Class
 *
 * This class handles the JavaScript functionality of the plugin's settings page.
 *
 * @module admin
 */
(function($) {
    /**
     * Module Reference Object
     *
     * @type {object}
     */
    var $this = this;

    /**
     * Bind page event handlers.
     */
    $this.events = function() {
        $('#install').on('click', function(event) {
            $this.install();
        });

        $('#bridge').on('click', function(event) {
            $this.bridge();
        });
    };

    /**
     * Execute the install operation with the provided data.
     */
    $this.install = function() {
        var data = {
            action: 'install',
            path: $('#path').val(),
            url: $('#url').val()
        };

        $.post(window.ajaxurl, data, function(response) {
            if (response.exception)
                Admin.prototype.handleException(response);
            $('.eawp').prepend(
                '<div class="updated">'
                    + '<span class="dashicons dashicons-yes"></span>'
                    + EAWP.Lang.InstallationSuccessMessage
                + '</div>'
            );
        }, 'json');
    };

    /**
     * Execute the bridge operation with the provided data.
     */
    $this.bridge = function() {
        var data = {
            action: 'bridge',
            path: $('#path').val(),
            url: $('#url').val()
        };

        $.post(window.ajaxurl, data, function(response) {
            if (response.exception)
                Admin.prototype.handleException(response);
            $('.eawp').prepend(
                '<div class="updated">'
                    + '<span class="dashicons dashicons-yes"></span>'
                    + EAWP.Lang.BridgeSuccessMessage
                + '</div>'
            );
        }, 'json');
    };

    /**
     * Handle AJAX exception.
     *
     * This method will display exception information to the user.
     *
     * @param  {[type]} exception [description]
     * @return {[type]}           [description]
     */
    $this.handleException = function(exception) {
        // Remove previous message and display a new one with exception information.
        $('.eawp div.error').remove();

        var message = EAWP.Lang.AjaxExceptionMessage
                .replace('%file%', exception.file)
                .replace('%line%', exception.line)
                .replace('%message%', exception.message);


        $('.eawp').prepend(
            '<div class="error">'
                + '<span class="dashicons dashicons-flag"></span>'
                + exception
            + '</div>'
        );

        console.log('AJAX Exception: ', exception);
    };

    // ------------------------------------------------------------------------
    //  INITIALIZE PAGE
    // ------------------------------------------------------------------------
    $this.events();

})(jQuery);
