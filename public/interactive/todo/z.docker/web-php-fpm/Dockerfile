FROM cyberduck/php-fpm-laravel:5.6

# RUN rm /usr/local/etc/php/conf.d/laravel.ini
# COPY .docker/web-php-fpm/php.ini /usr/local/etc/php/php.ini
# COPY .docker/web-php-fpm/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
# COPY .docker/web-php-fpm/upervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN echo "deb http://archive.debian.org/debian stretch main" > /etc/apt/sources.list
RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get -y install certbot
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install apcu-4.0.11
RUN docker-php-ext-enable apcu

# Install node, gulp, bower
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get --yes --force-yes install nodejs

# RUN npm install --global electron-forge
RUN npm install --global gulp
RUN npm install --global grunt
RUN npm install --global bower
RUN npm install --global less@4.2.0
RUN npm install --global sass
RUN npm install --global yuicompressor

# Установка прав доступа (linux ubuntu)
# su -l www-data -s /bin/bash
# RUN usermod -u 1000 www-data
# RUN groupmod -g 1000 www-data
# RUN chown -R www-data:www-data /var/www

WORKDIR /var/www/html
