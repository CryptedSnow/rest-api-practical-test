## Files of importancy
- [Places (migration)](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/migrations/2025_04_09_170109_create_places_table.php)
- [DatabaseSeeder.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/DatabaseSeeder.php)
    - [PlaceSeeder.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/database/seeders/PlaceSeeder.php)
- [PlaceInterface.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Interfaces/PlaceInterface.php)
- [PlaceService.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Services/PlaceService.php)
- [AppServiceProvider.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Providers/AppServiceProvider.php)
- [api.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/routes/api.php)
- [PlaceRequest (classes)](https://github.com/CryptedSnow/rest-api-practical-test/tree/main/app/Http/Requests)
- [PlaceModel.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Models/Place.php)
- [PlaceController.php](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/app/Http/Controllers/Api/PlaceController.php)
- [docker-compose.yml](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/docker-compose.yml)
- [Dockerfile](https://github.com/CryptedSnow/rest-api-practical-test/tree/main/docker)
- [nginx.conf](https://github.com/CryptedSnow/rest-api-practical-test/blob/main/nginx/default.conf)

## Docker environment

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

To use ```Swagger``` services from Docker, you can access

```
http://localhost:8000/api/documentation
```

You will see:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/12.png)

To access endpoints from Swagger, click on ```V``` icon:

![](https://raw.githubusercontent.com/CryptedSnow/rest-api-practical-test/refs/heads/main/public/img/13.png)

**GET: localhost:8000/api/places**

- Response: 200 OK
```
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

**POST: localhost:8000/api/places**

**JSON body**

```
{
    "name": "Gold Saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII"
}
```

- Response: 201 Created
```
{
    "message": "Place Gold Saucer was created.",
    "data": {
        "id": 5,
        "name": "Gold Saucer",
        "slug": "gold-saucer",
        "state": "Square Enix",
        "city": "Final Fantasy",
        "created_at": "28-04-2026 09:29:05",
        "updated_at": "28-04-2026 09:29:05"
    }
}
```

**GET: localhost:8000/api/places/{id}**
- You need change **{id}** for **5**.
- Response: 200 OK

```
{
    "data": {
        "id": 5,
        "name": "Gold Saucer",
        "slug": "gold-saucer",
        "state": "Square Enix",
        "city": "Final Fantasy",
        "created_at": "28-04-2026 09:29:05",
        "updated_at": "28-04-2026 09:29:05"
    }
}
```

**GET: localhost:8000/api/places-search?name=**
- You need change **name=** for **name=Gold**.
- Response: 200 OK

```
{
    "data": [
        {
            "id": 5,
            "name": "Gold Saucer",
            "slug": "gold-saucer",
            "state": "Square Enix",
            "city": "Final Fantasy",
            "created_at": "28-04-2026 09:29:05",
            "updated_at": "28-04-2026 09:29:05"
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

**PUT: localhost:8000/api/places/{id}**
- You need change **{id}** for **5**.

**JSON body**

```
{
    "name": "Gold Saucer",
    "state": "Square Enix",
    "city": "Final Fantasy VII Rebirth" // Final Fantasy to Final Fantasy VII Rebirth
}
```

- Response - Status: 202 Accepted

```
{
    "message": "Place Gold Saucer was updated.",
    "data": {
        "id": 5,
        "name": "Gold Saucer",
        "slug": "gold-saucer",
        "state": "Square Enix",
        "city": "Final Fantasy VII Rebirth",
        "created_at": "28-04-2026 09:29:05",
        "updated_at": "28-04-2026 09:32:38"
    }
}
```

Or to update partially:

**JSON body**

```
{
    "city": "Final Fantasy VII Rebirth"
}
```

- Response: 202 Accepted

```
{
    "message": "Place Gold Saucer was updated.",
    "data": {
        "id": 5,
        "name": "Gold Saucer",
        "slug": "gold-saucer",
        "state": "Square Enix",
        "city": "Final Fantasy VII Rebirth",
        "created_at": "28-04-2026 09:29:05",
        "updated_at": "28-04-2026 09:32:38"
    }
}
```

**DELETE: localhost:8000/api/places/{id}**
- You need change **{id}** for **5**.
- Response: 200 OK

```
{
    "message": "Place Gold Saucer was deleted."
}
```
