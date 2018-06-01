<?php

declare(strict_types = 1);

use \Auryn\Injector;

$injector = new Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER
  ]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->alias('Example\Template\Renderer', 'Example\Template\MustacheRenderer');
$injector->define('Mustache_Engine', [
  ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
        'extension' => '.html',
      ])
    ]
  ]);    

return $injector;