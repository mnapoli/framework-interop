<?php

use Acme\Blog\Article\ArticleRepository;
use Acme\Blog\Repository\InMemoryArticleRepository;

// PHP-DI container configuration
return [
    ArticleRepository::class => DI\object(InMemoryArticleRepository::class),
];
