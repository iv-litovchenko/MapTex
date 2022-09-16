git clone https://github.com/iv-litovchenko/maptex.git
cd maptex
cp .env.example .env
docker-compose -f ./docker-compose.yml up -d --build
docker-compose -f ./docker-compose-database.yml up -d --build

docker exec -it php-apache-81 bash
composer install
npm install
npm run dev
php artisan storage:link
php artisan key:generate
php artisan migrate:auto
php artisan db:seed

# php artisan tinker
# DB::connection()->getDatabaseName();
# exit
