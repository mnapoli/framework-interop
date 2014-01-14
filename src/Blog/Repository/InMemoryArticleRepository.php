<?php

namespace Acme\Blog\Repository;

use Acme\Blog\Article\Article;
use Acme\Blog\Article\ArticleRepository;

/**
 * Stores blog articles in memory.
 */
class InMemoryArticleRepository implements ArticleRepository
{
    private $articles;

    public function __construct()
    {
        $this->articles = [
            new Article('Hello world', 'This is a test article.'),
        ];
    }

    /**
     * @return Article[]
     */
    public function getAll()
    {
        return $this->articles;
    }
}
