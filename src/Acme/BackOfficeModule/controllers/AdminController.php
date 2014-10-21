<?php

class AdminController extends Zend_Controller_Action
{
    public function indexAction()
    {
        /** @var \Interop\Container\ContainerInterface $container */
        $container = Zend_Registry::get('container');

        $logFile = $container->get('log.file');

        $content = file_get_contents($logFile);

        $this->view->assign('logContent', $content);
    }

    public function clearLogAction()
    {
        /** @var \Interop\Container\ContainerInterface $container */
        $container = Zend_Registry::get('container');

        $logFile = $container->get('log.file');

        file_put_contents($logFile, '');

        $this->redirect('/admin');
    }
}
