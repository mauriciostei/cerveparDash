# Usar imagen base de PHP
FROM php:8.1-fpm

# Instalar extensiones y dependencias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql