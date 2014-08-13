<?php

class IndexController extends Zend_Controller_Action
{
    /**
     * @Inject("log.file")
     * @var string
     */
    private $logFile;

    public function indexAction()
    {
        $content = file_get_contents($this->logFile);

        $this->view->assign('logContent', $content);
    }
}
