# product-list

Product List is a simple web app for storing product information and recording quantity in stock.

I made this app in order to learn how to implement common CRUD operations in Laravel.

[Live Demo](https://product-list.estorgio.net)

## Installation
- Clone the repository
  ```bash
  $ git clone https://github.com/estorgio/product-list.git
  ```
- Install composer dependencies
  ```bash
  $ composer install --optimize-autoloader --no-dev
  ```
- Create a new `.env` file from the example file
  ```bash
  $ cp .env.example .env
  ```
- Generate a new `APP_KEY` value
  ```bash
  $ php artisan key:generate
  ```
- Edit `.env` file and set appropriate configurations for the app, database, mail, etc.
  ```bash
  $ nano .env
  ```
- Once the db credentials has been set, run the migration
  ```bash
  $ php artisan migrate
  ```
- If you are using `/storage/app/public` directory for file uploads, create a symbolic link in `/public` folder to make it accessible.
  ```bash
  $ php artisan storage:link
  ```

## License
MIT

## Attribution
Dairy products icons created by [Pixelmeetup - Flaticon](https://www.flaticon.com/free-icons/dairy-products).
