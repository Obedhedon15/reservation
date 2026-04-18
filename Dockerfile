FROM php:8.2-fpm

# 1. Installation des dépendances système
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

# 2. Installation des extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip opcache

# 3. Installation de Redis
RUN pecl install redis && docker-php-ext-enable redis

# 4. Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Installation de Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 6. Dossier de travail
WORKDIR /app

# 7. Dépendances (Cache Optimisé)
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-dev

COPY package.json package-lock.json* ./
RUN npm install --ignore-scripts

# 8. Copie du projet et Build
COPY . .
RUN npm run build
RUN composer dump-autoload --optimize --no-scripts

# 9. Permissions
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /app

# 10. Nettoyage Laravel
RUN php artisan config:clear || true && php artisan route:clear || true && php artisan view:clear || true && php artisan event:clear || true

# 11. Configuration PHP-FPM (On s'assure qu'il écoute sur le port 9000)
RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf || true

# 12. Configuration NGINX
RUN rm -rf /etc/nginx/sites-enabled/* && \
    echo "" > /etc/nginx/sites-available/default && \
    ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default
COPY docker/nginx.conf /etc/nginx/sites-enabled/app.conf

# 13. Configuration SUPERVISOR
RUN mkdir -p /etc/supervisor/conf.d
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]