#!/usr/bin/bash

if [ ! -f vendor/autoload.php ]; then
  composer install --optimize-autoloader --no-dev --no-progress --no-interaction
fi

if [! -f  ".env"]; then
  echo "Creating env file for env $APP_ENV"
  cp .env.example .env
else
  echo "enf file exists."
fi

php artisan migrate
php artisan optimize
php artisan view:cache

php-fpm -D
nginx -g "daemon off;"