<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Attention!

Follow the steps to set the application in your local machine.

Step N°1 - Run the following commands below to install the dependencies (Check the existence of `Composer`, `Node` and `NPM` in your machine).

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
DB_DATABASE=database_name
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

## REST API endpoints

If you have followed the instructions above, you need use some API platform to perfomate the endpoints, you can use [POSTMAN](https://www.postman.com/) for example.

**GET: localhost:8000/api/place**
```
// Response - Status: 200 OK
[
    {
        "id": 1,
        "name": "Jill Valentine",
        "slug": "jill-valentine",
        "state": "Capcom",
        "city": "Raccoon City",
        "created_at": null,
        "updated_at": null
    },
    {
        "id": 2,
        "name": "James Sunderland",
        "slug": "james-sunderland",
        "state": "Konami",
        "city": "Silent Hill",
        "created_at": null,
        "updated_at": null
    },
    {
        "id": 3,
        "name": "Bruce Wayne",
        "slug": "bruce-wayne",
        "state": "DC Comics",
        "city": "Gotham City",
        "created_at": null,
        "updated_at": null
    },
    {
        "id": 4,
        "name": "Terry Bogard",
        "slug": "terry-bogard",
        "state": "SNK",
        "city": "Metro City",
        "created_at": null,
        "updated_at": null
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
    "name": "Sonic Hedgehog",
    "city": "Green Hill",
    "state": "SEGA"
}

// Response - Status: 201 Created
{
    "id": 5,
    "name": "Sonic Hedgehog",
    "slug": "sonic-hedgehog",
    "city": "Green Hill",
    "state": "SEGA",
    "updated_at": "2025-04-09T22:09:51.000000Z",
    "created_at": "2025-04-09T22:09:51.000000Z",
}
```

**GET: localhost:8000/api/place/id**
- You need change **id** for **5** (If you don't run the seeder, use **1**)
```
// Response - Status: 200 OK
{
    "id": 5,
    "name": "Sonic Hedgehog",
    "slug": "sonic-hedgehog",
    "city": "Green Hill",
    "state": "SEGA",
    "updated_at": "2025-04-09T22:09:51.000000Z",
    "created_at": "2025-04-09T22:09:51.000000Z",
}
```

**GET: localhost:8000/api/place-search?name=**
- You need change **name=** for **name=Sonic**
```
// Response - Status: 200 OK
[
    {
        "id": 5,
        "name": "Sonic Hedgehog",
        "slug": "sonic-hedgehog",
        "city": "Green Hill",
        "state": "SEGA",
        "updated_at": "2025-04-09T22:09:51.000000Z",
        "created_at": "2025-04-09T22:09:51.000000Z",
    }
]
```

**PUT: localhost:8000/api/place/id**
- You need change **id** for **5** (If you don't run the seeder, use **1**)
```
// JSON Content
{
    "name": "Sonic Hedgehog",
    "city": "Green Hill Zone", // Changing Green Hill to Green Hill Zone
    "state": "SEGA"
}

// Response - Status: 200 OK
{
    "id": 5,
    "name": "Sonic Hedgehog",
    "slug": "sonic-hedgehog",
    "state": "SEGA",
    "city": "Green Hill Zone",
    "created_at": "2025-04-09T22:09:51.000000Z",
    "updated_at": "2025-04-09T22:25:17.000000
}
```

**DELETE: localhost:8000/api/place/id**
- You need change **id** for **5** (If you don't run the seeder, use **1**)
```
// Response - Status: 200 OK
{
    "message": "Green Hill Zone was deleted."
}
```
