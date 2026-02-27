FROM php:8.3-cli
RUN apt-get update \
    && apt-get install -y libonig-dev libzip-dev unzip git \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && apt-get clean
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN mkdir -p writable/{session,logs,cache,debugbar} && \
    chmod -R 777 writable/
RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader
RUN chmod +x start.sh
EXPOSE \
CMD ["./start.sh"]
