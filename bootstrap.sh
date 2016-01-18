#! /usr/bin/env bash

# Variables
APPENV=local
DBHOST=localhost
DBPORT=5432
DBUSER=test
DBPASSWD=r4shXqJa
DBNAME1=exercise
DBNAME2=exercise_test
MGKEY=
TXTKEY=
REMOTE_HOST=10.0.2.2
REMOTE_NETWORK=10.0.2.0/24
GITHUB_TOKEN= TOKEN_HERE


echo -e "\n--- Installing now... ---\n"

echo -e "\n--- Set system encoding to UTF-8 ---\n"

echo 'LC_ALL="en_US.UTF-8"'  >  /etc/default/locale
#locale-gen en_US.UTF-8 > /dev/null 2>&1
#dpkg-reconfigure locales > /dev/null 2>&1

echo -e "\n--- Updating packages list ---\n"
apt-get -qq update

echo -e "\n--- Install base packages ---\n"
apt-get -y install vim curl wget build-essential python-software-properties git debian-keyring ca-certificates > /dev/null 2>&1

echo -e "\n--- Add some repos to update our distro ---\n"
add-apt-repository 'deb http://packages.dotdeb.org wheezy-php55 all'
add-apt-repository 'deb http://apt.postgresql.org/pub/repos/apt/ wheezy-pgdg main 9.4 9.3'

wget --quiet -O - http://www.dotdeb.org/dotdeb.gpg | apt-key add - > /dev/null 2>&1

echo -e "\n--- Import repository key for postgres ---\n"
wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - > /dev/null 2>&1

#echo -e "\n--- Add Wkhtmltopdf repository ---\n"
#sudo -y add-apt-repository ppa:pov/wkhtmltopdf

echo -e "\n--- Updating packages list ---\n"
apt-get -qq update

#apt-get -y install wkhtmltopdf

echo -e "\n--- Install PostgreSQL specific packages and settings ---\n"
apt-get -y install postgresql-9.4 postgresql-contrib-9.4 > /dev/null 2>&1
sed -i "s/#listen_addresses = 'localhost'/listen_addresses = '*'/g" /etc/postgresql/9.4/main/postgresql.conf > /dev/null 2>&1
echo "host all all $REMOTE_NETWORK md5" >> /etc/postgresql/9.4/main/pg_hba.conf
echo -e "\n--- Restarting Postgres ---\n"
sudo service postgresql restart > /dev/null 2>&1

echo -e "\n--- Setting up our PostreSQL user and databases ---\n"
echo -e "\n--- psql - change root password ---\n"
sudo -u postgres psql postgres -c "alter user postgres with password 'aY34h8JJ';" > /dev/null 2>&1

echo -e "\n--- psql - create user $DBUSER ---\n"
sudo -u postgres psql postgres -c "create user $DBUSER with password '$DBPASSWD';" > /dev/null 2>&1

echo -e "\n--- psql - create database $DBNAME1 ---\n"
sudo -u postgres psql postgres -c "create database $DBNAME1 --locale=en_US.utf8 with encoding='UTF8';" > /dev/null 2>&1
sudo -u postgres psql postgres -c "grant all privileges on database $DBNAME1 to $DBUSER;" > /dev/null 2>&1
#sudo -u postgres psql $DBNAME1 -c "create extension hstore;" > /dev/null 2>&1

echo -e "\n--- psql - create database $DBNAME2 ---\n"
sudo -u postgres psql postgres -c "create database $DBNAME2 --locale=en_US.utf8 with encoding='UTF8';" > /dev/null 2>&1
sudo -u postgres psql postgres -c "grant all privileges on database $DBNAME2 to $DBUSER;" > /dev/null 2>&1
#sudo -u postgres psql $DBNAME2 -c "create extension hstore;" > /dev/null 2>&1

# EXAMPLE FOR MYSQL
# echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
# echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections
# echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
# echo "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD" | debconf-set-selections
# echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD" | debconf-set-selections
# echo "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD" | debconf-set-selections
# echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections
# apt-get -y install mysql-server-5.5 phpmyadmin > /dev/null 2>&1
# echo -e "\n--- Setting up our MySQL user and databases ---\n"
# mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
# mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'"

echo -e "\n--- Installing PHP-specific packages ---\n"
apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-intl php5-gd php5-mcrypt php5-pgsql phppgadmin > /dev/null 2>&1

echo -e "\n--- Installing xdebug php package ---\n"
apt-get -y install php5-xdebug > /dev/null 2>&1

echo -e "\n--- configure xdebug ---\n"
# XDEBUG_PATH="$(find /usr/lib/php5/ -name 'xdebug.so' 2> /dev/null)"

cat <<EOF >> /etc/php5/apache2/php.ini

[xdebug]
xdebug.default_enable = 1
xdebug.idekey = "vagrant"
xdebug.remote_enable = 1
xdebug.remote_autostart = 0
xdebug.remote_port = 9000
xdebug.remote_handler = dbgp
xdebug.remote_host = $REMOTE_HOST ; IDE-Environments IP, from vagrant box.
EOF

cat <<EOF >> /etc/php5/cli/php.ini

[xdebug]
xdebug.default_enable = 1
xdebug.idekey = "vagrant"
xdebug.remote_enable = 1
xdebug.remote_autostart = 1
xdebug.remote_port = 9000
xdebug.remote_handler = dbgp
xdebug.remote_host = $REMOTE_HOST ; IDE-Environments IP, from vagrant box.
EOF

echo -e "\n--- edit phpPgAdmin Apache configuration ---\n"
sed -i "s/# allow from all/allow from all/g" /etc/apache2/conf.d/phppgadmin > /dev/null 2>&1
mv /etc/apache2/conf.d/phppgadmin /etc/apache2/conf-available/phppgadmin.conf > /dev/null 2>&1
a2enconf phppgadmin > /dev/null 2>&1

echo -e "\n--- Enabling mod-rewrite ---\n"
a2enmod rewrite
a2enmod headers
a2enmod php5


echo -e "\n--- Setting web root to public directory ---\n"
rm -rf /var/www
ln -fs /vagrant /var/www

echo -e "\n--- We definitly need to see the PHP errors, turning them on ---\n"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini > /dev/null 2>&1
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini > /dev/null 2>&1

echo -e "\n--- We need to enable global php env variables ---\n"
sed -i "s/variables_order = .*/variables_order = \"EGPCS\"/" /etc/php5/apache2/php.ini > /dev/null 2>&1


echo -e "\n--- Turn off disabled pcntl functions so we can use Boris ---\n"
sed -i "s/disable_functions = .*//" /etc/php5/cli/php.ini

echo -e "\n--- Decrease php memory limit ---\n"
sed -i "s/memory_limit = .*/memory_limit = 32M/" /etc/php5/apache2/php.ini > /dev/null 2>&1

#echo -e "\n--- Configure Apache to use phpmyadmin ---\n"
#echo -e "\n\nListen 81\n" >> /etc/apache2/ports.conf
#cat > /etc/apache2/conf-available/phpmyadmin.conf << "EOF"
#<VirtualHost *:81>
#    ServerAdmin webmaster@localhost
#    DocumentRoot /usr/share/phpmyadmin
#    DirectoryIndex index.php
#    ErrorLog ${APACHE_LOG_DIR}/phpmyadmin-error.log
#    CustomLog ${APACHE_LOG_DIR}/phpmyadmin-access.log combined
#</VirtualHost>
#EOF
#
#a2enconf phpmyadmin > /dev/null 2>&1
#


echo -e "\n--- Add environment variables ---\n"
cat > /etc/environment <<EOF
export APP_ENV=$APPENV
export DB_HOST=$DBHOST
export DB_PORT=$DBPORT
export DB_USER=$DBUSER
export DB_PASS=$DBPASSWD
export DB_NAME=$DBNAME1
export DB_TEST=$DBNAME2
export MAILGUN_KEY=$MGKEY
export TXTNATION_KEY=$TXTKEY
EOF

source /etc/environment

echo -e "\n--- Add environment variables to Apache ---\n"
cat <<EOF >> /etc/apache2/envvars
# Load all the system environment variables.
. /etc/environment
EOF

#echo -e "\n--- Allowing Apache override to all ---\n"
#sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/sites-avalible/default > /dev/null 2>&1

cat > /etc/apache2/sites-available/localhost <<EOF
<VirtualHost *:80>
    DocumentRoot /var/www
     <Directory /var/www>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

a2ensite localhost

a2dissite default

echo -e "\n--- Restarting Apache ---\n"
service apache2 restart

echo -e "\n--- Installing Composer for PHP package management ---\n"
curl --silent https://getcomposer.org/installer | php > /dev/null 2>&1
mv composer.phar /usr/local/bin/composer

echo -e "\n--- Add github token for composer ---\n"
composer config -g github-oauth.github.com $GITHUB_TOKEN

#echo -e "\n--- Installing NodeJS and NPM ---\n"
apt-get -y install nodejs > /dev/null 2>&1

#echo -e "\n--- Installing javascript components ---\n"
npm install -g bower > /dev/null 2>&1

echo -e "\n--- Updating project components and pulling latest versions ---\n"
cd /vagrant

composer global require 'fxp/composer-asset-plugin:1.0.0'
composer install

echo -e "\n--- Updating path variable ---\n"
echo "export PATH=$PATH:/vagrant/vendor/bin" >> ~/.bash_profile

##cd /vagrant/client
sudo -u vagrant -H sh -c "npm install" > /dev/null 2>&1
sudo -u vagrant -H sh -c "bower install -s" > /dev/null 2>&1
##sudo -u vagrant -H sh -c "gulp" > /dev/null 2>&1

echo -e "\n--- Creating a symlink for future phpunit use ---\n"
ln -fs /vagrant/vendor/bin/phpunit /usr/local/bin/phpunit


echo -e "\n--- Create local configuration files ---\n"

cd /vagrant
echo "All" | php init --env=Development

echo -e "\n--- run application migration ---\n"
php yii migrate --interactive=0 > /dev/null 2>&1
