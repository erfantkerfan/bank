#!/bin/bash

mkdir -p /var/log/direct_debit/laravel_storage/logs
mkdir -p /var/log/direct_debit/laravel_storage/queue_logs
mkdir -p /var/log/direct_debit/laravel_storage/framework/cache
mkdir -p /var/log/direct_debit/laravel_storage/framework/sessions
mkdir -p /var/log/direct_debit/laravel_storage/framework/views

mkdir -p /var/log/direct_debit/nginx
mkdir -p /var/log/direct_debit/php
mkdir -p /var/log/direct_debit/supervisor

chown -R nobody:nobody /var/log/direct_debit
