# Workout Tracker Backend

Backend created in Laravel for Workout Tracker mobile app

- [Checkout the mobile app repo](https://github.com/anas43950/my-workout-tracker-flutter.git)

## Getting Started

- Clone the project
- Choose a database, if you prefer MYSQL, create a database for this project, and populate the relevant fields (such as DB_USERNAME etc.). If you prefer SQLITE, you can just create a database.sqlite file under database directory. 
- Run the following commands to setup the project and get it up and running locally: 
```
composer install
php artisan migrate
php artisan serve
```
- You will get the localhost URL in the terminal output, and you can use that to invoke the endpoints.