ARG PHP_VERSION=8.1-fpm-alpine3.14

FROM php:${PHP_VERSION} AS php_builder

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

RUN install-php-extensions  \
    amqp \
    apcu \
    gd \
    intl \
    yaml \
    mysqli \
    opcache \
    pcov \
    pcntl \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    redis \
    zip \
    xdebug \
    xlswriter \
    xsl

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer


FROM php_builder as php_base

RUN mkdir /app

WORKDIR /app

# Base images don't need healthcheck since they are not running applications
# this can be overriden in the child images
HEALTHCHECK NONE

EXPOSE 9000

CMD [ "php-fpm" ]


FROM php_base as php_dev

# Base images don't need healthcheck since they are not running applications
# this can be overriden in the child images
HEALTHCHECK NONE


# see https://hub.docker.com/_/php
# see dev configuration params https://github.com/php/php-src/blob/master/php.ini-development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

CMD [ "php-fpm" ]