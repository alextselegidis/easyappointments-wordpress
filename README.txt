=== Easy!Appointments ===

Contributors: alextselegidis
Donate link: https://alextselegidis.com
Tags: appointments, booking, appointment-booking, scheduling, calendar
Requires at least: 5.0
Tested up to: 7.1
Requires PHP: 5.6
Stable tag: 1.5.2
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add a full appointment booking system to your WordPress site. No monthly fees, no per-booking charges, and your customer data stays on your server.

== Description ==

**Let customers book appointments on your website, 24/7 — without paying a monthly subscription or a fee on every booking.**

Easy!Appointments gives your visitors a proper booking experience: they pick a service, pick a staff member, see the real free slots from your calendar, choose a time, and confirm. You and your customer both get an email. The appointment lands in your calendar. That's it.

It runs on your own hosting, so there is no subscription, no per-booking cut, no cap on how many appointments you take, and no third-party company sitting on your customers' names, phone numbers, and appointment history.

= See it working before you install anything =

Try the real booking form and the real admin calendar, right now, no signup:

**https://demo.easyappointments.org**

That takes about 60 seconds and will tell you more than this page can.

= Please read this bit — it explains the two pieces =

This is the part most people ask about, so here it is up front and in plain language.

Easy!Appointments is made of **two things**:

1. **Easy!Appointments** — the booking engine. It holds your calendar, services, staff, working hours, holidays, customers and emails. It is free and open source, and you install it on your own hosting (most shared hosts handle it fine — it needs PHP and MySQL, the same as WordPress).
2. **This plugin** — the bridge. It puts the booking form from that engine straight onto a page of your WordPress site, on your domain, inside your theme, so customers never get bounced off to a different-looking website to book.

**So yes — you need Easy!Appointments installed somewhere before this plugin does anything.** We would rather tell you that in the first 30 seconds than have you find out after installing.

Why it is built that way: keeping the booking engine separate is exactly what lets it be free, unlimited and fully yours. Nobody can raise your price, change the terms, or lock your customer list behind an upgrade, because nobody else is holding it.

Get the engine here: **https://easyappointments.org**

= What it actually costs =

| | Easy!Appointments | Typical hosted booking plugin |
| --- | --- | --- |
| Monthly fee | None | ~$10–$80 / month |
| Fee per booking | None | Common on cheaper tiers |
| Staff members | Unlimited | Often billed per person |
| Bookings per month | Unlimited | Often capped by plan |
| Where customer data lives | Your server | Their servers |
| If you stop paying | Nothing happens, it keeps running | Booking form stops |
| Licence | GPL, open source | Proprietary |

= Setting it up =

Once your Easy!Appointments engine is running, the WordPress side takes about three minutes:

1. Install and activate this plugin.
2. Open **Easy!Appts** in your WordPress menu, paste your Easy!Appointments web address, click **Connect**.
3. Open the page where you want bookings and add the **Easy!Appointments** block. Publish.

Your booking form is live on that page. Bookings appear in your Easy!Appointments calendar as they come in.

= Three ways to place the booking form =

**Block editor (Gutenberg).** Click **+**, search "Easy!Appointments", drop it in. Size and options are in the settings panel on the right. No code.

**Elementor.** Search "Easy!Appointments" in the widget panel and drag it onto the canvas. Everything is configured with normal Elementor controls.

**Anything else.** Classic editor, WPBakery, Divi, a theme widget area — the `[easyappointments]` shortcode works wherever shortcodes work.

You can also point a specific page at a specific service or staff member, so "Book a haircut with Maria" is its own page.

= Who this is for =

It was built first for **appointment-based local businesses** — salons, barbershops, spas, nail studios, tattoo studios, physiotherapists, dentists and clinics. Anywhere customers book a named person for a fixed-length slot.

It also gets used well beyond that: consultants and coaches, tutors, driving schools, workshops and repair shops, vets, law and accountancy practices, and university and government departments.

= Who is behind it =

Easy!Appointments has been developed in the open since 2014.

* 4,300+ stars and 1,500+ forks on GitHub
* Used by organisations including NEOM, Doctors Without Borders and Dolce & Gabbana
* Active public support community and issue tracker
* GPL licensed — you can read every line, fork it, and never be locked out

= What you get =

* Real-time availability from your own calendar
* Multiple services with individual durations and prices
* Multiple staff members with their own hours and days off
* Confirmation and reminder emails to both sides
* Google Calendar sync
* Works on phones — most bookings arrive from one
* Runs in many languages
* Your branding, your domain, your data

= Honest notes =

* You do need to install the Easy!Appointments engine on hosting you control. If you want a booking form with no separate installation at all, this is not that plugin, and we would rather you knew now.
* It is a self-hosted, open-source project. That means no bill, and it also means you set up your own email sending and updates. The documentation walks through both.
* Support comes from the community and the issue tracker rather than a paid helpdesk. Response times vary.

Documentation: https://easyappointments.org/documentation
More about the WordPress integration: https://easyappointments.org/wordpress

*Minimum requirements: WordPress 5.0 and PHP 5.6.*

== Installation ==

**Before you start:** you need Easy!Appointments running on your own hosting. It is free — download and setup instructions are at https://easyappointments.org. If you would like to see what you are setting up first, the live demo is at https://demo.easyappointments.org.

Once that is done:

1. Install this plugin from the WordPress **Plugins → Add New** screen, or upload it, then click **Activate**.
2. Go to **Easy!Appts** in your WordPress admin menu, paste the web address of your Easy!Appointments installation, and click **Connect**.
3. Edit the page where you want customers to book, add the **Easy!Appointments** block (or the Elementor widget, or the `[easyappointments]` shortcode), and publish.

Take a test booking yourself to confirm the confirmation email arrives, then you are live.

== Screenshots ==

1. The whole booking page on a phone, top to bottom — where most of your bookings come from.
2. The whole booking page on your own site — your domain, your theme, your footer.
3. Connecting WordPress to your Easy!Appointments installation. One field, one click.
4. Placing the booking form on a page with the block editor — width, height and pre-selection, no code.
5. Where the bookings land: your own calendar, colour-coded by service, one column per day.
6. Your services, durations and prices — managed in your installation, not on someone else's server.

== Frequently Asked Questions ==

= Do I really need a separate Easy!Appointments installation? =

Yes, and it is worth understanding why. Easy!Appointments is the booking engine — your calendar, services, staff and customers live there. This plugin puts that engine's booking form onto your WordPress pages.

Keeping the engine separate is what makes it free and unlimited: there is no company in the middle metering your bookings. You install it once on your own hosting, at https://easyappointments.org, and it is yours.

= Is installing the engine difficult? =

If you have installed WordPress, you can install this. It needs the same things WordPress does — PHP and MySQL — and it has a web-based setup wizard. Most people put it in a subfolder or subdomain of the same hosting account their WordPress site is on. The documentation covers the common hosts.

= Is there a monthly fee, or a fee per booking? =

No, none. There is no subscription, no commission on bookings, no limit on how many appointments or staff members you have, and no paid tier that unlocks the real features. It is GPL open-source software.

= Can I see it before committing to anything? =

Yes — https://demo.easyappointments.org is a live installation with a working booking form and a working admin calendar. Nothing to sign up for.

= Where do bookings go? =

Into your Easy!Appointments calendar, straight away. You can view them by day, week or month, and per staff member. Nothing is stored on anybody else's server.

= Do confirmation emails work reliably? =

They are sent by your Easy!Appointments installation. Whether they reach the inbox depends on how that server sends mail, which is true of every WordPress site as well. If emails go missing, the usual fix is to configure SMTP with a proper sending service rather than relying on the host's default PHP mail. This is documented, and it is the first thing to check if a customer says they did not get a confirmation.

= Does it sync with Google Calendar? =

Yes, Easy!Appointments supports Google Calendar synchronisation per staff member, set up from its own admin area.

= Can I show only one service or one staff member on a page? =

Yes. Each block, widget and shortcode can be pointed at a specific service or staff member, so you can give each service its own landing page.

= Will it match my theme? =

The booking form is embedded on your page, on your domain, and you can size and style the frame. The form's own look comes from your Easy!Appointments installation, which can be customised there.

= Which PHP version do I need? =

This plugin needs PHP 5.6 or newer, though modern PHP is strongly recommended. The Easy!Appointments engine has its own, higher requirement — check the version you are downloading against your host's PHP version before installing, as mismatched PHP versions are the most common cause of setup trouble.

= I have an older Easy!Appointments installation. Will this work with it? =

Update the engine to a current release first. Several reliability issues people have reported over the years were fixed upstream, and running an old version against a current plugin is asking for trouble.

= What if I get stuck? =

Documentation is at https://easyappointments.org/documentation, and there is an active community group where users and the maintainers answer questions:

https://groups.google.com/forum/#!categories/easy-appointments

= Can I change the booking form's language? =

Yes. The language is set in your Easy!Appointments installation, and the plugin's own interface is translated too. Contributions of new translations are welcome.

== Changelog ==

= 1.5.2 =

* Fix the booking form being cut off on phones — the iframe now grows to fit the form instead of scrolling inside a fixed height.
* Fix the auto-resize script never running: it was loaded in the page head, before the booking form existed, so it silently did nothing.
* Fix a 1000px minimum height that overrode smaller width/height values set on the block, widget or shortcode.
* Add a taller fallback height on narrow screens for installations served from a different domain, whose content cannot be measured from the page.
* Fix the asset version constant lagging behind the plugin version, which served stale CSS and JavaScript from browser caches after an update.

= 1.5.1 =

* Add missing files into the repository.

= 1.5.0 =

* Add Gutenberg block for embedding the booking form in pages and posts.
* Add Elementor widget for embedding the booking form with full property controls.
* Add "Settings" link on the Plugins page for quick access to the plugin configuration.
* Redesign the settings page with a modern card-based layout and step-by-step integration guide for Gutenberg, Elementor, and Shortcode.
* Validate URL format on the frontend before sending the connect request.
* Fix AJAX actions to return proper JSON responses with structured error information.
* Fix error notifications to display a clear title, friendly message, and collapsible technical details instead of raw undefined values.
* Move admin script and style enqueueing to proper admin_enqueue_scripts hook.
* Sanitize provider and service shortcode/block attributes with absint().
* Sanitize style shortcode attribute with sanitize_text_field() before output.

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

== Upgrade Notice ==

= 1.5.2 =
Fixes the booking form being cut off on phones. The form now resizes to fit instead of scrolling inside a fixed height.

= 1.5.0 =
Adds a native Gutenberg block and an Elementor widget, so you can place the booking form without touching a shortcode.
