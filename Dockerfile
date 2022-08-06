FROM alpine:3.15

LABEL maintainer="erfantkerfan"

RUN mkdir -p /nobody /var/log/php

RUN apk update \
    && apk add --no-cache \
    php81 \
    php81-bcmath \
    php81-ctype \
    php81-curl \
    php81-json \
    php81-mbstring \
    php81-fileinfo \
    php81-tokenizer \
    php81-dom \
    php81-iconv \
    php81-openssl \
    php81-pdo_mysql \
    php81-xml \
    php81-simplexml \
    php81-xmlreader \
    php81-xmlwriter \
    php81-zip \
    php81-soap \
    php81-gd \
    php81-phar \
    php81-pcntl \
    php81-posix \
    php81-pecl-redis \
    php81-pecl-imagick \
    php81-pecl-swoole \
    coreutils \
    nginx \
    curl \
    tzdata \
    logrotate \
    supervisor

ENV SUPERCRONIC_URL=https://github.com/aptible/supercronic/releases/download/v0.1.12/supercronic-linux-amd64 \
    SUPERCRONIC=supercronic-linux-amd64 \
    SUPERCRONIC_SHA1SUM=048b95b48b708983effb2e5c935a1ef8483d9e3e

RUN curl -fsSLO "$SUPERCRONIC_URL" \
    && echo "${SUPERCRONIC_SHA1SUM}  ${SUPERCRONIC}" | sha1sum -c - \
    && chmod +x "$SUPERCRONIC" \
    && mv "$SUPERCRONIC" "/usr/local/bin/${SUPERCRONIC}" \
    && ln -s "/usr/local/bin/${SUPERCRONIC}" /usr/local/bin/supercronic

RUN php81 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && echo "55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae  composer-setup.php" | sha384sum -c - \
    && php81 composer-setup.php \
    && php81 -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

COPY docker/crontab /etc/crontabs/crontab
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf 
COPY docker/logrotate/. /etc/logrotate.d/
COPY docker/start.sh /start.sh

RUN cp /usr/share/zoneinfo/Asia/Tehran /etc/localtime \
    && chmod 555 /start.sh \
    && chmod 644 /etc/logrotate.d/* \
    && ln -sf /usr/bin/php81 /usr/bin/php \
    && sed -i 's/^variables_order=.*/variables_order = EGPCS/' /etc/php81/php.ini

WORKDIR /var/www/html

COPY composer.* ./

# RUN composer install --no-dev --optimize-autoloader --no-scripts --no-ansi
RUN composer install --optimize-autoloader --no-scripts --no-ansi

COPY . .

RUN chown nobody:nobody /var/www/html \
    && chown -R nobody:nobody /var/www/html/bootstrap /var/www/html/storage /var/lib /run /nobody

CMD /start.sh
