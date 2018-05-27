<?php

declare(strict_types = 1);

namespace Example;

require dirname(__DIR__) . '/vendor/autoload.php';

use \Http\HttpRequest as Request;
use \Http\HttpResponse as Response;

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

$request = new Request($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new Response;

$content = '<h1>Hello World</h1>';
$response->setContent($content);
$response->setStatusCode(200);

foreach ($response->getHeaders() as $header) {
  header($header, false);
}

echo $response->getContent();

// throw new \Exception;

// echo "Hello World!";

