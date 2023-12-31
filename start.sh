#!/usr/bin/env sh

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

#if [ "$env" != "local" ]; then
#    echo "Caching configuration..."
#    (cd /var/www/html && php artisan config:cache && php artisan route:cache && php artisan view:cache)
#fi

if [ "$role" = "app" ]; then

    echo "***"

    echo "***"
        php artisan optimize:clear
        echo "***"
        php artisan config:clear
        echo "***"

    exec php-fpm -y /usr/local/etc/php-fpm.conf -R
#    /usr/local/bin/docker-php-entrypoint "$@"

elif [ "$role" = "queue" ]; then

    php artisan optimize:clear

    php artisan queue:work --verbose --tries=3 --timeout=90

else
    echo "Could not match the container role \"$role\""
    exit 1
fi