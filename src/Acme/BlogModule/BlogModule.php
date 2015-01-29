<?php

namespace Acme\BlogModule;

use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;
use Mouf\StackPhp\SymfonyMiddleware;
use Interop\Framework\HttpModuleInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * The blog module is a Symfony application.
 */
class BlogModule implements HttpModuleInterface
{
	private $rootContainer = null;
	
    public function getName()
    {
        return 'blog';
    }

    public function getContainer(ContainerInterface $rootContainer)
    {
    	$this->rootContainer = $rootContainer;
        return null;
    }

    public function init() {

    }
    
	/* (non-PHPdoc)
	 * @see \Interop\Framework\HttpModuleInterface::getHttpMiddleware()
	 */
	public function getHttpMiddleware(HttpKernelInterface $app) {
		return new SymfonyMiddleware($app, new HttpApplication($this->rootContainer, 'dev', true));
	}

}
