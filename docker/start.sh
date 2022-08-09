#!/bin/sh

cd /var/www/html/ && php artisan optimize && php artisan cache:clear
supervisord -c /etc/supervisord.conf
exec nginx
