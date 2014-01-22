<?php

use Stack\UrlMap;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$frontend = require __DIR__ . '/../app/frontend/module.php';
$blog = require __DIR__ . '/../app/blog/module.php';
$backoffice = require __DIR__ . '/../app/backoffice/module.php';

$map = [
    '/blog' => $blog,
    '/admin' => $backoffice,
];

$router = (new \Stack\Builder())
    ->push(UrlMap::class, $map)
    ->resolve($frontend);

$request = Request::createFromGlobals();

$response = $router->handle($request);
$response->send();

$router->terminate($request, $response);
