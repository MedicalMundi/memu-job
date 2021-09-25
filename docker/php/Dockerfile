ARG PHP_BASE_VERSION=base-v0.1.0

FROM medicalmundi/internal-php-base:$PHP_BASE_VERSION AS builder_vendor

WORKDIR '/app'

COPY composer.json .
COPY composer.lock .

RUN composer install --optimize-autoloader --ansi --no-interaction --no-progress --no-scripts --no-suggest

COPY . .


FROM builder_vendor

EXPOSE 9000

# SETUP healtcheck method
#HEALTHCHECK NONE

CMD [ "php-fpm" ]