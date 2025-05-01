FROM php:8.3-fpm

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libicu-dev \
    libpng-dev \
    libonig-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Configura a extensão GD com suporte a freetype e jpeg
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Instala as extensões PHP necessárias
RUN docker-php-ext-install pdo_pgsql mbstring zip exif pcntl bcmath gettext intl gd

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cria um usuário para rodar o Laravel
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Copia os arquivos do projeto e define permissões
COPY --chown=www:www . /var/www/html

# Define o usuário padrão do container
USER www

# Expõe a porta usada pelo PHP-FPM para comunicação com o servidor web (Nginx)
EXPOSE 9000

# Comando padrão do container
CMD ["php-fpm"]
