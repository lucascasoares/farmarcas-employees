FROM php:8.1.8-fpm-alpine

#Root project folder
WORKDIR "/var/www/farmarcas-employees"

ARG DEBIAN_FRONTEND=noninteractive

#Add some dependencies
RUN apk add --no-cache openssl pcre-dev libtool \
bash nodejs npm postgresql-dev \
libxml2-dev

#Add php extensions
RUN docker-php-ext-install bcmath pdo pdo_pgsql soap pcntl exif

#Add composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
