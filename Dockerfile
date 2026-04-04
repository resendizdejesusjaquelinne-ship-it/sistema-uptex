FROM php:8.4-apache

RUN apt-get update && apt-get install -y libpq-dev git unzip && docker-php-ext-install pdo pdo_pgsql
RUN a2enmod rewrite

COPY . /var/www/html

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage

# COMANDO CRÍTICO: Crea la tabla de sesiones y migra TODO de un golpe
CMD php artisan session:table || true && php artisan migrate --force && php artisan config:clear && php artisan cache:clear && apache2-foreground