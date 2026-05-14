FROM php:8.2-fpm-alpine

# Instalar dependências do sistema
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    postgresql-dev \
    libpng-dev \
    oniguruma-dev \
    libzip-dev \
    zip \
    curl

# Instalar extensões PHP necessárias
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    zip \
    gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Diretório de trabalho
WORKDIR /var/www/html

# Copiar ficheiros do projeto
COPY . .

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar dependências Node e compilar assets
RUN npm install && npm run build

# Permissões
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Configuração do Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Script de arranque
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

RUN php artisan config:clear

EXPOSE 8080


CMD ["/start.sh"]