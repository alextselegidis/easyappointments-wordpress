<?php

/**
 * Elementor widget: Easy!Appointments Booking Page.
 *
 * Embeds the Easy!Appointments booking form via an iframe,
 * with the same properties available in the Gutenberg block
 * and the [easyappointments] shortcode.
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/includes
 */
class Easyappointments_Elementor_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'easyappointments';
    }

    public function get_title() {
        return __( 'Easy!Appointments', 'easyappointments' );
    }

    public function get_icon() {
        return 'eicon-calendar';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'booking', 'appointment', 'scheduler', 'calendar', 'easy appointments' ];
    }

    protected function register_controls() {

        /* ----------------------------------------------------------------
         * Section: Booking Page
         * --------------------------------------------------------------- */
        $this->start_controls_section(
            'section_booking',
            [
                'label' => __( 'Booking Page', 'easyappointments' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'width',
            [
                'label'       => __( 'Width', 'easyappointments' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '100%',
                'placeholder' => '100%',
                'description' => __( 'CSS value, e.g. 100%, 800px.', 'easyappointments' ),
            ]
        );

        $this->add_control(
            'height',
            [
                'label'       => __( 'Height', 'easyappointments' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '1000px',
                'placeholder' => '1000px',
                'description' => __( 'CSS value, e.g. 600px, 80vh.', 'easyappointments' ),
            ]
        );

        $this->add_control(
            'iframe_style',
            [
                'label'       => __( 'Custom CSS (iframe)', 'easyappointments' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => 'border: none;',
                'description' => __( 'Optional inline CSS applied to the iframe element.', 'easyappointments' ),
                'rows'        => 3,
            ]
        );

        $this->end_controls_section();

        /* ----------------------------------------------------------------
         * Section: Pre-selection
         * --------------------------------------------------------------- */
        $this->start_controls_section(
            'section_preselection',
            [
                'label' => __( 'Pre-selection', 'easyappointments' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'provider',
            [
                'label'       => __( 'Provider ID', 'easyappointments' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min'         => 1,
                'default'     => '',
                'description' => __( 'Pre-select a provider by their numeric ID (optional).', 'easyappointments' ),
            ]
        );

        $this->add_control(
            'service',
            [
                'label'       => __( 'Service ID', 'easyappointments' ),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'min'         => 1,
                'default'     => '',
                'description' => __( 'Pre-select a service by its numeric ID (optional).', 'easyappointments' ),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $url      = get_option( 'easyappointments_url' );

        if ( empty( $url ) ) {
            if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                echo '<p style="padding:16px;background:#fff3cd;border-left:4px solid #ffc107;">'
                    . esc_html__( 'Easy!Appointments: no booking URL configured. Go to Easy!Appts → Settings to connect your installation.', 'easyappointments' )
                    . '</p>';
            }
            return;
        }

        $query_data = [];

        if ( ! empty( $settings['provider'] ) ) {
            $query_data['provider'] = intval( $settings['provider'] );
        }

        if ( ! empty( $settings['service'] ) ) {
            $query_data['service'] = intval( $settings['service'] );
        }

        if ( ! empty( $query_data ) ) {
            $url .= ( strpos( $url, '?' ) === false ? '?' : '&' ) . http_build_query( $query_data );
        }

        $width       = ! empty( $settings['width'] )        ? $settings['width']        : '100%';
        $height      = ! empty( $settings['height'] )       ? $settings['height']       : '1000px';
        $iframe_style = ! empty( $settings['iframe_style'] ) ? $settings['iframe_style'] : '';

        printf(
            '<iframe class="easyappointments-iframe" src="%s" width="%s" height="%s" style="%s" frameborder="0" allowtransparency="true"></iframe>',
            esc_attr( $url ),
            esc_attr( $width ),
            esc_attr( $height ),
            esc_attr( $iframe_style )
        );
    }

    /**
     * Render a JS template for the Elementor editor live preview.
     */
    protected function content_template() {
        ?>
        <#
        var url      = '<?php echo esc_js( get_option( 'easyappointments_url', '' ) ); ?>';
        var width    = settings.width    || '100%';
        var height   = settings.height   || '1000px';
        var style    = settings.iframe_style || '';
        var query    = [];

        if ( settings.provider ) { query.push( 'provider=' + settings.provider ); }
        if ( settings.service  ) { query.push( 'service='  + settings.service  ); }
        if ( query.length && url ) { url += ( url.indexOf('?') === -1 ? '?' : '&' ) + query.join('&'); }
        #>
        <# if ( url ) { #>
            <iframe class="easyappointments-iframe"
                src="{{ url }}"
                width="{{ width }}"
                height="{{ height }}"
                style="{{ style }}"
                frameborder="0">
            </iframe>
        <# } else { #>
            <p style="padding:16px;background:#fff3cd;border-left:4px solid #ffc107;">
                <?php esc_html_e( 'Easy!Appointments: no booking URL configured. Go to Easy!Appts → Settings to connect your installation.', 'easyappointments' ); ?>
            </p>
        <# } #>
        <?php
    }
}
