=== Easy!Appointments ===
Contributors: alextselegidis
Donate link: http://alextselegidis.com
Tags: appointments, scheduler, google-calendar
Requires at least: 4.0.0
Tested up to: 4.7.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin aims to bridge Easy!Appointments with WordPress and facilitate users in the integration of the appointment scheduler to their websites.

== Description ==

## Easy!Appointments - WordPress Plugin [![Build Status](https://travis-ci.org/alextselegidis/easyappointments-wp-plugin.svg?branch=develop)](https://travis-ci.org/alextselegidis/easyappointments-wp-plugin)
<img src="https://easyappointments.files.wordpress.com/2015/02/easyappointments-wp-plugin-banner.png">

This plugin aims to bridge Easy!Appointments with WordPress and facilitate users in the integration of the appointment booking system to their WP pages. It offers useful functions such as the installation of Easy!Appointments directly from WordPress' backend, the link of an existing installation and of course the display of the appointment booking wizard with the use of a simple shortcode.

*Minimum Requirements: WordPress v4.0 & PHP v5.6*

### Linking Easy!Appointments & WordPress

Once the plugin is installed and activated a new menu entry becomes available under "Settings >> Easy!Appointments" (wp-admin). This is the main page of the plugin and it allows users to create new installations or link existing ones with their websites. Easy!Appointments must be linked with WordPress before being able to use the booking shortcode.

### Applying The Shortcode

WordPress supports the use of custom [shortcodes](https://www.smashingmagazine.com/2012/05/wordpress-shortcodes-complete-guide) which enable plugins to insert custom content into a page. This plugin takes advantage of this functionality and inserts an iframe that points to the booking wizard of Easy!Appointments and can be used directly within pages or posts so that customers can book appointments without ever leaving the website.

```
[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px;"]
```
The "width", "height" and "style" attributes are optional but they can help to re-adjust the display of the iframe so that it better suits the active theme.

### Translations

This plugin uses the **i18n** localization system of WordPress and the translations are po & mo files located in the assets/lang directory. Contributions are more than welcome so feel free to make pull requests with your translations or send them directly to [alextselegidis@gmail.com](mailto:alextselegidis@gmail.com).


== Installation ==

Upload and activate the plugin to your WordPress website and head to Settings > Easy!Appointments page. There you can either create a new Easy!Appointments installation or link an existing one.

After a successful connection you can use the [easyappointments] shortcode in your posts or pages. This shortcode will display the Easy!Appointments booking form and clients will be able to book appointments without ever leaving your website.


== Frequently Asked Questions ==

= What should I do if I encounter permission errors? =

Some operations of the plugin (such as the Easy!Appointments installation) require filesystem permissions that are not present in your server. If this is the case you will have to set the required permissions to your server or perform manually the operation with FTP (e.g. install Easy!Appointments manually).

= Easy!Appointments default language does not match my website's language? =

You can change the default language of Easy!Appointments by editing the config.php of your installation.

= Where can I get more help? =

Easy!Appointments has an official group where many users help each other with problems, enhancements and other contributions. It is the best place to interact with other users and share your experiences with the project.

== Changelog ==

= 1.1.0 =
* Updated Easy!Appointments release to v1.2.1.
* Back-end UI improvements.
* Install operation will not try to create a new directory, but it will use an existing one.

= 1.0.1 =
* Initial release in WordPress plugin repositories.
* Install, Link, Unlink, Verify and Shortcode operations.
* Shipped with Easy!Appointments v1.1.1
