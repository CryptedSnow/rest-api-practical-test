<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Files of importancy
- [Places (migration)](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/migrations/2025_04_09_170109_create_places_table.php)
- [PlaceSeeder](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/PlaceSeeder.php)
    - [DatabaseSeeder](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/DatabaseSeeder.php)
- [api.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/routes/api.php)
- [PlaceModel.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Models/PlaceModel.php)
- [PlaceController.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Http/Controllers/Api/PlaceController.php)
- [docker-compose.yml](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/docker-compose.yml)
- [Dockerfile](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/Dockerfile)
- [nginx.conf](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/nginx/default.conf)

## Docker environment

1 - Power on the containers:
```
docker-compose up -d
```

2 - Run the ```composer install``` command:
```
docker-compose exec app composer install
```

3 - Create ```.env``` file:
```
docker-compose exec app cp .env.example .env  
```

4 - Generate to ```.env``` file:
```
docker-compose exec app php artisan key:generate
```

5 - In ```.env``` file set the following snippet to connect the application to database container from **Docker**:

```
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=rest-api-practical-test
DB_USERNAME=postgres
DB_PASSWORD=secret
```

6 - To performate the migrations, you need use the command:
```
docker-compose exec app php artisan migrate
```

7 - Use the command to perfomate the Seeders:
```
docker-compose exec app php artisan db:seed
```

8 - To use ```pgAdmin``` services from Docker, you can access:
```
http://localhost:5050
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/01.png)

Use the credentials to make login:
```
email: admin@admin.com
password: admin
```

After you have written the credentials, click on ```Login``` button.

9 - Using the correct credentials, the dashboard will be available.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/02.png)

10 - ```Servers -> Register -> Server```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/03.png)

11 - About the ```Name``` field on ```General``` tab, you can choice whatever name (except ```localhost```), in my example I will use ```test-postgres```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/04.png)

12 - On ```Connection``` tab, you need set values on following fields:
- Host name/address: ```pgsql```
- Port: ```5432```
- Maintenance database: ```postgres```
- Username: ```postgres```
- Password: ```secret```

Finally, ckick on ```Save``` button.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/05.png)

13 - The ```test-postgres``` server has been created.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/06.png)

14 - ```test-postgres -> Databases -> rest-api-practical-test```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/07.png)

15 - ```rest-api-practical-test -> Schemas -> public -> Tables -> places```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/08.png)

16 - ```places -> View/Edit Data -> All Rows```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/09.png)

17 - There are registers in ```places``` table to populate the endpoint tests.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/10.png)

18 - If you have doubt about the working of Laravel from service Docker, you can access:

```
http://localhost:8000
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/11.png)

19 - If you power off the containers, use the command:

```
docker-compose down
```

Now, you can performate the endpoints using environment Docker, follow the REST API endpoint commands.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/12.png)

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

Case you didn't run the seeders the endpoint response will be:
```
// Response - Status: 404 Not Found
{
    "message": "No places found."
}
```

**POST: localhost:8000/api/place**
```
// JSON body
{
    "name": "Gold Saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII"
}
```

```
// Response - Status: 201 Created
{
    "id": 5,
    "name": "Gold Saucer",
    "slug": "gold-saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII",
    "created_at": "10-04-2025 08:36:02",
    "updated_at": "10-04-2025 08:36:02"
}
```

**GET: localhost:8000/api/place/id**
- You need change **id** for **5** (If you didn't run the seeder, use **1**).
```
// Response - Status: 200 OK
{
    "id": 5,
    "name": "Gold Saucer",
    "slug": "gold-saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII",
    "created_at": "10-04-2025 08:36:02",
    "updated_at": "10-04-2025 08:36:02"
}
```

**GET: localhost:8000/api/place-search?name=**
- You need change **name=** for **name=Gold**.
```
// Response - Status: 200 OK
[
    {
        "id": 5,
        "name": "Gold Saucer",
        "slug": "gold-saucer",
        "state": "Square Enix",
        "city": "Final Fantasy VII",
        "created_at": "10-04-2025 08:36:02",
        "updated_at": "10-04-2025 08:36:02"
    }
]
```

**PUT: localhost:8000/api/place/id**
- You need change **id** for **5** (If you didn't run the seeder, use **1**).
```
// JSON body
{
    "name": "Gold Saucer",
    "state": "Square Enix"
    "city": "Final Fantasy VII Rebirth" // Final Fantasy VII to Final Fantasy VII Rebirth
}
```

```
// Response - Status: 200 OK
{
    "id": 5,
    "name": "Gold Saucer",
    "slug": "gold-saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII Rebirth",
    "created_at": "10-04-2025 08:36:02",
    "updated_at": "10-04-2025 08:38:07"
}
```

**DELETE: localhost:8000/api/place/id**
- You need change **id** for **5** (If you didn't run the seeder, use **1**).
```
// Response - Status: 200 OK
{
    "message": "Gold Saucer is deleted."
}
```
