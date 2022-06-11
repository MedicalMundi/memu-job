ARG NGINX_BASE_VERSION=alpine

FROM webdevops/nginx:$NGINX_BASE_VERSION AS builder_infrastructure

#HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["php-fpm-healthcheck"]




WORKDIR '/app'

COPY . .

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





#COPY --from=builder_vendor --chown=${MEDICALMUNDI_UID}:${MEDICALMUNDI_GID} --chmod=0776 /app /app
#COPY --from=builder_vendor --chown=application:application --chmod=0776 /app /app

#COPY --from=builder_vendor --chown=application:application /app /app
