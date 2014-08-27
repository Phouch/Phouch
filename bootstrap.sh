#!/bin/bash

echo "-------- Starting set up ------------"

# Update aptitude
sudo apt-get update

echo "-------- Done with aptitude update. Continue? ------------"
 
# Install vim
sudo apt-get install -y vim

echo "-------- Done with vim install. Continue? ------------"
 
# Install vim gnome (allows clipboard access. Not sure what else yet lol)
sudo apt-get install -y vim-gnome

echo "-------- Done with vim gnome install. Continue? ------------"

# Install apache2
sudo apt-get install -y apache2

echo "-------- Done with apache install. Continue? ------------"

# Install git
apt-get install git -y

echo "-------- Done with git install. Continue? ------------"
 
# Start apache2
sudo service apache2 restart

echo "-------- Done with apache restart. Continue? ------------"
 
# Make sure apache2 has mod_rewrite enabled
sudo a2enmod rewrite

echo "-------- Done with enabling mod rewrite. Continue? ------------"
 
# Get PHP
sudo apt-get install php5-common libapache2-mod-php5 php5-cli -y

# Get curl
sudo apt-get install curl libcurl3 libcurl3-dev php5-curl -y

# Start apache2
sudo service apache2 restart

echo "-------- Done with apache restart. Continue? ------------"

echo "-------- Done with installing php. Continue? ------------"

# Create a symlink to the php binary
sudo ln -s /usr/local/bin/php /usr/bin/php

echo "-------- Done with creating symlink for php binary. Continue? ------------"
 
# Enable php in apache
sudo a2enmod php5

echo "-------- Done with enabling php in apache. Continue? ------------"
 
# Restart apache2
sudo service apache2 restart

echo "-------- Done with restarting apache. Continue?"  nothing

# Install CouchDB
sudo apt-get install couchdb -y

echo "-------- Done with installing couchdb. Continue? ------------"

# Install xdebug
cd
git clone git://github.com/derickr/xdebug.git
cd xdebug*
phpize
./configure --enable-xdebug
make
sudo make install

echo "-------- Done with installing xdebug. Continue? ------------"
 
# Make shortcuts for editing configs
cd
mkdir _lamp && cd _lamp
sudo ln -s /etc/apache2/httpd.conf
sudo ln -s /etc/apache2/sites-available/default
sudo ln -s /etc/php5/php.ini

echo "-------- Done with making apache and php shortcuts. Continue? ------------"
 
# Set PHP ini from https://gist.github.com/jessiegreen/fb539b9ab349227a0cb0

# sudo vim ~/_lamp/php.ini
 
# Give user permission to edit web root. (I still could not edit without sudo after this. Not sure why)
sudo usermod -a -G www-data vagrant
sudo chown -R root:www-data /var/www
sudo chmod -R 775 /var/www

echo "-------- Done giving web root directory permissions to vagrant user. Continue? ------------"

# Globally install composer and create alias
cd ~
curl -s http://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Restart apache2
sudo service apache2 restart

echo "-------- Done restarting apache ------------"

# Update composer
composer self-update

echo "-------- Done installing Composer ------------"

# Restart apache2
sudo service apache2 restart

echo "-------- Done restarting apache ------------"

# Set the webroot as the example folder
rm -rf /var/www
ln -fs /vagrant/example /var/www

echo "-------- Done linking webroot to example folder ------------"

cd /vagrant/example
composer install

echo "-------- Done doing Composer install -----------"

# Restart apache2
sudo service apache2 restart

echo "-------- Done ------------"