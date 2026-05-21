=== Easy!Appointments ===

Contributors: alextselegidis
Donate link: https://alextselegidis.com
Tags: appointments, booking, scheduler, elementor, gutenberg
Requires at least: 5.0
Tested up to: 7.0.0
Stable tag: trunk
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Seamlessly embed a powerful booking system into your WordPress site — fast, clean, and fully in your control.

== Description ==

Turn your WordPress site into a fully functional booking platform in minutes.

**Easy!Appointments for WordPress** connects your existing Easy!Appointments installation directly to your site, letting you embed a professional booking experience anywhere — no complex setup, no vendor lock-in, no forced SaaS subscriptions.

Whether you run a salon, consultancy, clinic, agency, or freelance service, this plugin makes it effortless for your customers to book appointments directly from your website.

= Why this plugin stands out =

Most booking plugins try to lock you into their ecosystem. Easy!Appointments takes a different approach:

* **You keep full control** of your booking system and your data
* **Self-host everything** — no dependency on third-party servers
* **No per-user pricing** — scale your business without scaling your costs
* **Clean, distraction-free** booking experience your customers will love
* **Works with any WordPress theme** — no conflicts, no bloat

= Key Features =

* Embed your booking page with a simple shortcode
* **Gutenberg block** — insert the booking form natively in the block editor
* **Elementor widget** — drag and drop the booking form in Elementor
* Connect to any existing Easy!Appointments installation in seconds
* Responsive booking interface that works on all devices
* Multi-service and multi-provider support
* Preselect a service or provider via shortcode attributes
* Fast loading, lightweight integration
* No coding required

= Perfect for =

* Salons & barbershops
* Consultants & freelancers
* Clinics & healthcare providers
* Agencies & service businesses
* Coaches, tutors, and trainers

= How it works =

1. Install and activate the plugin
2. Navigate to **Easy!Appts** in your WordPress admin menu
3. Paste your Easy!Appointments installation URL and connect
4. Insert `[easyappointments]` anywhere in your pages or posts
5. Start accepting bookings instantly

= Connecting Easy!Appointments with WordPress =

Install and activate the plugin and navigate to the `Easy!Appts` menu in the WordPress admin section. Connect to an existing Easy!Appointments installation by providing your URL. Once connected you can embed the booking form in any page.

= Include Booking in your Pages =

Use the `[easyappointments]` shortcode anywhere in your content:

`[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px;"]`

The `width`, `height` and `style` attributes are optional and let you fine-tune the iframe appearance.

You can also preselect a provider and/or service using shortcode attributes (IDs are found in your Easy!Appointments backend):

`[easyappointments provider="2" service="1"]`

*Minimum Requirements: WordPress v5.0 & PHP v5.6*

*Find out more at https://easyappointments.org/wordpress*

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/easyappointments-wordpress` or install via the WordPress plugin screen
2. Activate the plugin through the **Plugins** screen in WordPress
3. Navigate to **Easy!Appts** in your WordPress admin menu
4. Paste your Easy!Appointments installation URL and click **Connect**
5. Insert the `[easyappointments]` shortcode into any page or post

== Screenshots ==

1. Booking form integration in mobile viewport.
2. Booking form integration in desktop viewport.
3. Admin page of the plugin.
4. Plugin information modals.

== Frequently Asked Questions ==

= Do I need an existing Easy!Appointments installation? =

Yes. This plugin connects your WordPress site to a running Easy!Appointments instance. You can self-host Easy!Appointments for free — visit https://easyappointments.org to get started.

= Is this a SaaS service? Do I pay per booking or per user? =

No. Easy!Appointments is fully open-source and self-hosted. There are no subscription fees, no per-booking charges, and no usage limits.

= Easy!Appointments default language does not match my website's language? =

You can change the default language of Easy!Appointments by editing the `config.php` of your installation.

= Where can I get more help? =

Visit the official Easy!Appointments support group where active users help each other:

https://groups.google.com/forum/#!categories/easy-appointments

== Changelog ==

= Unreleased =

* Add "Settings" link on the Plugins page for quick access to the plugin configuration.
* Add Gutenberg block for embedding the booking form in pages and posts.
* Add Elementor widget for embedding the booking form with full property controls.
* Redesign the settings page with a modern card-based layout and step-by-step integration guide for Gutenberg, Elementor, and Shortcode.
* Validate URL format on the frontend before sending the connect request.
* Validate URL format and verify the Easy!Appointments installation (via logo.png check) on the backend before saving.
* Fix AJAX actions to return proper JSON responses with structured error information.
* Fix error notifications to display a clear title, friendly message, and collapsible technical details instead of raw undefined values.

= 1.4.3 =

* Add "nonce" check for the admin HTTP requests

= 1.4.2 =

* Remove the $path check before rendering the iframe as it is always empty (frontend iframe rendering works again)

= 1.4.1 =

* Add capabilities check to the plugin requests

= 1.4.0 =

* Support for up to WordPress 6.5.5.
* Remove installation functionality.
* Move the menu item in WP admin to root level, so that it becomes easier to find.
* Update screenshots.

= 1.3.3 =

* Support for WordPress 6.5.2.
* Add additional security check on instance removal.
* Add Russian translations to the plugin (by @krotesk).

= 1.3.2 =

* Support for WordPress 6.4.3.
* Fixed XSS issue with shortcode.

= 1.3.1 =

* Support for WordPress 5.6.
* Support for Easy!Appointments 1.4
* Fixed issue with new Easy!Appointments installations.
* Fixed issue with missing javascript file in public pages.

= 1.3.0 =

* Support for WordPress 5.5.
* Plugin codebase adjustments.
* Added support for "provider" and "service" shortcode attributes.

= 1.2.0 =

* Support for WordPress 5.x.

= 1.1.0 =

* Installation will not try to create a new directory (avoiding permission problems).
* Added minified assets (JS & CSS).
* Enhanced admin UI section.

= 1.0.1 =

* Initial release in WordPress plugin repositories.
* Install, Link, Unlink, Verify and Shortcode operations.
* Shipped with Easy!Appointments v1.1.1

