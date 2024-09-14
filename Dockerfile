FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_mysql zip
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

EXPOSE 80
