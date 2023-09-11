# amlak-daran-test
 amlak daran test

this is a test of a backend developer named  `sajjad nasiri`

## swagger & Postman Collection
you can see swagger and postman collection in public directory.

## Clone or Download
git clone
```
cd existing_repo
git clone  https://github.com/sajjadnasiribrn/amlak-daran-test.git
```

## Working Branch
I worked on `main` branch. so we should checkout to main:
```
git checkout main
```

## Requirements
- PHP >= 8.2
- COMPOSER 2
- LARAVEL 10
- MYSQL >= 5.7 OR MARIADB >= 10.5.0
- Docker & Docker Compose

## Run With Docker
first you should copy .env.example file:
```
cp src/.env.example src/.env
 ```
then you should use docker-compose:
```
docker compose up -d --build
```

and finally you should run these commands:
```
docker-compose run --rm composer update
docker-compose run --rm key:generate
docker-compose run --rm optimize:clear
docker-compose run --rm artisan migrate
```

and then you can go to : http://127.0.0.1/
