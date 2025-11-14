to start project with sail:

```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v $(pwd):/var/www/html \
-w /var/www/html \
laravelsail/php84-composer:latest \
composer install --ignore-platform-reqs
```