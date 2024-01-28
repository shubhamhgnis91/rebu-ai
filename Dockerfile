# syntax=docker/dockerfile:1

# Stage 1: Composer Dependencies
FROM composer:2.1.8 as deps

WORKDIR /app

# Install dependencies
RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=bind,source=composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction \
    && rm -rf /tmp/cache

# Stage 2: Final PHP and Apache Image
FROM php:8.2.4-apache as final

# Install additional dependencies
RUN apt-get update && apt-get install -y \
        libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_pgsql pgsql

# Copy application files
COPY . .

# Rename production php.ini
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy custom Apache configuration
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy dependencies from the deps stage
COPY --from=deps /app/vendor/ /var/www/html/vendor

# Switch to a non-privileged user
USER www-data
