#!/usr/bin/env bash
set -x

# Change to the project directory
cd $FORGE_SITE_PATH

# Turn on maintenance mode
php artisan down || true

# Pull the latest changes from the git repository
# git reset --hard
# git clean -df
git pull origin $FORGE_SITE_BRANCH

# Install/update composer dependecies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Restart FPM
( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

# Run database migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear

# Clear expired password reset tokens
php artisan auth:clear-resets

# Clear and cache routes
php artisan route:cache

# Clear and cache config
php artisan config:cache

# Clear and cache views
php artisan view:cache

# Install node modules
# npm ci

# Build assets using Laravel Mix
# npm run production

# Turn off maintenance mode
php artisan up









#!/usr/bin/env bash
set -x

### Based on https://gist.github.com/BenSampo/aa5f72584df79f679a7e603ace517c14

# Change to the project directory
#cd /home/forge/domain.com

# Turn on maintenance mode
#php artisan down

# Pull the latest changes from the git repository
git pull origin master

# Install/update composer dependecies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear

# Clear expired password reset tokens
php artisan auth:clear-resets

# Clear and cache routes
### Disabled because of closures in routes files
#php artisan route:clear
#php artisan route:cache

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Install node modules
npm install

# Build assets using Laravel Mix
# npm run production

# Install Bower Components
bower install

# Build assests with grunt

grunt concat sass copy babel

# Turn off maintenance mode
#php artisan up

echo "Don't forget to record the deployoment with New Relic"
