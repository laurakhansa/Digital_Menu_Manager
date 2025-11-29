FROM php:8.2-fpm
WORKDIR /var/www/html
COPY . .
# Tambahkan command instalasi PHP extension jika perlu
RUN docker-php-ext-install mysqli pdo pdo_mysql
CMD ["php-fpm"]
