<?php

namespace Acme\BackOfficeModule;

use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;
use Stack\UrlMap;

/**
 * The back office module is a ZF1 application.
 */
class BackOfficeModule implements ModuleInterface
{
    public function getName()
    {
        return 'backoffice';
    }

    public function getContainer(ContainerInterface $rootContainer)
    {
        return null;
    }
    
    public function init(ContainerInterface $rootContainer) {
    	/* @var $stackBuilder \Stack\Builder */
    	$stackBuilder = $rootContainer->get('stackBuilder');
    	 
    	$stackBuilder->push(UrlMap::class, [
    			'/admin' => new HttpApplication($rootContainer)
    	]);
    }
}
