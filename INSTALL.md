## How to install

### Necessary minimum
- PHP 8.1 and above
- Composer 2

### Installation step one

- composer install
- configure ports in docker-compose.yml
- customize env at your discretion
- ./vendor/bin/sail up -d
- ./vendor/bin/sail bash

### Installation step two

inside the container

- composer update
- php artisan key:generate
- php artisan optimize:clear
- php artisan migrate
- php artisan db:seed

In the root of the project there is a file for postman Book.postman_collection.json for visual control and there are also PHPUnit tests.
