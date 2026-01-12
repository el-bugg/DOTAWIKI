# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Install dependency sistem yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Bersihkan cache apt agar image tidak bengkak
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang wajib untuk Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Aktifkan mod_rewrite Apache (wajib untuk URL Laravel)
RUN a2enmod rewrite

# Ubah document root Apache dari /html ke /html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \ /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Copy semua file project ke dalam container
COPY . .

# Install dependency Laravel via Composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Ubah hak akses folder storage dan bootstrap cache agar bisa ditulis
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache