<h1 align="center">
    <br>
    <a href="https://easyappointments.org">
        <img src="https://raw.githubusercontent.com/alextselegidis/easyappointments-integrations/master/logo.png" alt="Easy!Appointments" width="150">
    </a>
    <br>
    Easy!Appointments Integrations
    <br>
</h1>

<br>

<p align="center" style="background: yellow; font-weight: bold">
    NOTICE: This repository is undergoing major changes, make sure you update your existing clones before working on new features.
</p>

<br>

<h4 align="center">
    Easy!Appointments integration packages for various platforms. 
</h4>

<p align="center">
  <img alt="GitHub" src="https://img.shields.io/github/license/alextselegidis/easyappointments-wordpress-plugin?style=for-the-badge">
  <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/alextselegidis/easyappointments-wordpress-plugin?style=for-the-badge">
</p>

<p align="center">
  <a href="#about">About</a> •
  <a href="#setup">Setup</a> •
  <a href="#installation">Installation</a> •
  <a href="#license">License</a>
</p>

![banner](wordpress/assets/banner-772x250.png)

## About

Leverage your conversion rates by integrating the booking form directly in your WordPress pages. Customers will never 
have to leave your website for booking an appointment. Take advantage of the scheduling power of Easy!Appointment which 
will run smoothly with your WordPress installation. Include the booking form in your pages with the [easyappointments] 
shortcode.

*Minimum Requirements: WordPress v5.0 & PHP v5.6*

### Connecting Easy!Appointments with WordPress

Install and activate the plugin and navigate to `Settings > Easy!Appointments` menu of the WordPress admin section. 
Create a new Easy!Appointments installation or connect to an existing one by providing the preferred URL and destination 
path in the page form. Once a connection is established you'll be able to include the booking form in your pages.

### Include Booking in your Pages

WordPress supports the use of custom shortcodes which allow plugins to insert custom content into pages. This plugin 
takes advantage of this functionality and creates an iframe that displays the booking form of Easy!Appointments. Include 
the `[easyappointments]` shortcode in the correct place of your published contents as shown in the following example.

```
[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px;"]
```

The "width", "height" and "style" attributes are optional but can help you to fine tune the styling of the iframe.

### Translations

This plugin uses the **i18n** localization system of WordPress and the translations are po & mo files located in the 
`languages` directory. Contributions are more than welcome so feel free to make pull requests with your translations or 
send them directly to [info@alextselegidis.com](mailto:info@alextselegidis.com).

## Setup

To clone and run this application, you'll need [Git](https://git-scm.com), [Node.js](https://nodejs.org/en/download/) 
(which comes with [npm](http://npmjs.com)) and [Composer](https://getcomposer.org) installed on your computer. From your 
command line:

```bash
# Clone this repository
$ git clone https://github.com/alextselegidis/easyappointments-wordpress-plugin.git

# Go into the repository
$ cd easyappointments-wordpress-plugin

# Install dependencies
$ npm install && composer install

# Build the plugin
$ npm run build
```

Note: If you're using Linux Bash for Windows, 
[see this guide](https://www.howtogeek.com/261575/how-to-run-graphical-linux-desktop-applications-from-windows-10s-bash-shell/) 
or use `node` from the command prompt.

You can build the files by running `npm run build`. This command will bundle everything to a `build` directory.

## Installation

After building the plugin you will get a zip file that can be used with in the WordPress plugin installation page.

## License 

Code Licensed Under [GPL v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html) | Content Under [CC BY 3.0](https://creativecommons.org/licenses/by/3.0/)

---

Website [alextselegidis.com](https://alextselegidis.com) &nbsp;&middot;&nbsp;
GitHub [alextselegidis](https://github.com/alextselegidis) &nbsp;&middot;&nbsp;
Twitter [@alextselegidis](https://twitter.com/AlexTselegidis)

###### More Projects On Github
###### ⇾ [Easy!Appointments &middot; Open Source Appointment Scheduler](https://github.com/alextselegidis/easyappointments)
###### ⇾ [Plainpad &middot; Self Hosted Note Taking App](https://github.com/alextselegidis/plainpad)
###### ⇾ [Integravy &middot; Service Orchestration At Your Fingertips](https://github.com/alextselegidis/integravy)
