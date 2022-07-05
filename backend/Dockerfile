FROM php:8.1-fpm-alpine

RUN apk update --no-cache \
    && apk add --no-cache \
        autoconf \
        bash \
        dcron \
        g++ \
        git \
        icu-dev \
        libxml2-dev \
        make \
        nano \
        openssh-client \
        libzip-dev \
        postgresql-dev \
        postgresql-client \
        libpng-dev \
        mpdecimal \
        mpdecimal-dev \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        intl \
        gd \
        zip \
        opcache \
        pdo \
        pdo_pgsql \
        pgsql \
    && pecl install decimal \
    && echo "extension=decimal.so" `php-config --ini-dir`/decimal.ini \
    && docker-php-ext-enable decimal \
    && mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini \
    && rm /usr/local/etc/php-fpm.d/zz-docker.conf

RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www/backend

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

ENV COMPOSER_MEMORY_LIMIT -1

RUN composer install --no-autoloader

COPY . .

COPY ./docker/php-fpm-www-pool.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/docker-cron-entrypoint /usr/local/bin/docker-cron-entrypoint

RUN composer dump-autoload --optimize --classmap-authoritative

# Make binaries from composer packages
# available without path prefixes
#ENV PATH ./vendor/bin:$PATH
