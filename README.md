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

## Local machine

Follow the steps to set the application on your local machine.

<a id="composer-intall-command"></a> 1 - Run the following commands below to install the necessary dependencies (Check the existence of `Composer` on your machine).

```
composer install 
cp .env.example .env 
composer dump-autoload 
php artisan key:generate
```

2 - In `.env` file set the following snippet to connect the application to your database (In this case, the PostgreSQL).
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rest-api-practical-test
DB_USERNAME=postgres
DB_PASSWORD=
```

3 - Run the migrations.

```
php artisan migrate
```

4 - Use the commands to perfomate the Seeders.

```
php artisan db:seed
```

If you want perfomate migrations and seeders at same time.
```
php artisan migrate --seed
```

5 - View the migrations status.
```
php artisan migrate:status
```

6 - Run the following command to start Apache to run the application.
```
php artisan serve
```

## Docker environment

First, install Docker on your machine. Please, check your operational systems the better way to install. The recommendation is check [Docker](https://docs.docker.com/get-started/get-docker/) documentation.

I am using [Laravel Sail](https://laravel.com/docs/12.x/sail) to create ```docker-compose.yml```. Commands using ```docker-compose``` also are compatibles, you can try from this way. 

In ```docker-compose.yml``` I have done a little change in a specific line:
```
# Line 12
'${APP_PORT:-8000}:80'
```

I have changed ``'${APP_PORT:-80}:80' (default value)`` to ``'${APP_PORT:-8000}:80'``. It will facilitate to avoid conflicts involving the host. Like that, the Laravel will run without problems (Mainly the endpoints from REST API).

To ```.env``` file, I have ensured the port to access Laravel on brownser.
```
APP_PORT=8000
```

My recomendation that you have done ```composer install``` before that you power on the containers, see the command <a href="#composer-intall-command">here</a>.

1 - Case you have done ```composer install```, power on the containers:

**sail command way**

```
./vendor/bin/sail up -d
```

I prefere to shorten the command, you can use:
```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

Doing this, you don't need write ```./vendor/bin/sail```, you can use a minor command: 
```
sail up -d
```

If you want see the sail commands, use: 
```
sail --help
```

**docker-compose command way**
```
docker-compose up -d
```

2 - In ```.env``` file set the following snippet to connect the application to database container from Docker:

```
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=rest-api-practical-test
DB_USERNAME=postgres
DB_PASSWORD=secret
```

3 - To performate the migrations, you need use the command:

**sail command way**

```
sail php artisan migrate --seed
```

**docker-compose command way**

```
docker-compose exec laravel.test php artisan migrate --seed
```

Or

**sail command way**

```
sail php artisan migrate
sail php db:seed
```

**docker-compose command way**

```
docker-compose exec laravel.test php artisan migrate
docker-compose exec laravel.test php artisan db:seed
```

Remember: If you have done the perfomation of migrations, don't need do again, skip the step 6. 

4 - To use ```pgAdmin 4``` services from Docker, you can access:
```
http://localhost:5050
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/01.png)

Use the credentials to make login:
```
email: admin@admin.com
password: admin
```

After you have written the credentials, click on ```Login``` button.

5 - Using the correct credentials, the dashboard will be available.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/02.png)

6 - ```Servers -> Register -> Server```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/03.png)

7 - About the ```Name``` field on ```General``` tab, you can choice whatever name (except ```localhost```), in my example I will use ```test-postgres```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/04.png)

8 - On ```Connection``` tab, you need set values on following fields:
- Host name/address: ```pgsql```
- Port: ```5432```
- Maintenance database: ```postgres```
- Username: ```postgres```
- Password: ```secret```

Finally, ckick on ```Save``` button.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/05.png)

9 - The ```test-postgres``` server has been created.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/06.png)

10 - ```test-postgres -> Databases -> rest-api-practical-test```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/07.png)

11 - ```rest-api-practical-test -> Schemas -> public -> Tables -> places```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/08.png)

12 - ```places -> View/Edit Data -> All Rows```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/09.png)

13 - There are registers in ```places``` table to populate the endpoint tests.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/10.png)

14 - If you have doubt about the working of Laravel from service Docker, you can access:

```
http://localhost:8080
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/11.png)

15 - If you power off the containers, use the command:

**sail command way**
```
sail down
```

**docker-compose way**

```
docker-compose down
```

Now, you can performate the endpoints using environment Docker, follow the REST API endpoint commands.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/images/12.png)

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
