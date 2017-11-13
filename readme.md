# IP Centrum Coding Test

This Laravel project is a proof of concept, designed to show best practices in modern web design, with a focus on maintainability and testability.

For this example, specific strategies employed are:

 * Separation of concerns with a service based approach
 * Coding to interfaces instead of instantiated objects
 * Terse but readable code
 * High cohesion
 * Low coupling
 * Single responsibility
 * BDD testing

## Prerequisites

The project requires the composer package manager for installation.

## Installation

 * Using git, clone the git repository locally
 
 ```
 git clone https://github.com/ecom24/ipctestproject
 ```
 
 * In the project root directory, copy file .env.example to .env
 * In the project root directory, copy file .env.behat.example to .env.behat
 * To generate an encryption key in file .env, in the project root directory, run
 
```
php artisan key:generate
```
 
 * Edit file .env and copy APP_KEY from there into file .env.behat
 
 * In the project root directory, run

```
composer install
```

 * To use the API in a browser, in the project root directory, start the inbuilt web server. Run the command

```
php artisan serve
```

The above command will start a web server on 127.0.0.1 port 8000. This is required to run the following examples in a browser. It is not required for the acceptance testing.

## Accessing the API - Examples

```
GET request
http://127.0.0.1:8000/api/books
```

```
GET request
http://127.0.0.1:8000/api/books/categories
```

```
GET request
http://127.0.0.1:8000/api/books?filter[author]=Robin+Nixon
```

```
GET request
http://127.0.0.1:8000/api/books?filter[category]=Javascript
```

```
GET request
http://127.0.0.1:8000/api/books?filter[author]=Robin+Nixon&filter[category]=PHP
```

To create a new book, send a POST request to

```
POST request
http://127.0.0.1:8000/api/books
```

The POST request body should contain the following JSON data

```
{
    'isbn': '<isbn number>',
    'title': '<title>',
    'author': '<author>',
    'category': '<category>',
    'price': '<price>'
}
```

## Running the BDD Tests

To run the BDD Behat tests, in the project root, run

```
vendor/bin/behat
```
