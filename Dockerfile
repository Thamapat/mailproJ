FROM php:7.4-apache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    php7.4-cli \
    php7.4-common \
    php7.4-json \
    git \
    unzip

# Set the working directory
WORKDIR /var/www/html

# Install Composer dependencies
RUN composer install
