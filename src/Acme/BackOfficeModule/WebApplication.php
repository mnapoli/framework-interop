<?php

namespace Acme\BackOfficeModule;

use DI\Bridge\ZendFramework1\Dispatcher;
use Interop\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Zend_Application;
use Zend_Controller_Front;

class WebApplication implements HttpKernelInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        define('APPLICATION_PATH', __DIR__);
        define('APPLICATION_ENV', 'development');

        $application = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );

        $dispatcher = new Dispatcher();
        $dispatcher->setContainer($this->container);

        $frontController = Zend_Controller_Front::getInstance();
        $frontController->setDispatcher($dispatcher);

        ob_start();

        $application->bootstrap()
            ->run();

        $content = ob_get_clean();

        return new Response($content);
    }
}
