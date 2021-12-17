ARG PHP_BASE_VERSION=base-v0.1.0

FROM ghcr.io/medicalmundi/internal-php-base:$PHP_BASE_VERSION AS builder_vendor

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



ARG MEDICALMUNDI_UID=medicalmundi
ARG MEDICALMUNDI_GID=medicalmundi
FROM builder_vendor AS builder_medicalmundi

#SHELL ["/bin/bash", "--login", "-c"]

WORKDIR '/app'

# Create a group and user
RUN addgroup -S ${MEDICALMUNDI_GID} && adduser -S ${MEDICALMUNDI_UID} -G ${MEDICALMUNDI_GID}


ARG MEDICALMUNDI_UID=medicalmundi
ARG MEDICALMUNDI_GID=medicalmundi

FROM builder_medicalmundi

WORKDIR '/app'

RUN mkdir -p /app/var/cache \
    mkdir -p /app/var/log

COPY --from=builder_vendor --chown=${MEDICALMUNDI_UID}:${MEDICALMUNDI_GID} --chmod=0776 /app /app

EXPOSE 9000

# SETUP healtcheck method
#HEALTHCHECK NONE

CMD [ "php-fpm" ]