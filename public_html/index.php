<?php

require '../vendor/autoload.php';

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App();

/**
 * Formats string to StudlyCaps using delimiter to determine the next word and
 * finally removes the delimiter from string.
 *
 * @param string
 * @param string
 * @return string
 */
function stringToStudlyCaps($str, $delimiter = '-') {
    $str = ucwords($str, $delimiter);
    $str = str_replace($delimiter, '', $str);

    return $str;
}

/**
 * Permanently redirect paths with a trailing slash to their non-trailing
 * counterpart.
 *
 * @see http://www.slimframework.com/docs/cookbook/route-patterns.html
 */
$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();

    if ($path != '/' && substr($path, -1) == '/') {
        $uri = $uri->withPath(substr($path, 0, -1));

        return $response->withRedirect((string)$uri, 301);
    }

    return $next($request, $response);
});

/**
 * Handle request and process response.
 *
 * Loads controller based endpoint and calls the controller's method based on the
 * request method.
 *
 */
$app->any('/[{controller}[/{segments:.+}]]', function (Request $request, Response $response, $args) {

    if (! count($args)) {
        $args['controller'] = strtolower(\App\Controller\Controller::DEFAULT_CONTROLLER);
    }

    $class_name = sprintf(
        'App\\Controller\\%s',
        stringToStudlyCaps($args['controller'])
    );

    if (class_exists($class_name)) {
        $controller = new $class_name($request, $response);
        $response = $controller->getRequestResponse();
    } else {
        $response = $response->withStatus(404)->write('Not Found');
    }

    return $response;
});

$app->run();
