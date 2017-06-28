/* ----------------------------------------------------------------------------
* Easy!Appointments - WordPress Plugin
*
* @license GPLv3
* @copyright A.Tselegidis (C) 2017
* @link http://easyappointments.org
* @since v1.0.0
* ---------------------------------------------------------------------------- */

/**
* Easy!Appointments IFrame Handler
*
* This module will handle the booking wizard iframe operations.
*/
jQuery(function($) {

    'use strict';

    var $iframe = $('.easyappointments-wp-iframe'),
    initialHeight = $iframe.height();

    // Add "resize" watcher on the iframe content element so that the iframe always show the
    // whole page content (mostly useful for mobile views - vertical resize).
    function _resizeWatcher() {
        var $iframeContent = $('#book-appointment-wizard', $iframe.contents()),
            lastHeight = $iframeContent.height();

        setInterval(function() {
            $iframeContent = $('#book-appointment-wizard', $iframe.contents());

            if (lastHeight === $iframeContent.height()) {
                return;
            }

            var newHeight = ($iframeContent.height() > initialHeight) ? $iframeContent.height() : initialHeight;
            $iframe.height(newHeight);
            lastHeight = $iframeContent.height();
        }, 500);
    }

    $iframe.on('load', _resizeWatcher);
});
