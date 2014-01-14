<?php

use Acme\Blog\Article\ArticleRepository;
use Acme\Blog\Repository\InMemoryArticleRepository;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

// PHP-DI container configuration
return [
    // Repositories
    ArticleRepository::class => DI\object(InMemoryArticleRepository::class),

    // Logger
    LoggerInterface::class => DI\factory(function() {
        $logger = new Logger('name');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));
        return $logger;
    }),
    // Alias for Symfony
    'logger' => DI\link(LoggerInterface::class),
];
