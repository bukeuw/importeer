FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzzip-dev \
    libbz2-dev \
    libcurl4 \
    libcurl4-openssl-dev \
    libpq-dev \
    libsodium-dev \
    libzip-dev \
    bzip2 \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
#RUN docker-php-ext-install pdo_mysql mbstring json exif pcntl bcmath gd zip iconv curl openssl
RUN docker-php-ext-install bcmath bz2 ctype curl dom exif fileinfo gd iconv intl json mbstring pcntl pdo pdo_mysql pdo_pgsql posix session sodium tokenizer xml zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# use the default production config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
#ADD ./config/php/additions.ini /usr/local/etc/php/conf.d/additions.ini

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
