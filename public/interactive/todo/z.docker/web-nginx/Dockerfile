FROM nginx:1.22

# Установка прав доступа (linux ubuntu)
# su -l www-data -s /bin/bash
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
WORKDIR /var/www/html