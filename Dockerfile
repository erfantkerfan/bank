FROM alpine:3.24

LABEL maintainer="erfantkerfan"

RUN mkdir -p /nobody /var/log/php

RUN apk update \
    && apk add --no-cache \
    php85 \
    php85-bcmath \
    php85-ctype \
    php85-curl \
    php85-json \
    php85-mbstring \
    php85-fileinfo \
    php85-tokenizer \
    php85-dom \
    php85-iconv \
    php85-openssl \
    php85-pdo_mysql \
    php85-xml \
    php85-simplexml \
    php85-xmlreader \
    php85-xmlwriter \
    php85-zip \
    php85-soap \
    php85-gd \
    php85-phar \
    php85-pcntl \
    php85-posix \
    php85-pecl-redis \
    php85-pecl-imagick \
    php85-pecl-swoole \
    coreutils \
    nginx \
    curl \
    tzdata \
    logrotate \
    supervisor \
    supercronic \
    mysql-client \
    mariadb-connector-c

RUN php85 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && echo "$(curl 'https://composer.github.io/installer.sig')  composer-setup.php" | sha384sum -c - \
 && php85 composer-setup.php \
 && php85 -r "unlink('composer-setup.php');" \
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
    && ln -sf /usr/bin/php85 /usr/bin/php \
    && sed -i 's/^variables_order =.*/variables_order = EGPCS/' /etc/php85/php.ini

WORKDIR /var/www/html

COPY composer.* ./

RUN composer install --no-dev --no-cache --optimize-autoloader --no-scripts --no-ansi

COPY . .

RUN chown nobody:nobody /var/www/html \
    && chown -R nobody:nobody /var/www/html/bootstrap /var/www/html/storage /var/lib /run /nobody

ARG RELEASE_VERSION
ENV RELEASE_VERSION=$RELEASE_VERSION

CMD /start.sh
