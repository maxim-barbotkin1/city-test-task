FROM php:7.4-fpm

#RUN userdel -r user
RUN useradd -ms /bin/bash user || true

RUN apt-get update

RUN apt-get install -y cron nano mc

# PHP helpers
RUN apt-get install -y \
    # bz2
    libbz2-dev \
    # curl
    libcurl4-openssl-dev \
    # gd
    libpng-dev libjpeg-dev \
    # intl
    libicu-dev \
    # mbstring
    libonig-dev \
    # zip
    zlib1g-dev libzip-dev

# Zip, unzip
RUN apt-get install -y zip unzip

# Composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer && php /tmp/composer-setup.php --install-dir=/usr/local/bin/ --filename=composer

RUN docker-php-ext-install \
     curl gd json intl mbstring pdo_mysql tokenizer zip
#    calendar dba dom enchant exif ffi filter ftp gettext gmp hash iconv imap
#    ldap oci8 odbc opcache pdo pdo_dblib pdo_firebird pdo_oci
#    pdo_odbc pdo_pgsql pdo_sqlite pgsql phar posix pspell readline \
#    reflection session shmop simplexml snmp soap sockets sodium spl standard \
#    sysvmsg sysvsem sysvshm tidy xml xmlreader xmlrpc xmlwriter xsl zend_test

#pdf font libraries
RUN apt install -y libfontconfig

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# update the repository sources list
# and install dependencies
RUN apt-get update \
    && apt-get install -y curl \
    && apt-get -y autoclean

