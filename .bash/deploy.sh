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

id;
pwd;

php artisan down;

git pull origin master;

composer install;
composer dump-autoload;

# npm install;
# npm run production;

# php artisan migrate:auto --force
php artisan cache:clear;
php artisan auth:clear-resets;
php artisan route:clear;
php artisan route:cache;
php artisan config:clear;
php artisan config:cache;
php artisan view:clear;
php artisan view:cache;
php artisan optimize;
php artisan up

echo "End deployment [sh]!"
