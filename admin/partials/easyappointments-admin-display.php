<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2017
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */
?>

<div class="wrap easyappointments">

    <div class="ea-header">
        <img class="ea-logo" src="<?php echo esc_url( plugins_url( 'img/logo.png', __DIR__ ) ); ?>" alt="Easy!Appointments Logo"/>
        <div class="ea-header-text">
            <h1><?php _e( 'Easy!Appointments', 'easyappointments' ) ?></h1>
            <p><?php _e( 'Embed professional appointment booking directly into your WordPress site — fast, self-hosted, and fully in your control.', 'easyappointments' ) ?></p>
        </div>
        <img class="ea-loading hidden" src="<?php echo esc_url( admin_url( 'images/wpspin_light-2x.gif' ) ); ?>" alt="Loading">
    </div>

    <!-- Step 1: Connect -->
    <div class="ea-card">
        <div class="ea-card-header">
            <div class="ea-step-badge">1</div>
            <h2><?php _e( 'Connect Your Easy!Appointments Installation', 'easyappointments' ) ?></h2>
        </div>
        <div class="ea-card-body">
            <p><?php _e( 'Enter the public root URL of your Easy!Appointments installation and click Connect. The URL will be verified before saving.', 'easyappointments' ) ?></p>
            <div class="ea-url-row">
                <input type="text" id="url" class="ea-url-input"
                       placeholder="<?php echo esc_attr( get_site_url() . '/easyappointments' ); ?>"
                       value="<?php echo esc_attr( get_option( 'easyappointments_url' ) ); ?>"/>
                <button id="connect" class="button button-primary connect-action">
                    <?php _e( 'Connect', 'easyappointments' ) ?>
                </button>
                <button id="disconnect" class="button disconnect-action" style="display: none">
                    <?php _e( 'Disconnect', 'easyappointments' ) ?>
                </button>
            </div>
            <p class="description">
                <?php printf( __( 'Example: %s', 'easyappointments' ), '<code>' . esc_html( get_site_url() . '/easyappointments' ) . '</code>' ) ?>
            </p>
        </div>
    </div>

    <!-- Step 2: Embed -->
    <div class="ea-card">
        <div class="ea-card-header">
            <div class="ea-step-badge">2</div>
            <h2><?php _e( 'Embed the Booking Form', 'easyappointments' ) ?></h2>
        </div>
        <div class="ea-card-body">
            <p><?php _e( 'Choose how you want to embed the booking form in your pages and posts:', 'easyappointments' ) ?></p>

            <div class="ea-method-grid">

                <button class="ea-method-card" data-method="gutenberg">
                    <span class="dashicons dashicons-welcome-widgets-menus ea-method-icon"></span>
                    <strong><?php _e( 'Gutenberg Block', 'easyappointments' ) ?></strong>
                    <span><?php _e( 'Add the booking form natively in the WordPress block editor.', 'easyappointments' ) ?></span>
                </button>

                <button class="ea-method-card" data-method="elementor">
                    <span class="dashicons dashicons-admin-plugins ea-method-icon"></span>
                    <strong><?php _e( 'Elementor Widget', 'easyappointments' ) ?></strong>
                    <span><?php _e( 'Drag and drop the booking widget into any Elementor page.', 'easyappointments' ) ?></span>
                </button>

                <button class="ea-method-card" data-method="shortcode">
                    <span class="dashicons dashicons-shortcode ea-method-icon"></span>
                    <strong><?php _e( 'Shortcode', 'easyappointments' ) ?></strong>
                    <span><?php _e( 'Paste a shortcode anywhere in your content or text widget.', 'easyappointments' ) ?></span>
                </button>

            </div>

            <div id="ea-instructions" class="ea-instructions" style="display: none">

                <div id="ea-instructions-gutenberg" class="ea-instruction-panel" style="display: none">
                    <h3><?php _e( 'Using the Gutenberg Block', 'easyappointments' ) ?></h3>
                    <ol>
                        <li><?php _e( 'Open the page or post you want to add the booking form to.', 'easyappointments' ) ?></li>
                        <li><?php printf( __( 'Click the %s button to add a new block.', 'easyappointments' ), '<strong>+</strong>' ) ?></li>
                        <li><?php printf( __( 'Search for %s and select it.', 'easyappointments' ), '<strong>Easy!Appointments</strong>' ) ?></li>
                        <li><?php _e( 'Use the block settings panel on the right to configure the width, height, and optionally pre-select a service or provider.', 'easyappointments' ) ?></li>
                        <li><?php _e( 'Publish or update the page — the booking form will appear in place of the block.', 'easyappointments' ) ?></li>
                    </ol>
                </div>

                <div id="ea-instructions-elementor" class="ea-instruction-panel" style="display: none">
                    <h3><?php _e( 'Using the Elementor Widget', 'easyappointments' ) ?></h3>
                    <ol>
                        <li><?php _e( 'Open the page you want to edit with Elementor.', 'easyappointments' ) ?></li>
                        <li><?php printf( __( 'In the Elementor widget panel, search for %s.', 'easyappointments' ), '<strong>Easy!Appointments</strong>' ) ?></li>
                        <li><?php _e( 'Drag the widget onto your page layout.', 'easyappointments' ) ?></li>
                        <li><?php _e( 'Configure the width, height, and optional pre-selection in the widget settings panel on the left.', 'easyappointments' ) ?></li>
                        <li><?php _e( 'Click Publish or Update — the booking form will be displayed on the live page.', 'easyappointments' ) ?></li>
                    </ol>
                </div>

                <div id="ea-instructions-shortcode" class="ea-instruction-panel" style="display: none">
                    <h3><?php _e( 'Using the Shortcode', 'easyappointments' ) ?></h3>
                    <p><?php _e( 'Paste the following shortcode into any page, post, or text widget:', 'easyappointments' ) ?></p>
                    <div class="ea-code-block"><code>[easyappointments]</code></div>
                    <p><?php _e( 'Optional attributes:', 'easyappointments' ) ?></p>
                    <ul class="ea-shortcode-examples">
                        <li>
                            <div class="ea-code-block"><code>[easyappointments width="100%" height="1000px"]</code></div>
                            &mdash; <?php _e( 'Set the iframe dimensions', 'easyappointments' ) ?>
                        </li>
                        <li>
                            <div class="ea-code-block"><code>[easyappointments service="1" provider="2"]</code></div>
                            &mdash; <?php _e( 'Pre-select a service and/or provider (use the record IDs from your Easy!Appointments backend)', 'easyappointments' ) ?>
                        </li>
                        <li>
                            <div class="ea-code-block"><code>[easyappointments style="border: 2px solid #ccc"]</code></div>
                            &mdash; <?php _e( 'Add custom inline CSS to the iframe', 'easyappointments' ) ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Step 3: Easy!Appointments 1.6 Required Configuration -->
    <details class="ea-card ea-collapsible">
        <summary class="ea-card-header ea-collapsible-header">
            <div class="ea-step-badge ea-step-badge--warning">!</div>
            <h2><?php _e( 'Easy!Appointments 1.6.0 &mdash; Required Configuration', 'easyappointments' ) ?></h2>
            <span class="ea-collapsible-chevron dashicons dashicons-arrow-down-alt2"></span>
        </summary>
        <div class="ea-card-body">
            <p>
                <?php _e( 'Easy!Appointments <strong>v1.6.0</strong> introduced stricter HTTP security headers that block iframe embedding by default. If your booking form is not loading inside the page, you need to apply the following one-line fix to your Easy!Appointments installation.', 'easyappointments' ) ?>
            </p>
            <ol>
                <li>
                    <?php _e( 'Open the file <code>application/hooks/security_headers.php</code> in your Easy!Appointments installation.', 'easyappointments' ) ?>
                </li>
                <li>
                    <?php _e( 'Find the following line:', 'easyappointments' ) ?>
                    <div class="ea-code-block"><code>header('X-Frame-Options: SAMEORIGIN');</code></div>
                </li>
                <li>
                    <?php _e( 'Replace it with:', 'easyappointments' ) ?>
                    <div class="ea-code-block"><code>header("X-Frame-Options: ALLOWALL");</code></div>
                </li>
                <li>
                    <?php _e( 'Save the file and reload your WordPress page — the booking form should now embed correctly.', 'easyappointments' ) ?>
                </li>
            </ol>
            <p class="description">
                <?php _e( '<strong>Note:</strong> This fix is only required if your Easy!Appointments installation is hosted on a <strong>different domain</strong> from your WordPress site (e.g. <code>bookings.example.com</code> vs <code>example.com</code>). If Easy!Appointments lives in a subfolder of the same domain (e.g. <code>example.com/easyappointments</code>), iframe embedding works without this change.', 'easyappointments' ) ?>
            </p>
        </div>
    </details>

    <div class="ea-footer">
        <?php _e( 'For more information visit the official website:', 'easyappointments' ) ?>
        <a href="https://easyappointments.org" target="_blank">easyappointments.org</a>
    </div>

</div>
