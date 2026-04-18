FROM php:8.2-fpm

# Install system dependencies
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

# Install PHP extensions
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

# Install Redis extension via PECL
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /app

# Copy composer files first for layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no scripts to avoid artisan calls without .env)
RUN composer install \
    --optimize-autoloader \
    --no-scripts \
    --no-interaction \
    --no-dev

# Copy package files for layer caching
COPY package.json package-lock.json* ./

# Install Node dependencies and build assets
RUN npm install --ignore-scripts
COPY vite.config.js ./
COPY resources/ ./resources/
RUN npm run build

# Copy the rest of the application
COPY . .

# Re-run composer to trigger post-autoload-dump scripts now that full app is present
RUN composer dump-autoload --optimize --no-scripts

# Create required storage directories and set permissions
RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/testing \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Nettoyage complet : on ne met RIEN en cache pendant le build pour éviter les crashs
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan event:clear


# Configure PHP-FPM to listen on a Unix socket
RUN sed -i 's|listen = 127.0.0.1:9000|listen = /run/php/php8.2-fpm.sock|' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|;listen.owner = www-data|listen.owner = www-data|' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|;listen.group = www-data|listen.group = www-data|' /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /run/php

# Nginx configuration
RUN rm -f /etc/nginx/sites-enabled/default

# AJOUTE CETTE LIGNE ICI POUR CASSER LE CACHE :
RUN echo "Update Bopeto Services $(date)" > /var/www/html/index.html

COPY docker/nginx.conf /etc/nginx/sites-enabled/app.conf




# Supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Force la génération de la clé et les migrations si nécessaire
RUN php artisan key:generate --force

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]  
