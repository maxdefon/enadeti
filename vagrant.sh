#!/usr/bin/env bash

apt-get update
apt-get upgrade -y
apt-get autoremove -y

# add apache and php
if [[ ! -e ~/.apache_done ]]; then
    # install apache and php
    apt-get install apache2 libapache2-mod-php5 php5-pgsql php5 php5-cli php5-curl php5-common php5-gd php5-xdebug php5-sqlite php5-pgsql php5-mysql -y
    a2enmod rewrite
    service apache2 stop
    # use the project folder as main folder
    rm /var/www -Rf
    ln -s /vagrant /var/www
    chown vagrant /var/lock/apache2 -Rf
    # setup apache vars
    sed -i -e 's/RUN_USER=www-data/RUN_USER=vagrant/g' /etc/apache2/envvars
    cp /vagrant/default.conf /etc/apache2/sites-available/000-default.conf
    # setup some php env vars
    sed -i -e 's/memory_limit.*/memory_limit=512M/g' /etc/php5/apache2/php.ini
    sed -i -e 's/upload_max_filesize.*/upload_max_filesize=128M/g' /etc/php5/apache2/php.ini
    sed -i -e 's/post_max_size.*/post_max_size=128M/g' /etc/php5/apache2/php.ini
    sed -i -e 's/display_errors.*/display_erros=On/g' /etc/php5/apache2/php.ini
    echo "127.0.0.1 test.localhost" >> /etc/hosts
    # restart
    service apache2 start
    touch ~/.apache_done
fi

if [[ ! -e ~/.mysql_done ]]; then
    debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
    debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
    apt-get install -y mysql-server mysql-client
    echo 'CREATE DATABASE enade ;' | mysql -uroot -proot
    echo 'CREATE DATABASE enade_test ;' | mysql -uroot -proot
    mysql -uroot -proot enade < /vagrant/schema.sql
    mysql -uroot -proot enade < /vagrant/load.sql
    mysql -uroot -proot enade_test < /vagrant/schema.sql
    mysql -uroot -proot enade_test < /vagrant/load.sql
fi

if [[ ! -e ~/.app_done ]]; then
    su vagrant -lc "cd /vagrant && curl -sS https://getcomposer.org/installer | php"
    su vagrant -lc "cd /vagrant && php composer.phar update && php composer.phar install"
    touch ~/.app_done
fi

if [[ ! -e ~/.phantom_done ]]; then
    #apt-get install -y phantomjs
    wget https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-1.9.7-linux-x86_64.tar.bz2 -O /opt/phantomjs.tar.bz2
    cd /opt 
    tar -xvf phantomjs.tar.bz2
    mv phantomjs-1.9.7-linux-x86_64 phantomjs
    ln -s /opt/phantomjs/bin/phantomjs /usr/bin/phantomjs
    echo 'nohup phantomjs --webdriver=8643 > /dev/null 2>&1 &' > /etc/rc.local
    touch ~/.phantom_done
fi


# done
echo "Done bootstraping"

