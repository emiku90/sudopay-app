FROM php:8.5-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG UID=1000
ARG GID=1000

RUN groupadd --gid ${GID} app \
    && useradd --uid ${UID} --gid ${GID} -m app

WORKDIR /var/www/html

USER app