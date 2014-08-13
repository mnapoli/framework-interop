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
            new Article('One great article', 'I hate it when people don\'t finish their'),
            new Article('Hello world', 'This is a test article.'),
            new Article('Grand opening', 'We are opening our blog. This is going to be great!'),
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
