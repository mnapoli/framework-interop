<?php

namespace Acme\Blog\Article;

/**
 * Blog article repository.
 */
interface ArticleRepository
{
    /**
     * @return Article[]
     */
    public function getAll();
}
