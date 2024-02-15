FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libgd-dev

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql


WORKDIR /var/www/app
