git clone https://github.com/iv-litovchenko/maptex.git

cd maptex
cp .env.example .env

docker-compose -f ./docker-compose.yml up -d --build
docker-compose -f ./docker-compose-gui.yml up -d --build

-----------------
- PHP
-----------------

docker exec -it maptex-web-php-fpm bash
su -l www-data -s /bin/bash 
cd /var/www/html

composer install
php artisan storage:link
php artisan key:generate
php artisan migrate:auto
php artisan db:seed

# php artisan tinker
# DB::connection()->getDatabaseName();
# exit

-----------------
- NODE
-----------------

docker exec -it maptex-web-node bash
su -l node -s /bin/bash 
cd /var/www/html

npm install
npm run dev
