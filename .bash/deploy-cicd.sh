echo "Start deployment [sh]!"

#sudo /usr/bin/supervisorctl reread
#sudo /usr/bin/supervisorctl update
#sudo /usr/bin/supervisorctl stop laravel-worker:*
#sudo /usr/bin/rm -f {{ project }}storage/logs/worker.log
#sudo /usr/bin/supervisorctl start laravel-worker:*
#sudo /usr/bin/supervisorctl status laravel-worker:*
#sudo /usr/bin/supervisorctl reread
#sudo /usr/bin/supervisorctl update
#sudo /usr/bin/supervisorctl stop laravel-worker:*

php artisan down

#git pull origin master
git --git-dir=../.git --work-tree=../ pull origin master

# composer install
# composer dump-autoload

# npm install
# npm run production

php artisan migrate:auto --force
php artisan cache:clear
php artisan auth:clear-resets
php artisan route:clear
php artisan route:cache
php artisan config:clear
php artisan config:cache
php artisan view:clear
php artisan view:cache
php artisan optimize
php artisan up

echo "End deployment [sh]!"
