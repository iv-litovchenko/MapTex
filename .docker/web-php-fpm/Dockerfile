FROM cyberduck/php-fpm-laravel:8.1
WORKDIR /var/www

# RUN docker-php-ext-install opcache
# ADD .docker/web-php-fpm/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
# ADD .docker/web-php-fpm/php.ini /usr/local/etc/php/php.ini
# ADD .docker/web-php-fpm/supervisord.conf:/etc/supervisor/conf.d/supervisord.conf
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка прав доступа (linux ubuntu)
# su -l www-data -s /bin/bash
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
# RUN chown -R www-data:www-data /var/www
