<h1 align="center">
    <br>
    <a href="https://easyappointments.org">
        <img src="https://raw.githubusercontent.com/alextselegidis/easyappointments-wordpress-plugin/master/assets/icon-128x128.png" alt="Easy!Appointments" width="128">
    </a>
    <br>
    Easy!Appointments - WordPress Plugin
    <br>
</h1>

<br>

<h4 align="center">
    Bring your booking form directly into WordPress — with native Gutenberg block and Elementor widget support.
</h4>

<p align="center">
  <img alt="GitHub" src="https://img.shields.io/github/license/alextselegidis/easyappointments-wordpress-plugin?style=for-the-badge">
  <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/alextselegidis/easyappointments-wordpress-plugin?style=for-the-badge">
</p>

<p align="center">
  <a href="#about">About</a> •
  <a href="#gutenberg--elementor">Gutenberg & Elementor</a> •
  <a href="#setup">Setup</a> •
  <a href="#installation">Installation</a> •
  <a href="#license">License</a>
</p>

![banner](assets/banner-772x250.png)

## About

**Stop sending customers away to a separate booking site.** Bring the booking form directly into your WordPress pages — and watch your conversions soar.

**Easy!Appointments for WordPress** connects your self-hosted [Easy!Appointments](https://easyappointments.org) installation to your site in seconds. Your customers book appointments without ever leaving your page, on your domain, in your brand — with no SaaS subscriptions, no per-booking fees, and full ownership of your data.

Whether you're running a salon, clinic, consultancy, or any service business, setup takes minutes and the impact is immediate.

*Minimum Requirements: WordPress v5.0 & PHP v5.6*

## Gutenberg & Elementor

### 🧱 Native Gutenberg Block

Love the WordPress block editor? The **Easy!Appointments block** is a first-class citizen of the block inserter. Search for "Easy!Appointments", drop it in, and configure width, height, styling, and provider/service pre-selection right from the block settings panel — no shortcodes, no code.

### 🎨 Elementor Widget

Building with Elementor? Find the **Easy!Appointments widget** in the Elementor panel, drag it onto your canvas, and set everything up visually with full property controls. It fits your workflow perfectly.

### 📋 Shortcode (works everywhere else)

For classic editors, other page builders, or anywhere shortcodes are supported:

```
[easyappointments width="100%" height="500px" style="border: 5px solid #1A865F; box-shadow: #454545 1px 1px 5px;"]
```

Pre-select a provider and/or service (IDs found in your Easy!Appointments backend):

```
[easyappointments provider="2" service="1"]
```

### Connecting Easy!Appointments with WordPress

Install and activate the plugin and navigate to `Easy!Appts` in the WordPress admin menu. Paste your Easy!Appointments installation URL and connect. Once connected, embed the booking form using the Gutenberg block, the Elementor widget, or the shortcode.

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
$ git clone https://github.com/alextselegidis/easyappointments-wordpress.git

# Go into the repository
$ cd easyappointments-wordpress

# Install dependencies
$ composer install
```

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
