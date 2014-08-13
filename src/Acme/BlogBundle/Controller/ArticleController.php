<?php

namespace Acme\BlogBundle\Controller;

use Acme\Blog\Article\ArticleRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function listAction()
    {
        /** @var LoggerInterface $logger */
        $logger = $this->get(LoggerInterface::class);
        $logger->debug('Someone was on the blog');

        /** @var ArticleRepository $articleRepository */
        $articleRepository = $this->get(ArticleRepository::class);
        $articles = $articleRepository->getAll();

        return $this->render(
            'AcmeBlogBundle:Article:list.html.twig',
            ['articles' => $articles]
        );
    }
}
