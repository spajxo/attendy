FROM php:apache

MAINTAINER Pavel Stejskal <spajxo@gmail.com>

ENV TZ Europe/Prague
ENV DEBIAN_FRONTEND noninteractive

RUN \
    # Libraries
    apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
        curl \
        git \
        zlib1g-dev \
        libicu-dev \
        libpng-dev && \

    # PHP Extensions
    docker-php-ext-install \
        zip \
        pdo \
        pdo_mysql \
        intl \
        opcache \
        gd \
        exif && \

    # Apache Modules
    a2enmod rewrite && \

    # Timezone
    echo "date.timezone = $TZ" >> /usr/local/etc/php/php.ini && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \

    # Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer global require "hirak/prestissimo:^0.3" && \

    # XDebug
    yes | pecl install xdebug && \
    echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.default_enable = 0" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_enable = 1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_host=172.17.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini && \

    # Cleanup
    apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
    rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

WORKDIR /var/www/html

COPY docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/
COPY docker/php/custom.ini /etc/php5/apache2/conf.d/