#!/bin/sh

cd /var/www/html/ && php artisan optimize
supervisord -c /etc/supervisord.conf
exec nginx
