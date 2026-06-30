FROM php:8.2-cli

# Instalasi dependensi sistem untuk SQLite, INTL, dan ZIP
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip \
    curl \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_sqlite intl zip

# Instalasi Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setel direktori kerja
WORKDIR /app

# Salin seluruh kode aplikasi
COPY . .

# Eksekusi dependensi Laravel
RUN composer install --optimize-autoloader --no-dev

# Siapkan database SQLite
RUN touch database/database.sqlite
RUN php artisan migrate --force

# Buka akses port dan jalankan server bawaan Laravel
EXPOSE 10000
CMD php artisan serve --host=0.0.0.0 --port=10000