FROM php:7.3-apache

RUN apt-get update \
 && apt-get install -y git libzip-dev libicu-dev libxml2-dev \
 && docker-php-ext-install zip pdo_mysql intl soap \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

