### Prerequisites

What you need to setup your local dev environment

```
Git
Composer
php (^7.1.3 version to run composer)
```

### Installing

A step by step to get a development env running

Clone repository

```
git clone https://github.com/amrHassanAbdallah/laravel_forum.git
```

cd to repo

```
cd private-area
```

Copy .env.prod to .env 

```
cp .env.example .env 
```

Change the DB_DATABASE, DB_USERNAME & DB_PASSWORD to match the database details on your system (mysql configuration )

Also the mail configurations.

Then install Dependencies 

```
composer install
```
make sure to migrate and seed the db
```
php artisan migrate --seed
```
