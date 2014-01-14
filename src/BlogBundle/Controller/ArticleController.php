<?php

namespace Acme\BlogBundle\Controller;

use Acme\Blog\Article\ArticleRepository;
use Psr\Log\LoggerInterface;
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

    /**
     * @Inject
     * @var LoggerInterface
     */
    private $logger;

    public function listAction()
    {
        $articles = $this->articleRepository->getAll();

        $this->logger->debug('Someone was on the blog');

        return $this->twigRenderer->renderResponse(
            'AcmeBlogBundle:Article:list.html.twig',
            array('articles' => $articles)
        );
    }
}
