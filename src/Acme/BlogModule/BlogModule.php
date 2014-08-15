<?php

namespace Acme\BlogModule;

use Interop\Framework\Module;

/**
 * The blog module is a Symfony application.
 */
class BlogModule extends Module
{
    public function getName()
    {
        return 'blog';
    }

    public function getContainer()
    {
        return null;
    }

    public function getHttpApplication()
    {
        return new HttpApplication($this->rootContainer, 'dev', true);
    }
}
