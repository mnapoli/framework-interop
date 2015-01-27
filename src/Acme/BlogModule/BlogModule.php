<?php

namespace Acme\BlogModule;

use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;

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

    /*public function getHttpApplication()
    {
        return new HttpApplication($this->rootContainer, 'dev', true);
    }*/
    
    public function init(ContainerInterface $rootContainer) {
    	/* @var $stackBuilder \Stack\Builder */
    	$stackBuilder = $rootContainer->get('stackBuilder');
    	
    	$stackBuilder->push(UrlMap::class, [
    			'/blog' => new HttpApplication($rootContainer, 'dev', true)
    	]);
    }
}
