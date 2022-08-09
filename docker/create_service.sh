#!/bin/bash

docker service create \
    --name ghaem_production \
    --replicas=1 \
    --publish published=81,target=80,mode=ingress \
    --with-registry-auth \
    --init \
    --mount type=bind,source=/var/log/ghaem/.env,destination=/var/www/html/.env \
    --mount type=bind,source=/var/log/ghaem/nginx,destination=/var/log/nginx \
    --mount type=bind,source=/var/log/ghaem/php,destination=/var/log/php \
    --mount type=bind,source=/var/log/ghaem/supervisor,destination=/var/log/supervisor \
    --mount type=bind,source=/var/log/ghaem/laravel_storage,destination=/var/www/html/storage \
    --mount type=tmpfs,destination=/var/nginx/cache,tmpfs-size=10m \
    -u nobody \
    $1