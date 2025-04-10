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

If you have followed the instructions above, you need use some API platform to perfomate the endpoints, you can use [POSTMAN](https://www.postman.com/) for example. It is necessary install Postman on your local machine to local tests.

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
    "city": "Final Fantasy VII Rebirth", // Final Fantasy VII to Final Fantasy VII Rebirth
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

## Environments Docker

1 - Install Docker on your machine. Please, check your operational systems the better way to install.

2 - I am using Sails to create ```docker-compose.yml```. 


Step N°1 - In ```docker-compose.yml``` i have done a little change.
```
12 | - '${APP_PORT:-8000}:80'
```

I have changed ``'${APP_PORT:-80}:80' (default value)`` to ``'${APP_PORT:-8000}:80'``. It will facilitate to avoid conflicts involving the host, you don't need configure the container. Like that, the Laravel will run without problems (Mainly the endpoints from REST API).

Step N°1 - In ```.env``` file set the following snippet to connect the application to database container from Docker.

```
# DB_CONNECTION=pgsql
# DB_HOST=pgsql
# DB_PORT=5432
# DB_DATABASE=rest-api-practical-test
# DB_USERNAME=postgres
# DB_PASSWORD=secret
```

3 - To use ```pgAdmin 4``` services from Docker, you can access:
```
http://localhost:5050
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/01.png)

Login:
```
email: admin@admin.com
password: admin
```

4 - Using the correct credentials, the dashboard is available.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/02.png)

5 - ```Servers -> Register -> Server```

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/03.png)

6 - About the ```Name``` field on ```General``` tab, you can choice whatever name (except ```localhost```), in my example I will use ```test-postgres```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/04.png)

7 - On ```Connection``` tab, you need set values on following fields
- Host name/address: ```pgsql```
- Port: ```5432```
- Maintenance database: ```postgres```
- Username: ```postgres```
- Password: ```secret```

Finally, ckick on ```Save``` button.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/05.png)

8 - The ```test-postgres``` server has been created.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/06.png)

9 - ```test-postgres -> Database -> rest-api-practical-test```

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/07.png)

10 - ```rest-api-practical-test -> Schemas -> public -> Tables -> places```

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/08.png)

11 - ```View/Edit Data -> All Rows```

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/09.png)

12 - There are register in ```places``` table to populate the endpoint tests.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/10.png)

13 - If you have doubt about the working of Laravel from service Docker, you can access:

```
http://localhost:8080
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/11.png)
