/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
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

     var $iframe = $('.easyappointments-wp-iframe');

     // Add "resize" watcher on the iframe content element so that the iframe always show the whole
     // page content (mostly useful for mobile views).
     function _resizeWatcher() {
         var $iframeContent = $('#book-appointment-wizard', $iframe.contents()),
             lastWidth = $iframeContent.width(),
             lastHeight = $iframeContent.height();

         setInterval(function() {
             $iframeContent = $('#book-appointment-wizard', $iframe.contents());

             if (lastWidth === $iframeContent.width() && lastHeight === $iframeContent.height()) {
                 return;
             }

             $iframe.width($iframeContent.width());
             $iframe.height($iframeContent.height());
             lastWidth = $iframeContent.width();
             lastHeight = $iframeContent.height();
         }, 500);
     }

     $iframe.on('load', _resizeWatcher);
});
