FROM php:8.2-cli-alpine

RUN apk add --no-cache zip unzip git

# INSTALL COMPOSER
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
