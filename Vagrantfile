# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "hashicorp/precise32"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Define a Vagrant Push strategy for pushing to Atlas. Other push strategies
  # such as FTP and Heroku are also available. See the documentation at
  # https://docs.vagrantup.com/v2/push/atlas.html for more information.
  # config.push.define "atlas" do |push|
  #   push.app = "YOUR_ATLAS_USERNAME/YOUR_APPLICATION_NAME"
  # end

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
     sudo apt-get update
     sudo apt-get install -y apache2
     sudo apt-get install -y php5 php5-dev php5-mysql php5-gd php5-mcrypt php5-curl php5-xdebug
     sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
     sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
     sudo apt-get install -y mysql-server
     sudo service apache2 restart
     wget https://phar.phpunit.de/phpunit-old.phar
     chmod +x phpunit-old.phar
     sudo mv phpunit-old.phar /usr/bin/phpunit

     cd /var/www
     sudo chown -R vagrant .

     wget https://wordpress.org/wordpress-4.0.tar.gz && tar xfz wordpress-4.0.tar.gz && rm wordpress-4.0.tar.gz && mv wordpress wp4_0
     cp wp4_0/wp-config-sample.php wp4_0/wp-config.php
     sed -i -e 's/database_name_here/wp4_0/g' wp4_0/wp-config.php
     sed -i -e 's/username_here/root/g' wp4_0/wp-config.php
     sed -i -e 's/password_here/root/g' wp4_0/wp-config.php
     cp -r /vagrant/src wp4_0/wp-content/plugins/easyappointments-wp
     mysql -u root -proot -e "CREATE DATABASE wp4_0"
     mysql -u root -proot wp4_0 < /vagrant/rsc/wp4_0.sql

     wget https://wordpress.org/wordpress-4.1.tar.gz && tar xfz wordpress-4.1.tar.gz && rm wordpress-4.1.tar.gz && mv wordpress wp4_1
     cp wp4_1/wp-config-sample.php wp4_1/wp-config.php
     sed -i -e 's/database_name_here/wp4_1/g' wp4_1/wp-config.php
     sed -i -e 's/username_here/root/g' wp4_1/wp-config.php
     sed -i -e 's/password_here/root/g' wp4_1/wp-config.php
     cp -r /vagrant/src wp4_1/wp-content/plugins/easyappointments-wp
     mysql -u root -proot -e "CREATE DATABASE wp4_1"
     mysql -u root -proot wp4_1 < /vagrant/rsc/wp4_1.sql

     wget https://wordpress.org/wordpress-4.2.tar.gz && tar xfz wordpress-4.2.tar.gz && rm wordpress-4.2.tar.gz && mv wordpress wp4_2
     cp wp4_2/wp-config-sample.php wp4_2/wp-config.php
     sed -i -e 's/database_name_here/wp4_2/g' wp4_2/wp-config.php
     sed -i -e 's/username_here/root/g' wp4_2/wp-config.php
     sed -i -e 's/password_here/root/g' wp4_2/wp-config.php
     cp -r /vagrant/src wp4_2/wp-content/plugins/easyappointments-wp
     mysql -u root -proot -e "CREATE DATABASE wp4_2"
     mysql -u root -proot wp4_2 < /vagrant/rsc/wp4_2.sql

     wget https://wordpress.org/wordpress-4.3.tar.gz && tar xfz wordpress-4.3.tar.gz && rm wordpress-4.3.tar.gz && mv wordpress wp4_3
     cp wp4_3/wp-config-sample.php wp4_3/wp-config.php
     sed -i -e 's/database_name_here/wp4_3/g' wp4_3/wp-config.php
     sed -i -e 's/username_here/root/g' wp4_3/wp-config.php
     sed -i -e 's/password_here/root/g' wp4_3/wp-config.php
     cp -r /vagrant/src wp4_3/wp-content/plugins/easyappointments-wp
     mysql -u root -proot -e "CREATE DATABASE wp4_3"
     mysql -u root -proot wp4_3 < /vagrant/rsc/wp4_3.sql

     wget https://wordpress.org/wordpress-4.4.tar.gz && tar xfz wordpress-4.4.tar.gz && rm wordpress-4.4.tar.gz && mv wordpress wp4_4
     cp wp4_4/wp-config-sample.php wp4_4/wp-config.php
     sed -i -e 's/database_name_here/wp4_4/g' wp4_4/wp-config.php
     sed -i -e 's/username_here/root/g' wp4_4/wp-config.php
     sed -i -e 's/password_here/root/g' wp4_4/wp-config.php
     cp -r /vagrant/src wp4_4/wp-content/plugins/easyappointments-wp
     mysql -u root -proot -e "CREATE DATABASE wp4_4"
     mysql -u root -proot wp4_4 < /vagrant/rsc/wp4_4.sql

     wget https://wordpress.org/wordpress-4.5.tar.gz && tar xfz wordpress-4.5.tar.gz && rm wordpress-4.5.tar.gz && mv wordpress wp4_5
     cp wp4_5/wp-config-sample.php wp4_5/wp-config.php
     sed -i -e 's/database_name_here/wp4_5/g' wp4_5/wp-config.php
     sed -i -e 's/username_here/root/g' wp4_5/wp-config.php
     sed -i -e 's/password_here/root/g' wp4_5/wp-config.php
     cp -r /vagrant/src wp4_5/wp-content/plugins/easyappointments-wp
     mysql -u root -proot -e "CREATE DATABASE wp4_5"
     mysql -u root -proot wp4_5 < /vagrant/rsc/wp4_5.sql
  SHELL
end
