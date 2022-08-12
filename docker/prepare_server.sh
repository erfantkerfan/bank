#!/bin/bash

mkdir -p /var/log/ghaem/laravel_storage

mkdir -p /var/log/ghaem/nginx
mkdir -p /var/log/ghaem/php
mkdir -p /var/log/ghaem/supervisor

chown -R nobody:nogroup /var/log/ghaem
