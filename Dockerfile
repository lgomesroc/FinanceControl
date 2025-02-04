# Usar a imagem oficial do PHP com FPM (FastCGI Process Manager)
FROM php:8.3-fpm

# Instalar dependências do sistema, como bibliotecas para o Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && apt-get clean

# Instalar o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho no container
WORKDIR /var/www/backend

<<<<<<< HEAD
# Copiar o arquivo composer.json para instalar as dependências
=======
# Copiar os arquivos composer.json e instalar as dependências
>>>>>>> origin/develop
COPY backend/composer.json ./

# Instalar as dependências do Laravel
RUN composer install --no-scripts --no-autoloader

# Copiar o código da aplicação para dentro do container
COPY backend/ /var/www/backend/

# Ajustar permissões dos diretórios de armazenamento e cache
RUN chown -R www-data:www-data /var/www/backend/storage /var/www/backend/bootstrap/cache \
    && chmod -R 775 /var/www/backend/storage /var/www/backend/bootstrap/cache

# Gerar o autoloader otimizado do Composer
RUN composer dump-autoload --optimize

# Expor a porta 9000, que será usada pelo PHP-FPM
EXPOSE 9000

# Rodar o servidor PHP-FPM
CMD ["php-fpm"]
