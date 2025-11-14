FROM alpine:3.22

LABEL maintainer="erfantkerfan"

RUN mkdir -p /nobody /var/log/php

RUN apk update \
    && apk add --no-cache \
    php84 \
    php84-bcmath \
    php84-ctype \
    php84-curl \
    php84-json \
    php84-mbstring \
    php84-fileinfo \
    php84-tokenizer \
    php84-dom \
    php84-iconv \
    php84-openssl \
    php84-pdo_mysql \
    php84-xml \
    php84-simplexml \
    php84-xmlreader \
    php84-xmlwriter \
    php84-zip \
    php84-soap \
    php84-gd \
    php84-phar \
    php84-pcntl \
    php84-posix \
    php84-pecl-redis \
    php84-pecl-imagick \
    php84-pecl-swoole \
    coreutils \
    nginx \
    curl \
    tzdata \
    logrotate \
    supervisor \
    supercronic \
    mysql-client \
    mariadb-connector-c

RUN php84 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && echo "$(curl 'https://composer.github.io/installer.sig')  composer-setup.php" | sha384sum -c - \
 && php84 composer-setup.php \
 && php84 -r "unlink('composer-setup.php');" \
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
    && ln -sf /usr/bin/php84 /usr/bin/php \
    && sed -i 's/^variables_order =.*/variables_order = EGPCS/' /etc/php84/php.ini

WORKDIR /var/www/html

COPY composer.* ./

RUN composer install --no-dev --no-cache --optimize-autoloader --no-scripts --no-ansi

COPY . .

RUN chown nobody:nobody /var/www/html \
    && chown -R nobody:nobody /var/www/html/bootstrap /var/www/html/storage /var/lib /run /nobody

ARG RELEASE_VERSION
ENV RELEASE_VERSION=$RELEASE_VERSION

CMD /start.sh
