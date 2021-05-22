FROM composer
FROM php:8.0.6-cli

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /usr/src/app

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libicu-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-install intl
RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_HOME /var/composer
RUN mkdir /var/composer

RUN chmod -R ugo+rw /var/composer

CMD ["composer", "install"]
