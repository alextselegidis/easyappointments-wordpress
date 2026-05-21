<?php

/**
 * Elementor widget for embedding the Easy!Appointments booking page.
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/includes
 */
class Easyappointments_Elementor {

    /**
     * Register the Elementor widget once Elementor is ready.
     */
    public function register() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            return;
        }

        add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
    }

    /**
     * Register the widget with Elementor's widget manager.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager
     */
    public function register_widget( $widgets_manager ) {
        require_once __DIR__ . '/class-easyappointments-elementor-widget.php';
        $widgets_manager->register( new Easyappointments_Elementor_Widget() );
    }
}
