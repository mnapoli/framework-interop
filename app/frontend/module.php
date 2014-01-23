<?php

use Acme\Blog\Article\ArticleRepository;
use Mouf\Interop\Silex\Application;
use Psr\Log\LoggerInterface;
use Silex\Provider\TwigServiceProvider;

$frontend = new Application();
$frontend['debug'] = true;

// DI container
$builder = new \DI\ContainerBuilder();
//$builder->wrapContainer($frontend);
$builder->addDefinitions(__DIR__ . '/../config/config.php');
$container = $builder->build();

$frontend->registerFallbackContainer($container);

// Views
$frontend->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/views',
]);

// Home
$frontend->get('/', function (Application $app) {
    /** @var ArticleRepository $articleRepository */
    $articleRepository = $app[ArticleRepository::class];
    $count = count($articleRepository->getAll());

    $app[LoggerInterface::class]->debug('Someone was on the home page');

    return $app['twig']->render('home.twig', ['articleCount' => $count]);
});

return $frontend;
