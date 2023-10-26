echo "Start deployment [sh]!";
##!/usr/bin/env bash
#set -x
#cd /home/forge/domain.com
#cd $FORGE_SITE_PATH

#sudo /usr/bin/supervisorctl reread
#sudo /usr/bin/supervisorctl update
#sudo /usr/bin/supervisorctl stop laravel-worker:*
#sudo /usr/bin/rm -f {{ project }}storage/logs/worker.log
#sudo /usr/bin/supervisorctl start laravel-worker:*
#sudo /usr/bin/supervisorctl status laravel-worker:*
#sudo /usr/bin/supervisorctl reread
#sudo /usr/bin/supervisorctl update
#sudo /usr/bin/supervisorctl stop laravel-worker:*

# docker exec -w /var/www/html -it maptex-web-php-fpm php artisan down

pwd
git pull origin master

docker exec -w /var/www/html -it maptex-web-php-fpm composer install
docker exec -w /var/www/html -it maptex-web-php-fpm composer dump-autoload

docker exec -w /var/www/html -it maptex-web-node npm install
docker exec -w /var/www/html -it maptex-web-node npm run production

# docker exec -w /var/www/html -it maptex-web-php-fpm php artisan migrate:auto --force
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan cache:clear
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan auth:clear-resets
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan route:clear
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan route:cache
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan config:clear
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan config:cache
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan view:clear
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan view:cache
docker exec -w /var/www/html -it maptex-web-php-fpm php artisan optimize

# docker exec -w /var/www/html -it maptex-web-php-fpm php artisan up

echo "End deployment [sh]!";
