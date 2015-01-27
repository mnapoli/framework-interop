<?php

namespace Acme\CoreModule;

use DI\ContainerBuilder;
use Interop\Framework\Module;
use Interop\Framework\ModuleInterface;
use Interop\Container\ContainerInterface;

/**
 * The Core module provides the shared config.
 */
class CoreModule implements ModuleInterface
{
    public function getName()
    {
        return 'core';
    }

    public function getContainer(ContainerInterface $rootContainer)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '/config/config.php');

        return $builder->build();
    }

	/* (non-PHPdoc)
	 * @see \Interop\Framework\ModuleInterface::init()
	 */
	public function init(ContainerInterface $rootContainer) {
		// Does nothing
	}

}
