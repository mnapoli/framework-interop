<?php

namespace Acme\BlogBundle\Controller;

use Acme\Blog\Article\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ArticleController
{
    /**
     * @Inject("templating")
     * @var EngineInterface
     */
    private $twigRenderer;

    /**
     * @Inject
     * @var ArticleRepository
     */
    private $articleRepository;

    public function listAction()
    {
        $articles = $this->articleRepository->getAll();

        return $this->twigRenderer->renderResponse(
            'AcmeBlogBundle:Article:list.html.twig',
            array('articles' => $articles)
        );
    }
}
