FROM php:8.1-fpm

# RUN docker-php-ext-install opcache
# ADD .docker/web-php-fpm/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
# ADD .docker/web-php-fpm/php.ini /usr/local/etc/php/php.ini
# ADD .docker/web-php-fpm/supervisord.conf:/etc/supervisor/conf.d/supervisord.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем стадии
USER root
ARG user=appuser
ARG group=appuser
ARG uid=1000
ARG gid=1000
RUN groupadd -g ${gid} ${group}
RUN useradd -u ${uid} -g ${group} -s /bin/sh -m ${user} # <--- the '-m' create a user home directory

WORKDIR /var/www/html
RUN chown ${group}:${user} -R .
RUN chmod -R 777 .
# USER ${uid}:${gid}
