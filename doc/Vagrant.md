# Setup Vagrant

The Vagrantfile will provision a precise32 box with a complete LAMP stack (PHP v5.3) and
will automatically install WordPress v4.0 with the easyappointmets-wp plugin already installed.
The MySQL user has the root/root credentials and the WordPress installation the administrator/administrator.

1. Install Vagrant and start by executing the `vagrant up` command.
2. Open your browser to the http://localhost:8080 address.
3. Connect to the Vagrant machine with the `vagrant ssh` command.
4. To close the machine execute the `vagrant destroy` command.

In the future more WordPress installations will be provided for further testing.

Find out more about Vagrant in the [official website](https://www.vagrantup.com/).
