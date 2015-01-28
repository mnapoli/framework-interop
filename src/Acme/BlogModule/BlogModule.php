<?php

namespace Acme\BlogModule;

use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;
use Mouf\StackPhp\SymfonyMiddleware;

/**
 * The blog module is a Symfony application.
 */
class BlogModule implements ModuleInterface
{
    public function getName()
    {
        return 'blog';
    }

    public function getContainer(ContainerInterface $rootContainer)
    {
        return null;
    }

    public function init(ContainerInterface $rootContainer) {
    	/* @var $stackBuilder \Stack\Builder */
    	$stackBuilder = $rootContainer->get('stackBuilder');
    	
    	/*$stackBuilder->push(UrlMap::class, [
    			'/blog' => new HttpApplication($rootContainer, 'dev', true)
    	]);*/
    	$stackBuilder->push(SymfonyMiddleware::class, new HttpApplication($rootContainer, 'dev', true));
    }
}
