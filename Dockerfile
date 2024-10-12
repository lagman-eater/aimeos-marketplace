# Установка базового образа
FROM php:8.1-fpm

# Установка системных зависимостей и расширений
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Установка Composer
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# Копирование проекта в контейнер
COPY . /var/www/html

# Установка зависимостей Laravel
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Запуск Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
