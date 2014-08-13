<?php

namespace Acme\BackOfficeModule;

use Interop\Framework\Module;

/**
 * The back office module is a ZF1 application.
 */
class BackOfficeModule extends Module
{
    public function getName()
    {
        return 'backoffice';
    }

    public function getContainer()
    {
        return null;
    }

    public function getWebApplication()
    {
        return new WebApplication($this->rootContainer);
    }
}
