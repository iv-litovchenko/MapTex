# https://github.com/veevidify/laravel-apache-docker
FROM php:8.1-apache

# Установка программ и утилит
RUN apt-get update && apt-get install -y \
    sudo \
    curl \
    wget \
    g++ \
    git \
    nodejs \
    npm \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    unzip \
    zlib1g-dev \
    libzip-dev \
    zip \
 && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN curl -sL https://deb.nodesource.com/setup_16.x | sudo bash -
# RUN apt-get install -y nodejs

# Install gulp & bower
# RUN npm install --global gulp
# RUN npm install --global grunt
# RUN npm install --global bower

# Устанавливаем путь к обработке папки "public"
RUN echo "ServerName laravel-app.local" >> /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite headers
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# ARG uid
# RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
# RUN mkdir -p /home/devuser/.composer && \
#    chown -R devuser:devuser /home/devuser
