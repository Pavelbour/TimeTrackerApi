FROM php:8.1.9-fpm
ARG uid
ARG user
RUN apt-get update && apt-get install -y \
    git \
    curl \
    cron \
    zip \
    unzip \
    libpq5 \
    libpq-dev
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install sockets
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
USER $user