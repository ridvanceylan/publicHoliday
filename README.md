
## FE
npm install
npm run dev
----------------------------------------------------

## BE
.env.example dosyasını .env çevirip db connection aşağıdaki gibi olmalı.
DB_CONNECTION=sqlite

composer install
php artisan migrate

php artisan serve

------------------------------------------------

500 hatası alırsak 

php artisan key:generate

php artisan config:cache

