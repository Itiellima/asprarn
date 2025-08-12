# Etapa 1: Construção do frontend com Node.js
FROM node:18 AS frontend

WORKDIR /app
COPY package.json package-lock.json /app/
RUN npm install
COPY . /app/
RUN npm run build

# Etapa 2: Configuração do ambiente PHP com Laravel
FROM php:8.2-fpm AS backend

# Instalação de dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Instalação do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www/
RUN composer install --no-dev --optimize-autoloader

# Copiar os assets compilados do frontend
COPY --from=frontend /app/public /var/www/public

# Definir permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
