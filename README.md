# Slim Framework 3 REST API Starter
Boilerplate code for serving (quickly) REST API endpoints for developing projects.

## Installation
1. Clone this repository ```git clone https://github.com/progknife/slim3-rest.git```
2. Go to directory ```cd slim3-rest```
3. Install dependencies ```composer install```

## Adding endpoints

To add an endpoint create a class [Sample] in application/Controller directory
with namespace ```App\Controller```, extends ```Controller``` class and have a
"getAction" method that returns a string [Hello World!]. You now have a
```GET /sample``` endpoint!

Each controller class in the application/Controller corresponds to an endpoint
and its methods are the request methods suffixed with "Action" e.g. getAction,
postAction etc.

The controller methods are provided with the URL query parameters (associative)
and URL segments (numeric, zero based indices including the controller) as the
first argument and second argument respectively.

NOTE: StudlyCaps class names can be accessed by hyphenating the class name e.g.
```GET /studly-caps```.

NOTE: The routing map looks like this: ```/controller[/segments...]``` and is
set in ```public/index.php```.
