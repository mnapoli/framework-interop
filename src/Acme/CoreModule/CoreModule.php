<?php

namespace Acme\CoreModule;

use DI\ContainerBuilder;
use Interop\Framework\Module;

/**
 * The Core module provides the shared config.
 */
class CoreModule extends Module
{
    public function getName()
    {
        return 'core';
    }

    public function getContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '/config/config.php');

        return $builder->build();
    }

    public function getWebApplication()
    {
        return null;
    }
}
