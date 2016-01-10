<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2016
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

namespace EAWP\Core\Operations;

use \EAWP\Core\Plugin;

/**
 * Shortcode Class
 *
 * This class will handle the addition of the booking wizard in a WordPress post/page
 * with the use of a simple short code ("easyappointments").
 *
 * @todo Implement Shortcode Operation
 */
class Shortcode implements \EAWP\Core\Interfaces\IOperation {
    /**
     * Easy!Appointments WordPress Plugin Instance
     *
     * @var EAWP\Core\Plugin
     */
    protected $plugin;

    /**
     * Class Constructor
     *
     * @param EAWP\Core\Plugin $plugin Easy!Appointments WordPress Plugin Instance
     */
    public function __construct(Plugin $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * Invoke Shortcode Operation
     *
     * This operation must include the E!A booking form into a page that  has the
     * "easyappointments" shortcode. The shortcode binding is done from the core
     * plugin and this operation must resolve all the dependencies and load the
     * booking form inside the page so that website users can book an appointment.
     */
    public function invoke() {

    }
}
