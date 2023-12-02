FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    zlib1g-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli

RUN pecl install redis \
    && docker-php-ext-enable redis

CMD ["php-fpm"]
