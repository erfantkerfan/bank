#!/bin/bash

docker service create \
    --name test \
    --replicas=1 \
    --publish published=81,target=80,mode=ingress \
    --with-registry-auth \
    --init \
    --mount type=bind,source=/var/log/direct_debit/.env,destination=/var/www/html/.envno \
    --mount type=bind,source=/var/log/direct_debit/nginx,destination=/var/log/nginx \
    --mount type=bind,source=/var/log/direct_debit/php,destination=/var/log/php \
    --mount type=bind,source=/var/log/direct_debit/supervisor,destination=/var/log/supervisor \
    --mount type=bind,source=/var/log/direct_debit/laravel_storage,destination=/var/www/html/storage \
    --mount type=tmpfs,destination=/var/nginx/cache,tmpfs-size=10m \
    -u nobody \
    $1
