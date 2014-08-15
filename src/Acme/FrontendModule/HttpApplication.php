<?php

namespace Acme\FrontendModule;

use Acme\Blog\Article\ArticleRepository;
use Interop\Container\ContainerInterface;
use Mouf\Interop\Silex\Application;
use Psr\Log\LoggerInterface;
use Silex\Provider\TwigServiceProvider;

class HttpApplication extends Application
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct([
            'debug' => true,
        ]);

        $this->registerFallbackContainer($container);

        // Views
        $this->register(new TwigServiceProvider(), [
            'twig.path' => __DIR__ . '/views',
        ]);

        // Home
        $this->get('/', function (Application $app) {
            /** @var ArticleRepository $articleRepository */
            $articleRepository = $app[ArticleRepository::class];
            $count = count($articleRepository->getAll());

            $this[LoggerInterface::class]->debug('Someone was on the home page');

            return $this['twig']->render('home.twig', ['articleCount' => $count]);
        });
    }
}
