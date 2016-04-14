# Setup Vagrant

The Vagrantfile will provision a `hashicorp/precise32` box with a complete LAMP stack (PHP v5.3) and
will automatically install WordPress v4.0 to v4.5 with the easyappointmets-wp plugin already pre-enabled.
The MySQL user has the `root/root` credentials and the WordPress installation the `administrator/administrator`.

1. Install Vagrant and start by executing the `vagrant up` command.
2. Open your browser to `http://localhost:8080/wp4_5`. You can replace `wp4_5` with one of the following: wp4_0, wp4_1,
wp4_2, wp4_3, wp4_4 for testing the plugin under the respective WP versions.
3. Connect to the Vagrant machine with the `vagrant ssh` command.
4. To close the machine execute the `vagrant destroy` command.

Find out more about Vagrant in the [official website](https://www.vagrantup.com/).
