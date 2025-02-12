FROM composer:2.7 AS vendor

COPY app/composer.json /app/composer.json
COPY app/composer.lock /app/composer.lock

ARG BUILD_DEV="--no-dev"

RUN COMPOSER_MEMORY_LIMIT=-1  composer install \
    -d /app/ \
    --ignore-platform-reqs \
    --prefer-dist $BUILD_DEV \
    --no-progress \
    --no-interaction \
    --optimize-autoloader

FROM php:8.4-cli-alpine

# Get the UID and GID from the build arguments
ARG UID=1000
ARG GID=1000

# Create a non-root user and group with the same UID and GID as the host user
RUN addgroup -g ${GID} appgroup && adduser -u ${UID} -G appgroup -S appuser

COPY --from=vendor --chown=${UID}:${GID} /app/vendor/ /app/vendor/

USER appuser

COPY app /app/.
COPY app/.env.example /app/.env

WORKDIR /app
