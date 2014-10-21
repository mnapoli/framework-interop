<?php

class LogController extends Zend_Controller_Action
{
    public function clearAction()
    {
        /** @var \Interop\Container\ContainerInterface $container */
        $container = Zend_Registry::get('container');

        $logFile = $container->get('log.file');

        file_put_contents($logFile, '');

        $this->redirect('/');
    }
}
