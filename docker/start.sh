#!/bin/sh

php /var/www/html/artisan optimize
supervisord -c /etc/supervisord.conf
exec nginx
