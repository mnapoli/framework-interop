<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../frontend/init.php';
require_once __DIR__ . '/../blog/BlogApp.php';

$map = [
    '/blog' => new BlogApp('dev', true),
];

$router = (new \Stack\Builder())
    ->push('Stack\UrlMap', $map)
    ->resolve($frontend);

$request = Request::createFromGlobals();

$response = $router->handle($request);
$response->send();

$router->terminate($request, $response);
