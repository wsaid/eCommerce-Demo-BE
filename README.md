<p align="center">
eCommerce Demo BE
</p>

# Getting started

## Installation

Before you begin, make sure to check the official Laravel installation guide to ensure that your server environment meets the necessary requirements.

### Clone Repository
Open your terminal and navigate to the directory where you want to install this project. Then, clone the repository:

```bash
git clone git@github.com:wsaid/eCommerce-Demo-BE.git

cd eCommerce-Demo-BE
```

### Install Dependencies

Next, install the project dependencies using Composer:


```bash
composer install
```

### Configure .env
Create a new .env file by copying the provided .env.example:

```bash
cp .env.example .env
```

Generate a unique application key with the following command:

```php
php artisan key:generate
```

### Migrate Data
If you are using MySQL, create an empty database, set the database credentials in your .env file, and then use the following command to generate the necessary database tables and seed the database with sample data:

```php
php artisan migrate:fresh --seed
```

### Running Application
To serve the Laravel application, use the following command:

```php
php artisan serve
```
The API can be accessed at:

    http://localhost:8000/api

### API Documentation

For a detailed API documentation, please refer to the provided Postman collection. You can find it in the root directory inside the "postman" folder.