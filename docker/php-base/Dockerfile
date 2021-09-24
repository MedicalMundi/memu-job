FROM php:7.4-fpm-alpine3.14 AS builder_tools
# install dependencies
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync

RUN apk add --no-cache --virtual .builddeps \
        autoconf \
        g++ \
        gcc \
        make \
        unzip \
        wget


FROM builder_tools AS builder_php_extensions

RUN install-php-extensions  \
    opcache \
    apcu \
    redis \
    xsl \
    zip \
    yaml \
    xlswriter \
    pcntl \
    amqp \
    gd \
    mysqli \
    pdo_mysql \
    pgsql \
    pdo_pgsql \
    xdebug \
    pcov


FROM builder_php_extensions

RUN mkdir /app

WORKDIR /app


# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer


# Base images don't need healthcheck since they are not running applications
# this can be overriden in the child images
HEALTHCHECK NONE

CMD [ "php-fpm" ]