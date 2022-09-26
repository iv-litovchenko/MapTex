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

$PHP_PATH artisan down
#git reset --hard
#git clean -df
git pull origin $BRANCH
#composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
#composer dump-autoload
#npm ci
#npm install
#npm run production
$PHP_PATH artisan migrate:auto --force
$PHP_PATH artisan cache:clear
$PHP_PATH artisan auth:clear-resets
$PHP_PATH artisan route:clear
$PHP_PATH artisan route:cache
$PHP_PATH artisan config:clear
$PHP_PATH artisan config:cache
$PHP_PATH artisan view:clear
$PHP_PATH artisan view:cache
# php artisan optimize
$PHP_PATH artisan up
echo "End deployment [sh]!";
