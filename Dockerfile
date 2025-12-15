# Dockerfile
FROM php:8.3-fpm

# Instalar extensiones de PHP necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    libonig-dev \
    --no-install-recommends \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo (working directory)
WORKDIR /var/www/html

# Exponer el puerto 9000 (usado por PHP-FPM)
EXPOSE 9000
