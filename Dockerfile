FROM php:8.4-apache

# 1. Instalar dependencias y drivers
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Habilitar el módulo de rutas (Reescritura)
RUN a2enmod rewrite

# 3. Copiar archivos del proyecto
COPY . /var/www/html

# 4. CONFIGURACIÓN CRÍTICA: Apuntar Apache a la carpeta /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 6. Permisos de carpetas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage

# 7. Comando de arranque (Migrar y encender)
CMD php artisan migrate --force && php artisan config:clear && php artisan cache:clear && apache2-foreground