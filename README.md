<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Attention!

Follow the steps to set the application on your local machine.

Step N°1 - Run the following commands below to install the dependencies (Check the existence of `Composer`, `Node` and `NPM` on your machine).

```
composer install 
cp .env.example .env 
php artisan cache:clear 
composer dump-autoload 
php artisan key:generate
```

Step N°2 - In `.env` file set the following snippet to connect the application to your database (In this case, the PostgreSQL).
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rest-api-practical-test
DB_USERNAME=postgres
DB_PASSWORD=
```

Step N°3 - Execute the migrations.

```
php artisan migrate
```

Step N°4 - Use the commands to perfomate the Seeders.

```
php artisan db:seed
```

If you want perfomate migrations and seeders at same time.
```
php artisan migrate --seed
```

Step N°5 - View the migrations status.
```
php artisan migrate:status
```

Step N°8 - Run the following command to start Apache to run the application.
```
php artisan serve
```
## Files of importancy
- [Places (migration)](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/migrations/2025_04_09_170109_create_places_table.php)
- [PlaceSeeder](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/PlaceSeeder.php)
    - [DatabaseSeeder](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/DatabaseSeeder.php)
- [api.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/routes/api.php)
- [PlaceModel.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Models/PlaceModel.php)
- [PlaceController.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Http/Controllers/Api/PlaceController.php)

## REST API endpoints

If you have followed the instructions above, you need use some API platform to perfomate the endpoints, you can use [POSTMAN](https://www.postman.com/) for example.

**GET: localhost:8000/api/place**
```
// Response - Status: 200 OK
[
    {
        "id": 1,
        "name": "Safe Room",
        "slug": "safe-room",
        "state": "Capcom",
        "city": "Raccoon City",
        "created_at": "10-04-2025 08:33:00",
        "updated_at": "10-04-2025 08:33:00"
    },
    {
        "id": 2,
        "name": "Observation Deck",
        "slug": "observation-deck",
        "state": "Konami",
        "city": "Silent Hill",
        "created_at": "10-04-2025 08:33:00",
        "updated_at": "10-04-2025 08:33:00"
    },
    {
        "id": 3,
        "name": "Monarch Theatre",
        "slug": "monarch-theatre",
        "state": "DC Comics",
        "city": "Gotham City",
        "created_at": "10-04-2025 08:33:00",
        "updated_at": "10-04-2025 08:33:00"
    },
    {
        "id": 4,
        "name": "The West Side",
        "slug": "the-west-side",
        "state": "Capcom",
        "city": "Metro City",
        "created_at": "10-04-2025 08:33:00",
        "updated_at": "10-04-2025 08:33:00"
    }
]
```

Case you don't run the seeders the endpoint response will be:
```
// Response - Status: 404 Not Found
{
    "message": "No places found."
}
```

**POST: localhost:8000/api/place**
```
// JSON Content
{
    "name": "Gold Saucer",
    "city": "Final Fantasy VII",
    "state": "Square Enix"
}

// Response - Status: 201 Created
{
    "id": 5,
    "name": "Gold Saucer",
    "slug": "gold-saucer",
    "city": "Final Fantasy VII",
    "state": "Square Enix",
    "created_at": "10-04-2025 08:36:02",
    "updated_at": "10-04-2025 08:36:02"
}
```

**GET: localhost:8000/api/place/id**
- You need change **id** for **5** (If you don't run the seeder, use **1**)
```
// Response - Status: 200 OK
{
    "id": 5,
    "name": "Gold Saucer",
    "slug": "gold-saucer",
    "city": "Final Fantasy VII",
    "state": "Square Enix",
    "created_at": "10-04-2025 08:36:02",
    "updated_at": "10-04-2025 08:36:02"
}
```

**GET: localhost:8000/api/place-search?name=**
- You need change **name=** for **name=Gold**
```
// Response - Status: 200 OK
[
    {
        "id": 5,
        "name": "Gold Saucer",
        "slug": "gold-saucer",
        "city": "Final Fantasy VII",
        "state": "Square Enix",
        "created_at": "10-04-2025 08:36:02",
        "updated_at": "10-04-2025 08:36:02"
    }
]
```

**PUT: localhost:8000/api/place/id**
- You need change **id** for **5** (If you don't run the seeder, use **1**)
```
// JSON Content
{
    "name": "Gold Saucer",
    "city": "Final Fantasy VII Rebirth", // CHanging Final Fantasy VII to Final Fantasy VII Rebirth
    "state": "Square Enix"
}

// Response - Status: 200 OK
{
    "id": 5,
    "name": "Gold Saucer",
    "slug": "gold-saucer",
    "city": "Final Fantasy VII Rebirth",
    "state": "Square Enix",
    "created_at": "10-04-2025 08:36:02",
    "updated_at": "10-04-2025 08:38:07"
}
```

**DELETE: localhost:8000/api/place/id**
- You need change **id** for **5** (If you don't run the seeder, use **1**)
```
// Response - Status: 200 OK
{
    "message": "Gold Saucer is deleted."
}
```
