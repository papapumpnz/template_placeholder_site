FROM php:7.2.1-apache
RUN docker-php-ext-install mysqli

WORKDIR /var/www/html

# copy source
ADD ./dist .