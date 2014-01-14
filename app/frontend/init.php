<?php

use Acme\Blog\Article\ArticleRepository;
use Mouf\Interop\Silex\Application;
use Silex\Provider\TwigServiceProvider;

$frontend = new Application();
$frontend['debug'] = true;

// DI container
$builder = new \DI\ContainerBuilder();
//$builder->wrapContainer($frontend);
$builder->addDefinitions(__DIR__ . '/../config/config.php');
$frontend->registerFallbackContainer($builder->build());

// Views
$frontend->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/views',
]);

// Home
$frontend->get('/', function (Application $app) {
    /** @var ArticleRepository $articleRepository */
    $articleRepository = $app[ArticleRepository::class];
    $count = count($articleRepository->getAll());

    return $app['twig']->render('home.twig', ['articleCount' => $count]);
});
