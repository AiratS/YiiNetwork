FROM php:8.0.11-fpm-alpine3.14

ARG UID
ARG GID

RUN apk update && \
    apk add bash && \
    apk add git && \
    apk add icu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    set -ex && \
    apk --no-cache add postgresql-dev && \
    docker-php-ext-install pdo pdo_pgsql

RUN apk --update --no-cache add autoconf g++ make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN addgroup -g $GID app && \
    adduser -u $UID -G app -h /home/app -D app

USER app
CMD ["php-fpm"]