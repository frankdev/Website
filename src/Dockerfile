FROM php:8.2-fpm as php

ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMP=1
ENV PHP_OPCACHE_REVALIDATE_FREQ=1


RUN usermod -u 1000 www-data

RUN apt-get update -y
RUN apt-get update && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev nginx libonig-dev
RUN docker-php-ext-install pdo pdo_pgsql bcmath curl opcache

RUN pecl install -o -f redis \
  && rm -rf /tmp/pear \
  && docker-php-ext-enable redis

# Copy composer executable.
COPY --from=composer:2.3.5 /usr/bin/composer /var/bin/composer

# Copy configuration files.
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fom.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

# Set working directory to /var/www.
WORKDIR /var/www

# Copy files from current folder to container current folder (set in workdir).
COPY --chown=www-data:www-data . .

# Create laravel caching folders.
RUN mkdir -p /var/www/storage/framework
RUN mkdir -p /var/www/storage/framework/cache
RUN mkdir -p /var/www/storage/framework/testing
RUN mkdir -p /var/www/storage/framework/sessions
RUN mkdir -p /var/www/storage/framework/views


# Fix files ownership.
RUN chown -R www-data /var/www/storage
RUN chown -R www-data /var/www/storage/framework
RUN chown -R www-data /var/www/storage/framework/sessions

# Adjust user permission & group
RUN usermod --uid 1000 www-data
RUN groupmod --gid 1001 www-data

# Run the entrypoint file.
ENTRYPOINT [ "docker/entrypoint.sh" ]