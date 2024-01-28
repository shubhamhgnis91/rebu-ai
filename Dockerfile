# syntax=docker/dockerfile:1

FROM composer:lts as deps

WORKDIR /app


RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=bind,source=composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.2.4-apache as final

RUN apt-get update && apt-get install -y \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql pgsql

COPY . .

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY --from=deps app/vendor/ /var/www/html/vendor

USER www-data

