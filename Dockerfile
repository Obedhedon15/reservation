FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    opcache

# Installation de Redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installation de Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Dossier de travail
WORKDIR /app

# Copie des fichiers de dépendances (optimisation du cache Docker)
COPY composer.json composer.lock ./
RUN composer install \
    --optimize-autoloader \
    --no-scripts \
    --no-interaction \
    --no-dev

COPY package.json package-lock.json* ./
RUN npm install --ignore-scripts

# Copie du reste de l'application
COPY . .

# Build des assets (Vite)
RUN npm run build

# Finalisation de Composer
RUN composer dump-autoload --optimize --no-scripts

# Permissions CRUCIALES : On met 775 et on donne à www-data
RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/testing \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /app

# Nettoyage des caches Laravel pour forcer la lecture des variables Railway
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan event:clear

# Configuration de PHP-FPM (Socket Unix)
RUN sed -i 's|listen = 127.0.0.1:9000|listen = /run/php/php8.2-fpm.sock|' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|;listen.owner = www-data|listen.owner = www-data|' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|;listen.group = www-data|listen.group = www-data|' /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /run/php

# On vide COMPLÈTEMENT le dossier des sites activés pour éviter les conflits
RUN rm -rf /etc/nginx/sites-enabled/*

# On copie ta config personnalisée
COPY docker/nginx.conf /etc/nginx/sites-enabled/app.conf
# -------------------------

# Configuration Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]