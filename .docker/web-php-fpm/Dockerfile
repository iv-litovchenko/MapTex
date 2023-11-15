FROM cyberduck/php-fpm-laravel:8.1
WORKDIR /var/www/html

ADD .docker/web-php-fpm/php.ini /usr/local/etc/php.ini
# ADD opcache.ini /usr/local/etc/php/conf.d/opcache.ini
# ADD upervisord.conf:/etc/supervisor/conf.d/supervisord.conf

# Install node, gulp, bower
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get --yes --force-yes install nodejs

# RUN npm install --global electron-forge
# RUN npm install --global gulp
# RUN npm install --global grunt
# RUN npm install --global bower
# RUN npm install --global less
# RUN npm install --global sass

# Установка прав доступа (linux ubuntu)
# su -l www-data -s /bin/bash
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www
WORKDIR /var/www/html