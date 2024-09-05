`composer install`


configure move `.env.example` to `.env` and configure singlestore variables

```dotenv
DB_CONNECTION=singlestore
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

run migrations `php artisan migrate`

run `php artisan app:seed-events` - Run multiple processes until you have 2m+ records

run the script that demonstrates the slow queries:
`php app/script.php`




Running concurrently just hits the database hard, it doesn't lock like I initially thought:
`php artisan queue:work & php artisan queue:work & php artisan queue:work & php artisan queue:work & php artisan queue:work & php artisan queue:work & php artisan app:dispatch-jobs`

