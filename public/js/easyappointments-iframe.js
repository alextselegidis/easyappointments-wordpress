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
 * Grows the booking form iframe so that it always fits its content and the form never gets a
 * scrollbar of its own. This matters most on phones, where the form stacks vertically and needs
 * considerably more room than the configured height.
 *
 * Measuring the content is only possible when the Easy!Appointments installation is served from the
 * same origin as the WordPress site. Cross-origin installations fall back to the min-height that
 * easyappointments-public.css declares for narrow viewports.
 */
(function ($) {
    'use strict';

    /**
     * Get the booking wizard element inside an iframe.
     *
     * @param {HTMLIFrameElement} iframe
     *
     * @return {HTMLElement|null} Null when the installation is on another origin.
     */
    function getWizard(iframe) {
        try {
            var doc = iframe.contentDocument;

            return doc ? doc.getElementById('book-appointment-wizard') : null;
        } catch (e) {
            return null; // Cross-origin installation, the height cannot be read.
        }
    }

    /**
     * Match the iframe height to the height of the booking form.
     *
     * The configured height acts as the lower bound, so an iframe never becomes shorter than the
     * author asked for.
     *
     * @param {HTMLIFrameElement} iframe
     * @param {HTMLElement} wizard
     */
    function resize(iframe, wizard) {
        var $iframe = $(iframe);
        var minHeight = parseInt($iframe.attr('height'), 10) || 0;

        $iframe.css('height', Math.max(wizard.scrollHeight, minHeight) + 'px');
    }

    /**
     * Keep the iframe in sync with the booking form, which changes height as the visitor moves
     * between steps.
     *
     * @param {HTMLIFrameElement} iframe
     */
    function watch(iframe) {
        var wizard = getWizard(iframe);

        if (!wizard) {
            return;
        }

        resize(iframe, wizard);

        // ponytail: no polling fallback for browsers without ResizeObserver (pre-2020) - they keep
        // the CSS min-height instead, which is why it is only dropped here.
        if (!window.ResizeObserver) {
            return;
        }

        $(iframe).css('min-height', 0);

        if (iframe.easyAppointmentsObserver) {
            iframe.easyAppointmentsObserver.disconnect(); // The iframe navigated, drop the old one.
        }

        iframe.easyAppointmentsObserver = new ResizeObserver(function () {
            resize(iframe, wizard);
        });

        iframe.easyAppointmentsObserver.observe(wizard);
    }

    $(function () {
        $('.easyappointments-iframe').each(function () {
            var iframe = this;

            $(iframe).on('load', function () {
                watch(iframe);
            });

            watch(iframe); // The iframe may already have loaded before this ran.
        });
    });
})(jQuery);
