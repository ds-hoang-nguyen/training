#!/bin/bash
cd /code

# Laravel Setup
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run production

# Clear cache for events, views, cache, route, config, compiled
php artisan optimize:clear

# Add Permission
chown -R www-data:www-data /code/storage
chown -R www-data:www-data /code/bootstrap/cache
chmod -R ugo+rw /code/storage
chmod -R ugo+rw /code/bootstrap/cache

# Excute other command from cmd
exec $@
