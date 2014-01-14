<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class BackOfficeModule implements HttpKernelInterface
{
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        define('APPLICATION_PATH', __DIR__);
        define('APPLICATION_ENV', 'development');

        $application = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );

        $controller = Zend_Controller_Front::getInstance();
        $controller->setBaseUrl('/admin');

        ob_start();

        $application->bootstrap()
            ->run();

        $content = ob_get_clean();

        return new Response($content);
    }
}
