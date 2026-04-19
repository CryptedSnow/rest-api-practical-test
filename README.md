## Files of importancy
- [Places (migration)](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/migrations/2025_04_09_170109_create_places_table.php)
- [DatabaseSeeder](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/DatabaseSeeder.php)
    - [PlaceSeeder](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/PlaceSeeder.php)
- [api.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/routes/api.php)
- [PlaceModel.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Models/Place.php)
- [PlaceController.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Http/Controllers/Api/PlaceController.php)
- [docker-compose.yml](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/docker-compose.yml)
- [Dockerfile](https://github.com/CryptedSnow/rest-api-practical-test/tree/main/docker)
- [nginx.conf](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/nginx/default.conf)

## Docker environment

Before run containers, you can choose PHP version of your preference (```8.0```,```8.1```,```8.2```,```8.3```,```8.4```). In ```docker-compose.yml``` to ```context```  change the version:
```
// Example: Change version to 8.0 
context: ./docker/version 
```

1 - Power on the containers:
```
docker-compose up -d
```

2 - Run the ```composer install``` command to create ```vendor``` folder:
```
docker-compose exec app composer install
```

3 - Create ```.env``` file:
```
docker-compose exec app cp .env.example .env  
```

4 - Create crypted key (Fill ```APP_KEY=``` to ```.env``` file):
```
docker-compose exec app php artisan key:generate
```

5 - In ```.env``` file set the following snippet to connect the application to database container from Docker:

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

7 - Use the command to perfomate the seeders:
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

10 - Create a server: ```Servers -> Register -> Server```.

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

14 - Check the created database: ```test-postgres -> Databases -> rest-api-practical-test```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/07.png)

15 - Check the ```places``` table: ```rest-api-practical-test -> Schemas -> public -> Tables -> places```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/08.png)

16 - Check the number of registers from ```places``` table: ```places -> View/Edit Data -> All Rows```.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/09.png)

17 - There are registers in ```places``` table to populate endpoint tests.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/10.png)

18 - If you have doubt about the working of Laravel from Docker service, you can access:

```
http://localhost:8000
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/11.png)

19 - If you power off the containers, use the command:

```
docker-compose down
```

## REST API endpoints

If you have followed the instructions above, you need use some API platform to perfomate the endpoints, you can use [POSTMAN](https://www.postman.com/) for example. It is necessary install Postman on your local machine to local tests.

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/12.png)

Now, you need follow with attention, follow endpoint instructions:

**GET: localhost:8000/api/places**
```
// Response - Status: 200 OK
{
    "data": [
        {
            "id": 1,
            "name": "Safe Room",
            "slug": "safe-room",
            "state": "Capcom",
            "city": "Raccoon City",
            "created_at": "14-04-2026 21:37:04",
            "updated_at": "14-04-2026 21:37:04"
        },
        {
            "id": 2,
            "name": "Observation Deck",
            "slug": "observation-deck",
            "state": "Konami",
            "city": "Silent Hill",
            "created_at": "14-04-2026 21:37:04",
            "updated_at": "14-04-2026 21:37:04"
        },
        {
            "id": 3,
            "name": "Arkham Asylum",
            "slug": "arkham-asylum",
            "state": "DC Comics",
            "city": "Gotham City",
            "created_at": "14-04-2026 21:37:04",
            "updated_at": "14-04-2026 21:37:04"
        },
        {
            "id": 4,
            "name": "The West Side",
            "slug": "the-west-side",
            "state": "Capcom",
            "city": "Metro City",
            "created_at": "14-04-2026 21:37:04",
            "updated_at": "14-04-2026 21:37:04"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/places?page=1",
        "last": "http://localhost:8000/api/places?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://localhost:8000/api/places?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/places",
        "per_page": 5,
        "to": 4,
        "total": 4
    }
}
```

Case you didn't run the seeders the endpoint response will be:
```
// Response - Status: 404 Not Found
{
    "message": "No places found."
}
```

**POST: localhost:8000/api/places**
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

**GET: localhost:8000/api/places/id**
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

**GET: localhost:8000/api/places-search?name=**
- You need change **name=** for **name=Gold**.
```
// Response - Status: 200 OK
{
    "data": [
        {
            "id": 5,
            "name": "Gold Saucer",
            "slug": "gold-saucer",
            "state": "Square Enix",
            "city": "Final Fantasy VII",
            "created_at": "19-04-2026 14:34:02",
            "updated_at": "19-04-2026 14:34:02"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/places-search?page=1",
        "last": "http://localhost:8000/api/places-search?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://localhost:8000/api/places-search?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/places-search",
        "per_page": 5,
        "to": 1,
        "total": 1
    }
}
```

**PUT: localhost:8000/api/places/id**
- You need change **id** for **5** (If you didn't run the seeder, use **1**).
```
// JSON body
{
    "name": "Gold Saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII Rebirth" // Final Fantasy VII to Final Fantasy VII Rebirth
}
```

```
// Response - Status: 202 Accepted
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

Or to update partially, you can use ```PATCH``` http:

**PATCH: localhost:8000/api/places/id**
- You need change **id** for **5** (If you didn't run the seeder, use **1**).
```
// JSON body
{
    "city": "Final Fantasy VII Rebirth" // Final Fantasy VII to Final Fantasy VII Rebirth
}
```

```
// Response - Status: 202 Accepted
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

**DELETE: localhost:8000/api/places/id**
- You need change **id** for **5** (If you didn't run the seeder, use **1**).
```
// Response - Status: 200 OK
{
    "message": "Gold Saucer is deleted."
}
```
