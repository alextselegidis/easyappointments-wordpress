## Easy!Appointments - WordPress Plugin [![Build Status](https://travis-ci.org/alextselegidis/easyappointments-wp-plugin.svg?branch=develop)](https://travis-ci.org/alextselegidis/easyappointments-wp-plugin)
<img src="https://easyappointments.files.wordpress.com/2015/02/easyappointments-wp-plugin-banner.png">

This plugin aims to bridge Easy!Appointments with WordPress and facilitate users in the integration of the appointment booking system to their WP pages. It offers useful functions such as the installation of Easy!Appointments directly from WordPress' backend, the link of an existing installation and of course the display of the appointment booking wizard with the use of a simple shortcode.

*Minimum Requirements: WordPress v4.0 & PHP v5.3*

### Linking Easy!Appointments & WordPress

Once the plugin is installed and activated a new menu entry becomes available under "Settings >> Easy!Appointments" (wp-admin). This is the main page of the plugin and it allows users to create new installations or link existing ones with their websites. Easy!Appointments must be linked with WordPress before being able to use the booking shortcode.

### Applying The Shortcode

WordPress supports the use of custom [shortcodes](https://www.smashingmagazine.com/2012/05/wordpress-shortcodes-complete-guide) which enable plugins to insert custom content into a page. This plugin takes advantage of this functionality and inserts an iframe that points to the booking wizard of Easy!Appointments and can be used directly within pages or posts so that customers can book appointments without ever leaving the website.

```
[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px; border-radius: 10px;"]
```
The "width", "height" and "style" attributes are optional but they can help re-adjust the display of the iframe so that it better suits the active theme.

### Translations

This plugin uses the i18n localization system of WordPress and the translations are po & mo files located in the assets/lang directory. Feel free to contribute your own translations so that other users can benefit from them.
