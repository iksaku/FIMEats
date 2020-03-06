# FIMEats Project

### Description

- The objective of this project is to provide a virtual Menu of available food around _Ciudad Universitaria_ in _Monterrey, Nuevo León_.
- This project is based on the [Laravel framework](https://laravel.com/) (^7.0).
- Javascript dependencies are handled by [NodeJS](https://nodejs.org/en/) (^10) and [Yarn](https://yarnpkg.com/en/) (^1.17).
- Database used in this project is [MariaDB](https://mariadb.org/) (^10.3), but design must work with any SQL-based engine.

### Contributing
You can help improve this project. You may use the following steps to get the project up and running in your machine:
1. Clone the project with git: `git clone https://github.com/iksaku/FIMEats`.
2. Install composer dependencies: `composer install`.
3. Copy file `.env.example` to `.env` and setup variables that meet your setup.
4. Migrate your database and fill with data using: `php artisan migrate --seed`.
5. Install node dependencies: `yarn install`.
6. In order to view Web App you must build assets, but you can face with 2 situations:
    - a. If you **don't** want to modify the front end, you can run `yarn prod`.
    - b. Otherwise, if you *want* to contribute to the frontend, you may run `yarn watch` and start modifying files (they will automatically update).

### Background
- This project started to be presented as a school assignment, but the actual interest grew so much. That's why I'm Open Sourcing it, so other college mates can contribute to its development.
- Started as final project for the "Object Oriented Programming" class, taken with Mayra Deyanira from August to December in 2018.
