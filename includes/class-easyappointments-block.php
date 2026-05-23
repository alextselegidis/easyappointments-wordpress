<?php

/**
 * Gutenberg block registration and server-side rendering.
 *
 * @package    Easyappointments
 * @subpackage Easyappointments/includes
 */
class Easyappointments_Block {

    /**
     * Register the Gutenberg block.
     */
    public function register() {
        register_block_type(
            plugin_dir_path( dirname( __FILE__ ) ) . 'blocks/easyappointments',
            [
                'render_callback' => [ $this, 'render' ],
            ]
        );
    }

    /**
     * Server-side render callback for the block.
     *
     * @param array $attributes Block attributes.
     *
     * @return string Rendered HTML.
     */
    public function render( $attributes ) {
        $url = get_option( 'easyappointments_url' );

        if ( empty( $url ) ) {
            return '';
        }

        $query_data = [];

        if ( ! empty( $attributes['provider'] ) ) {
            $query_data['provider'] = absint( $attributes['provider'] );
        }

        if ( ! empty( $attributes['service'] ) ) {
            $query_data['service'] = absint( $attributes['service'] );
        }

        if ( ! empty( $query_data ) ) {
            $url .= ( strpos( $url, '?' ) === false ? '?' : '&' ) . http_build_query( $query_data );
        }

        $width       = ! empty( $attributes['width'] )       ? $attributes['width']       : '100%';
        $height      = ! empty( $attributes['height'] )      ? $attributes['height']      : '1000px';
        $iframe_style = ! empty( $attributes['iframeStyle'] ) ? $attributes['iframeStyle'] : '';

        return sprintf(
            '<iframe class="easyappointments-iframe" src="%s" width="%s" height="%s" style="%s"></iframe>',
            esc_attr( $url ),
            esc_attr( $width ),
            esc_attr( $height ),
            esc_attr( $iframe_style )
        );
    }
}
