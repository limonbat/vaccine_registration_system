# Use the official PHP 7.4 with Apache base image
FROM php:7.4-apache as php

MAINTAINER Nurul Amin Limon <limonfpi408@gmail.com>

# Set environment variables for the container
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    curl \
    bash \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libzip-dev \
    zlib1g-dev \
    libicu-dev \
    libonig-dev \
    openssl \
    libcurl4-openssl-dev \
    autoconf \
    g++ \
    make \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip bcmath intl mbstring

# Set the Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update the default Apache site configuration
COPY default.conf /etc/apache2/sites-available/000-default.conf

# Install Composer globally
COPY --from=composer:2.2.21 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files first
COPY composer.json ./

# Install Composer dependencies
RUN composer install --no-autoloader --no-scripts && \
    composer dump-autoload --optimize

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy existing application directory permissions
COPY --chown=www-data:www-data . .

# Expose port 80 for Apache
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
