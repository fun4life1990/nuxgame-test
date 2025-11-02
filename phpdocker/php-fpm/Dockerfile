FROM php:8.4-fpm-alpine
WORKDIR "/application"

RUN apk update && apk add --no-cache \
    git \
    postgresql-dev \
#    php84-pgsql \
    php84-pecl-xdebug

RUN docker-php-ext-install pdo pdo_pgsql

RUN { \
        echo 'zend_extension=/usr/lib/php84/modules/xdebug.so'; \
        echo '[xdebug]'; \
        echo 'xdebug.mode=debug'; \
        echo 'xdebug.start_with_request=yes'; \
#        echo 'xdebug.log=/tmp/xdebug.log'; \
    } > /usr/local/etc/php/conf.d/99-xdebug.ini

EXPOSE 9000
