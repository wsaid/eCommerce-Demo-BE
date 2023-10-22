<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Table Of Contents

[[_TOC_]]

## How to install

### Clone Repository
open your terminal, go to the directory that you will install this project, then run the following command:

```bash
git clone git@github.com:wsaid/eCommerce-Demo-BE.git

cd eCommerce-Demo-BE
```

### Install packages
Install vendor using composer

```bash
composer install
```

### Configure .env
Copy .env.example file

```bash
cp .env.example .env
```

Then run the following command:

```php
php artisan key:generate
```

### Migrate Data
Using MySQL, build a blank database, set it up in your.env file, and then use the command line to generate all tables and seed dummy data:

```php
php artisan migrate:fresh --seed
```

### Running Application
To serve the laravel app, you need to run the following command

```php
php artisan serve
```
The api can now be accessed at

    http://localhost:8000/api

### API

A postman collection for APIs located in the root directory inside postman folder