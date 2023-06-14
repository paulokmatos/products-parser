# Use a imagem oficial do PHP 8.1 como base
FROM php:8.1

# Instale as dependências necessárias
RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    libssl-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    git \
    postgresql \
&& rm -rf /var/lib/apt/lists/*

#instala o Redis
RUN pecl install redis && docker-php-ext-enable redis

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install pdo_mysql pdo_pgsql zip bcmath

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho como o diretório do projeto Laravel
WORKDIR /var/www/html

# Copie os arquivos do projeto Laravel para o contêiner
COPY . .

# Instale as dependências do Composer
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Defina as permissões corretas para os arquivos do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 8000 para acesso HTTP
EXPOSE 8000

# Execute o servidor embutido do Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
