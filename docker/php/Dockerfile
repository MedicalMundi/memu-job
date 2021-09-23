FROM php:7.4-fpm-alpine3.14

RUN mkdir /app
WORKDIR /app


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

RUN install-php-extensions opcache

RUN install-php-extensions apcu

RUN install-php-extensions redis

RUN install-php-extensions xsl

RUN install-php-extensions zip

RUN install-php-extensions yaml

RUN install-php-extensions xlswriter

RUN install-php-extensions pcntl

RUN install-php-extensions amqp

RUN install-php-extensions gd

RUN install-php-extensions mysqli \
    pdo_mysql

RUN install-php-extensions pgsql \
    pdo_pgsql

RUN install-php-extensions xdebug

RUN install-php-extensions pcov



# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer


# Base images don't need healthcheck since they are not running applications
# this can be overriden in the child images
HEALTHCHECK NONE

CMD [ "php-fpm" ]