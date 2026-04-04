FROM php:8.4-apache

# Instalar dependencias del sistema, git, unzip y el driver de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Copiar el proyecto
COPY . /var/www/html

# Configurar el directorio raíz de Apache para Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ejecutar la instalación ignorando los chequeos de plataforma para evitar conflictos de versión
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Comando de arranque
CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && apache2-foreground