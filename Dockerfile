# Imagen base de PHP con extensiones necesarias para PostgreSQL
FROM php:8.2-cli

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos de Laravel
COPY . .

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Cache de configuración de Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Ejecutar migraciones y seeders en cada build (seguro y sin duplicar)
RUN php artisan migrate --force && \
    php artisan db:seed --class=CatalogosSeeder --force

# Exponer el puerto de Laravel
EXPOSE 10000

# Comando para iniciar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
