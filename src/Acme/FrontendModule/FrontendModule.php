<?php

namespace Acme\FrontendModule;

use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;
use Mouf\StackPhp\SilexMiddleware;
use Interop\Framework\HttpModuleInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * The frontend module is a Silex application.
 */
class FrontendModule implements HttpModuleInterface
{
	private $rootContainer;
	
    public function getName()
    {
        return 'frontend';
    }

    public function getContainer(ContainerInterface $rootContainer)
    {
    	$this->rootContainer = $rootContainer;
        return null;
    }
    
	/* (non-PHPdoc)
	 * @see \Interop\Framework\ModuleInterface::init()
	 */
	public function init() {
		
	}

	/* (non-PHPdoc)
	 * @see \Interop\Framework\HttpModuleInterface::getHttpMiddleware()
	 */
	public function getHttpMiddleware(HttpKernelInterface $app) {
		return new SilexMiddleware($app, new HttpApplication($this->rootContainer));
	}

}
