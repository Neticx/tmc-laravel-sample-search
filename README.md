# TMC Laravel Application Consumer

## Installation

- clone this repository
- copy `.env.example` file and rename with `.env`
- run `composer install`
- setup database and queue connection on `.env` file
- run database migration with command `php artisan migrate`
- run the application with command `php artisan serve`

## Run RabbitMQ Consumer
#### please run the consumer with `php artisan rabbitmq:consume`

