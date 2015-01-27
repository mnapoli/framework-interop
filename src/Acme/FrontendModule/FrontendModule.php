<?php

namespace Acme\FrontendModule;

use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;
use Mouf\StackPhp\SilexMiddleware;

/**
 * The frontend module is a Silex application.
 */
class FrontendModule implements ModuleInterface
{
    public function getName()
    {
        return 'frontend';
    }

    public function getContainer(ContainerInterface $rootContainer)
    {
        return null;
    }
    
	/* (non-PHPdoc)
	 * @see \Interop\Framework\ModuleInterface::init()
	 */
	public function init(ContainerInterface $rootContainer) {
		/* @var $stackBuilder \Stack\Builder */
		$stackBuilder = $rootContainer->get('stackBuilder');
		
		$stackBuilder->push(SilexMiddleware::class, new HttpApplication($rootContainer));
	}

}
