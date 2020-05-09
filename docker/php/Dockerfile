FROM php:7.3-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN set -e && \
  apk add --update-cache --no-cache tzdata npm && \
  apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev libzip-dev && \
  cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
  docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
  docker-php-ext-install pdo_mysql gd zip && \
  apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
