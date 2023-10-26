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

# php artisan down;

git pull origin master

