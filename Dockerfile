FROM php:8.3-cli

# Instala dependências e extensões PHP
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && apt-get clean

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Cria as pastas necessárias e dá permissão total
RUN mkdir -p writable/session writable/logs writable/cache writable/debugbar && \
    chmod -R 777 writable/

# Instala dependências do PHP e otimiza o carregamento
RUN composer install --no-dev --no-interaction --optimize-autoloader
RUN composer dump-autoload --optimize

# Prepara o script de inicialização
RUN chmod +x start.sh

EXPOSE 8080

CMD ["./start.sh"]
