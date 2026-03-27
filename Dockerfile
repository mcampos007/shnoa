FROM php:8.3-apache

# Extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Activar mod_rewrite
RUN a2enmod rewrite

# Configuración de Apache para Laravel
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
