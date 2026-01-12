FROM php:8.2-apache

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

# --- PERBAIKAN DI SINI ---
# Saya MENGHAPUS flag "--no-dev" agar library Faker ikut terinstall
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs
# -------------------------

# 1. Buat file database kosong
RUN touch database/database.sqlite

# 2. Berikan izin penuh (777)
RUN chmod 777 database/database.sqlite
RUN chmod -R 777 storage bootstrap/cache database

# 3. Ubah kepemilikan
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Jalankan migrasi, isi data (seed), lalu nyalakan server
CMD bash -c "php artisan migrate --force && php artisan db:seed --force && apache2-foreground"