<?php
require '../vendor/autoload.php';

$app = new Slim\App();

$verbs = array('GET', 'POST', 'PUT', 'DELETE');
$app->map($verbs, '/[{controller}[/{id}]]', function ($request, $response, $args) {

    if (!count($args)) {
        // load index controller.
        $controller = new App\Controller\Index();
        $action = strtolower($request->getMethod()) . 'Action';
        $response->write($controller->$action());
    } else {
        // load dynamic controller.
        $class_name = sprintf(
            'App\\Controller\\%s',
            ucwords(strtolower($args['controller']))
        );
        if (class_exists($class_name)) {
            $controller = new $class_name();
            $response->write($controller->getAction($args));
        } else {
            $response->withStatus(400)->write('Bad Request');
        }
    }

    return $response;
});

$app->run();
