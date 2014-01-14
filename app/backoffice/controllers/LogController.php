<?php

class LogController extends Zend_Controller_Action
{
    /**
     * @Inject("log.file")
     * @var string
     */
    private $logFile;

    public function clearAction()
    {
        file_put_contents($this->logFile, '');

        $this->redirect('/');
    }
}
