FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

# DEBUG
# RUN pecl install xdebug && docker-php-ext-enable xdebug