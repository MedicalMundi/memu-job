ARG PHP_BASE_VERSION=7.4

FROM webdevops/php:$PHP_BASE_VERSION AS builder_infrastructure

RUN set -eux \
    apk add --update --no-cache fcgi \
    libfcgi-bin
# Enable php fpm status page
#RUN set -xe && echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN set -xe && echo "pm.status_path = /status" >> /opt/docker/etc/php/fpm/pool.d/zz-docker.conf

RUN wget -O "/usr/local/bin/php-fpm-healthcheck" \
  "https://raw.githubusercontent.com/renatomefi/php-fpm-healthcheck/master/php-fpm-healthcheck" \
  && chmod +x "/usr/local/bin/php-fpm-healthcheck"

HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["php-fpm-healthcheck"]



FROM builder_infrastructure as builder_vendor

WORKDIR '/app'

COPY composer.json .
COPY composer.lock .

RUN composer install --optimize-autoloader --ansi --no-interaction --no-progress --no-scripts --no-suggest

COPY . .

RUN rm -fr docker \
    sys \
    tools \
    tests \
    core/ingesting/tests  \
    core/publishing/tests

RUN rm -fr docker \
    sys \
    tools \
    tests \
    core/ingesting/tests  \
    core/publishing/tests

RUN rm -f .dockerignore \
    .env.test \
    .gitignore \
    README.md \
    Makefile \
    docker-compose.custom.yaml  \
    docker-compose.webdevilops.yaml \
    dockerhub.makefile \
    ecs.php \
    phpstan-baseline.neon \
    phpstan.neon \
    phpunit.core.xml \
    phpunit.xml.dist \
    psalm-baseline.xml \
    psalm.xml



#ARG MEDICALMUNDI_UID=medicalmundi
#ARG MEDICALMUNDI_GID=medicalmundi
#FROM builder_vendor AS builder_medicalmundi
#
##SHELL ["/bin/bash", "--login", "-c"]
#
#WORKDIR '/app'
#
## Create a group and user
#RUN addgroup -S ${MEDICALMUNDI_GID} && adduser -S ${MEDICALMUNDI_UID} -G ${MEDICALMUNDI_GID}
#
#
#ARG MEDICALMUNDI_UID=medicalmundi
#ARG MEDICALMUNDI_GID=medicalmundi

FROM builder_vendor

WORKDIR '/app'

#RUN mkdir -p /app/var/cache \
#    mkdir -p /app/var/log

#COPY --from=builder_vendor --chown=${MEDICALMUNDI_UID}:${MEDICALMUNDI_GID} --chmod=0776 /app /app
COPY --from=builder_vendor --chown=application:application --chmod=0776 /app /app

EXPOSE 9000
