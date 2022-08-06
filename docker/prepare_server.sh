#!/bin/bash

mkdir -p /var/log/ghaem/laravel_storage/logs
mkdir -p /var/log/ghaem/laravel_storage/queue_logs
mkdir -p /var/log/ghaem/laravel_storage/framework/cache
mkdir -p /var/log/ghaem/laravel_storage/framework/sessions
mkdir -p /var/log/ghaem/laravel_storage/framework/views

mkdir -p /var/log/ghaem/nginx
mkdir -p /var/log/ghaem/php
mkdir -p /var/log/ghaem/supervisor

chown -R nobody:nogroup /var/log/ghaem
