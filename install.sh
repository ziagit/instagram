#!/bin/bash

# Install packages
npm install;
composer install;

#Make .env file and add absolute database path
mv .env.example .env;
echo "DB_DATABASE=\"$(pwd)/database/photoify.db\"" >> .env;

#Generate app key
php artisan key:generate;

#Build development
npm run dev;
