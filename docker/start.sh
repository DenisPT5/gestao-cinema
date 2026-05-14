#!/bin/sh

# Gerar APP_KEY se não existir
php artisan key:generate --force

# Limpar e otimizar caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Correr migrations automaticamente
php artisan migrate --force

# Iniciar PHP-FPM em background
php-fpm -D

# Iniciar Nginx em foreground
nginx -g "daemon off;"