FROM alpine:3.18

LABEL maintainer="erfantkerfan"

RUN mkdir -p /nobody /var/log/php

RUN apk update \
    && apk add --no-cache \
    php82 \
    php82-bcmath \
    php82-ctype \
    php82-curl \
    php82-json \
    php82-mbstring \
    php82-fileinfo \
    php82-tokenizer \
    php82-dom \
    php82-iconv \
    php82-openssl \
    php82-pdo_mysql \
    php82-xml \
    php82-simplexml \
    php82-xmlreader \
    php82-xmlwriter \
    php82-zip \
    php82-soap \
    php82-gd \
    php82-phar \
    php82-pcntl \
    php82-posix \
    php82-pecl-redis \
    php82-pecl-imagick \
    php82-pecl-swoole \
    coreutils \
    nginx \
    curl \
    tzdata \
    logrotate \
    supervisor \
    supercronic \
    mysql-client \
    mariadb-connector-c

RUN php82 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && echo "$(curl 'https://composer.github.io/installer.sig')  composer-setup.php" | sha384sum -c - \
 && php82 composer-setup.php \
 && php82 -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer.phar \
 && ln -sf /usr/local/bin/composer.phar /usr/local/bin/composer

COPY docker/crontab /etc/crontabs/crontab
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf 
COPY docker/logrotate/. /etc/logrotate.d/
COPY docker/start.sh /start.sh

RUN cp /usr/share/zoneinfo/Asia/Tehran /etc/localtime \
    && chmod 555 /start.sh \
    && chmod 644 /etc/logrotate.d/* \
    && ln -sf /usr/bin/php82 /usr/bin/php \
    && sed -i 's/^variables_order =.*/variables_order = EGPCS/' /etc/php82/php.ini

WORKDIR /var/www/html

COPY composer.* ./

RUN composer install --no-dev --no-cache --optimize-autoloader --no-scripts --no-ansi

COPY . .

RUN chown nobody:nobody /var/www/html \
    && chown -R nobody:nobody /var/www/html/bootstrap /var/www/html/storage /var/lib /run /nobody

ARG RELEASE_VERSION
ENV RELEASE_VERSION=$RELEASE_VERSION

CMD /start.sh
