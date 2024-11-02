FROM php:8.2-fpm

WORKDIR var/www

RUN apt-get update && apt-get install -y  \
    curl \
    build-essential \
    libmemcached-dev \
    libmcrypt-dev \
    libxml2-dev \
    autoconf \
    openssl \
    libpq-dev \
    zip \
    unzip


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pgsql pdo pdo_pgsql pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /var/www

USER www
