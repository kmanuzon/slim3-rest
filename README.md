# Slim Framework 3 REST API Starter
Boilerplate code for serving (quickly) REST API endpoints for developing
projects.

## Installation
1. Clone this repository `git clone https://github.com/progknife/slim3-rest.git`
2. Go to directory `cd slim3-rest`
3. Install dependencies `composer install`

## Adding endpoints

To add an endpoint create a class [Sample] in `application/Controller` directory
with namespace `App\Controller`, that extends `Controller` class and have a
"getAction" method that returns a string [Hello World!]. You now have a
`GET /sample` endpoint!

Each controller class in the `application/Controller` directory corresponds to
an endpoint while its methods corresponds to the request method suffixed with
"Action" e.g. getAction, postAction etc.

```php
<?php
namespace App\Controller;

class Sample extends Controller
{
    /**
     * GET /sample endpoint.
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     */
    protected function getAction($request, $response)
    {
        return '<h1>Hello World!</h1>';
    }
}

```

The controller methods are provided with the `Request` and `Response` objects
from Slim Framework 3 as the first argument and second argument respectively.

NOTE: StudlyCaps class names can be accessed by hyphenating the class name in
the endpoint e.g. `GET /studly-caps`.

NOTE: The routing map looks like this: `/controller[/segments...]` where segment
is optional and can be any arbitrary amount. This route pattern is defined in
`public/index.php` and can be accessed by `getUrlSegment()` method in controller
class.

## Sample endpoints

`GET /index`
Returns all available endpoints.

`GET /books`
Returns all books (JSON).

`GET /book/1`
Returns information about the book specified by book id (JSON).

To see some sample data return by the endpoints, create `test` database by the
root user and add the table it:
```sql
CREATE TABLE `books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `books`(`title`) VALUES('Book of Eli');
INSERT INTO `books`(`title`) VALUES('The Da Vinci Code');
```
