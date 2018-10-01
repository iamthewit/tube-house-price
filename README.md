## About This Project

Initially I started this project as a way for me to see what I could remember from past experiences with DDD based projects I have worked on.
Since then the project has become a place for me to slowly try out ideas and generally mess around with PHP.

The general idea of the project is to plot the average price of house prices near tube stations on a map. The `Listing` directory inside `src/TubeHousePrice` contains the domain code. All supporting code, such as Controllers and Repositories can be found in the `src/TubeHousePrice/Application` directory.

### Requirements

- PHP 7.2
- Sqlite 3.19

## Setup

#### Create .env file

- `cp .env.example .env`
- Set PROJECT_ROOT_PATH in the .env file

#### Install the dependencies

- `composer install`

#### Run the tests

- `./vendor/bin/phpunit tests/`

## Frontend

#### Migrate the database

- `touch resources/sqlite/database/tube_house_prices.db`
- `sqlite3 resources/sqlite/database/tube_house_prices.db < resources/sqlite/migrations/migrations.sql`

#### Seed the database

- `php bin/seed-listings.php`

If you want to view the JSON output by the listings endpoint start the built in PHP web server

- `php -S localhost:8080 index.php`

- Navigate to http://localhost:8080/listings
