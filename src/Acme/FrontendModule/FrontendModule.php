<?php

namespace Acme\FrontendModule;

use Interop\Framework\Module;

/**
 * The frontend module is a Silex application.
 */
class FrontendModule extends Module
{
    public function getName()
    {
        return 'frontend';
    }

    public function getContainer()
    {
        return null;
    }

    public function getHttpApplication()
    {
        return new HttpApplication($this->rootContainer);
    }
}
