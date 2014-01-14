<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

$frontend = new Application();
$frontend['debug'] = true;

// Views
$frontend->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/views',
]);

// Home
$frontend->get('/', function (Application $app) {
    return $app['twig']->render('home.twig');
});
