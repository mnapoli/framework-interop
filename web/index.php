<?php

use Stack\UrlMap;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/frontend/init.php';
require_once __DIR__ . '/../app/blog/BlogApp.php';

$map = [
    '/blog' => new BlogApp('dev', true),
];

$router = (new \Stack\Builder())
    ->push(UrlMap::class, $map)
    ->resolve($frontend);

$request = Request::createFromGlobals();

$response = $router->handle($request);
$response->send();

$router->terminate($request, $response);
