<?php

namespace Acme\BackOfficeModule;

use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;
use Interop\Framework\HttpModuleInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * The back office module is a ZF1 application.
 */
class BackOfficeModule implements HttpModuleInterface
{
	private $rootContainer;
	
    public function getName()
    {
        return 'backoffice';
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
		return new UrlMap($app, [
    			'/admin' => new HttpApplication($this->rootContainer)
    	]);

	}

}
