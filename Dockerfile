FROM php:fpm

MAINTAINER Pavel Stejskal

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y curl git zlib1g-dev libicu-dev libpng-dev libpq-dev  && \
    docker-php-ext-install zip pdo pdo_pgsql intl opcache gd exif && \
    apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer global require "hirak/prestissimo:^0.3" && \
    rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

RUN echo "/usr/local/lib/php/extensions/no-debug-non-zts-20151012/xdebug.so" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /srv