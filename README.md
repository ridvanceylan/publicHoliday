
## FE
npm install
npm run dev
----------------------------------------------------

## BE
.env.example dosyasını .env çevirip db connection aşağıdaki gibi olmalı.
DB_CONNECTION=sqlite
DB_DATABASE=/Users/ridvanceylan/Downloads/publicHoliday-main/laravel (full path)


composer install
php artisan migrate:reset
php artisan migrate
php artisan config:cache

php artisan serve

------------------------------------------------

500 hatası alırsak 

php artisan key:generate

php artisan config:cache

