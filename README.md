## Easy!Appointments - WordPress Plugin [![Build Status](https://travis-ci.org/alextselegidis/easyappointments-wordpress-plugin.svg?branch=master)](https://travis-ci.org/alextselegidis/easyappointments-wp-plugin)

<img src="https://easyappointments.files.wordpress.com/2015/02/easyappointments-wp-plugin-banner.png">

Leverage your conversion rates by integrating the booking form directly in your WordPress pages. Customers will never have to leave your website for booking an appointment. Take advantage of the scheduling power of Easy!Appointment which will run smoothly with your WordPress installation. Include the booking form in your pages with the [easyappointments] shortcode.

*Minimum Requirements: WordPress v4.0 & PHP v5.6*

### Connecting Easy!Appointments with WordPress

Install and activate the plugin and navigate to `Settings >> Easy!Appointments` menu of the WordPress admin section. Create a new Easy!Appointments installation or connect to an existing one by providing the preferred URL and destination path in the page form. Once a connection is established you'll be able to include the booking form in your pages.

### Include Booking in your Pages

WordPress supports the use of custom shortcodes which allow plugins to insert custom content into pages. This plugin takes advantage of this functionality and creates an iframe that displays the booking form of Easy!Appointments. Include the `[easyappointments]` shortcode in the correct place of your published contents as shown in the following example.

```
[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px;"]
```

The "width", "height" and "style" attributes are optional but can help you to fine tune the styling of the iframe.

### Translations

This plugin uses the **i18n** localization system of WordPress and the translations are po & mo files located in the `assets/lang` directory. Contributions are more than welcome so feel free to make pull requests with your translations or send them directly to [alextselegidis@gmail.com](mailto:alextselegidis@gmail.com).
