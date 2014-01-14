<?php

use Acme\Blog\Article\ArticleRepository;
use Acme\Blog\Repository\InMemoryArticleRepository;
use DI\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

// PHP-DI container configuration
return [
    // Repositories
    ArticleRepository::class => DI\object(InMemoryArticleRepository::class),

    'log.file' => __DIR__ . '/../logs/app.log',

    // Logger
    LoggerInterface::class => DI\factory(function(ContainerInterface $c) {
        $logger = new Logger('name');
        $logger->pushHandler(new StreamHandler($c->get('log.file'), Logger::DEBUG));
        return $logger;
    }),
    // Alias for Symfony
    'logger' => DI\link(LoggerInterface::class),
];
