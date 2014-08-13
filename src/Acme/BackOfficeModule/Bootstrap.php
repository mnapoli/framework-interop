<?php

use DI\ContainerBuilder;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Initialize the dependency injection container
     */
    protected function _initDependencyInjection()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '/../config/config.php');
        $container = $builder->build();

        $dispatcher = new \DI\Bridge\ZendFramework1\Dispatcher();
        $dispatcher->setContainer($container);

        $frontController = Zend_Controller_Front::getInstance();
        $frontController->setDispatcher($dispatcher);
    }
}
