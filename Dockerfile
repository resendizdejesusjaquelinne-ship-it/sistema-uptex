FROM php:8.4-apache

# 1. Instalar solo lo esencial
RUN apt-get update && apt-get install -y libpq-dev git unzip \
    && docker-php-ext-install pdo pdo_pgsql

RUN a2enmod rewrite
COPY . /var/www/html

# 2. Configurar Apache a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# 3. Instalar solo PHP (Sin NPM para que no dé error)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 4. Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage

CMD php artisan migrate --force && php artisan config:cache && php artisan view:clear && apache2-foreground