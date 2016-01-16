#!/usr/bin/env bash

# Constants
PHP_TIMEZONE=Europe/Paris
VHOST_GUIDE=$(cat <<EOF
server {
    server_name resto.localhost.com;
    root /var/www/resto/web;

    location / {
        try_files \$uri @rewriteapp;
    }
    location @rewriteapp {
        rewrite ^(.*)\$ /app.php/\$1 last;
    }
    location ~ ^/(app|app_dev|app_test|config)\.php(/|\$) {
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)\$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param HTTPS off;
    }
    error_log /var/log/nginx/resto_error.log;
    access_log /var/log/nginx/resto_access.log;
}
EOF
)

# Ubuntu
echo ">>> Updating packages"
sudo apt-get update
sudo apt-get -y upgrade
sudo apt-get -y autoremove
sudo apt-get install -y language-pack-UTF-8

# Tools
echo ">>> Installing tools"
sudo apt-get install -y git
sudo apt-get install -y nano

# PHP
echo ">>> Installing PHP"
sudo apt-get install -y php5-cli php5-curl php5-gd php5-gmp php5-mcrypt php5-memcached php5-imagick php5-intl php5-xdebug
sudo sed -i "s/;date.timezone =.*/date.timezone = ${PHP_TIMEZONE/\//\\/}/" /etc/php5/fpm/php.ini
sudo sed -i "s/;date.timezone =.*/date.timezone = ${PHP_TIMEZONE/\//\\/}/" /etc/php5/cli/php.ini

# Web server
echo ">>> Installing Nginx Server with PHP-FPM"
sudo apt-get install -y php5-fpm nginx

# MongoDB
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
echo "deb http://repo.mongodb.org/apt/ubuntu "$(lsb_release -sc)"/mongodb-org/3.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-3.0.list
sudo apt-get update
sudo apt-get install -y mongodb-org
sudo apt-get install -y php5-mongo

# Virtual Host
echo "${VHOST_GUIDE}" > /etc/nginx/sites-available/resto.conf
sudo ln -s /etc/nginx/sites-available/resto.conf /etc/nginx/sites-enabled/resto.conf
sudo service nginx restart

# PHP Tools
echo ">>> Installing PHP tools"

curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

