FROM php:8.2-apache

# 1. Instalar dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    && docker-php-ext-install intl pdo_mysql zip gd \
    && a2enmod rewrite

# 2. Configurar o DocumentRoot para a pasta public do CodeIgniter
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Copiar o código do projeto
WORKDIR /var/www/html
COPY . .

# 4. Instalar Composer e dependências
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5. Permissões para pastas de escrita
RUN chown -rwX writable /var/www/html/writable

EXPOSE 80
CMD ["apache2-foreground"]
