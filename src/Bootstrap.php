<?php

declare(strict_types = 1);

namespace Example;

require dirname(__DIR__) . '/vendor/autoload.php';

use \FastRoute\{Dispatcher, RouteCollector};
use function \FastRoute\simpleDispatcher;

error_reporting(E_ALL);

$environment = 'development';

/**
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

$injector = include('Dependencies.php');

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
      $routes = include('Routes.php');
      foreach ($routes as $route) {
          $r->addRoute($route['method'], $route['path'], $route['handler']);
      }
});

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $controller = $handler["controller"];
        $method = $handler["method"];
        $vars = $routeInfo[2];

        $class = $injector->make($controller);
        $class->$method($vars);
        break;
}

echo $response->getContent();

