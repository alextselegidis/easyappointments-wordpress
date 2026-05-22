=== Easy!Appointments ===

Contributors: alextselegidis
Donate link: https://alextselegidis.com
Tags: appointments, booking, scheduler, elementor, gutenberg
Requires at least: 5.0
Tested up to: 7.0.0
Stable tag: trunk
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Turn any WordPress page into a live booking system — with native Gutenberg and Elementor support.

== Description ==

**Stop sending customers to a separate booking site. Bring the booking form directly into WordPress — and watch your conversions soar.**

**Easy!Appointments for WordPress** connects your self-hosted Easy!Appointments installation to your site in seconds. Your customers book appointments without ever leaving your page, on your domain, in your brand — all without a SaaS subscription, per-booking fees, or giving up control of your data.

Whether you run a salon, clinic, consultancy, agency, or any service-based business, setup takes minutes and the results are immediate.

= 🧱 Built for Gutenberg — First-Class Block Support =

Love the WordPress block editor? So do we. The **Easy!Appointments Gutenberg block** lets you drop the booking form into any page or post in seconds — just like any other block. Search for "Easy!Appointments" in the block inserter, add it, and you're done. Configure iframe dimensions and pre-select a provider or service right from the block settings panel. No shortcodes, no code, no fuss.

= 🎨 Built for Elementor — Drag, Drop, Done =

Already building with Elementor? The **Easy!Appointments Elementor widget** integrates seamlessly into your Elementor workflow. Find it in the widget panel, drag it onto your canvas, and configure everything visually. Full property controls included — width, height, styling, provider and service pre-selection, all without touching a line of code.

= Also Works Everywhere Else =

Not using Gutenberg or Elementor? No problem — the classic `[easyappointments]` shortcode works in any page builder, theme, or editor that supports shortcodes.

= Why Easy!Appointments beats the rest =

Most booking plugins hold your data hostage. This one doesn't.

* **You own your data** — it stays on your server, always
* **No vendor lock-in** — self-host Easy!Appointments for free
* **Zero per-booking or per-user fees** — grow without growing your costs
* **Works with any theme** — zero conflicts, zero bloat
* **Clean booking UX** — your customers will actually complete bookings

= Key Features =

* 🧱 **Native Gutenberg block** — insert the booking form like any other block
* 🎨 **Elementor widget** — fully visual drag-and-drop integration
* 📋 **Shortcode support** — `[easyappointments]` works everywhere
* ⚡ Connect to any Easy!Appointments installation in seconds
* 📱 Fully responsive — looks great on every device
* 👥 Multi-service and multi-provider support
* 🎯 Pre-select a provider or service via attributes
* 🪶 Fast and lightweight — no performance impact

= Perfect for =

* Salons, barbershops & spas
* Consultants & freelancers
* Clinics & healthcare providers
* Agencies & service businesses
* Coaches, tutors & trainers

= How it works =

1. Install and activate the plugin
2. Navigate to **Easy!Appts** in your WordPress admin menu
3. Paste your Easy!Appointments installation URL and connect
4. Add the booking form using the **Gutenberg block**, the **Elementor widget**, or the `[easyappointments]` shortcode
5. Start accepting bookings instantly

= Connecting Easy!Appointments with WordPress =

Install and activate the plugin and navigate to the `Easy!Appts` menu in the WordPress admin section. Connect to an existing Easy!Appointments installation by providing your URL. Once connected you can embed the booking form in any page using your preferred method.

= Gutenberg Block =

Open any page in the block editor, click the **+** button to add a block, and search for **Easy!Appointments**. Add the block and configure it from the settings panel on the right — set width, height, optional inline styles, and optionally pre-select a provider or service by ID.

= Elementor Widget =

Open a page in Elementor, search for **Easy!Appointments** in the widget panel, and drag it onto your canvas. All settings are available as Elementor controls — no custom code needed.

= Shortcode =

Use the `[easyappointments]` shortcode anywhere in your content:

`[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px;"]`

The `width`, `height` and `style` attributes are optional and let you fine-tune the iframe appearance.

Pre-select a provider and/or service (IDs are found in your Easy!Appointments backend):

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

