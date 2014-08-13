<?php

namespace Interop\Framework;

use Interop\Container\ContainerInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

abstract class Module
{
    /**
     * @var ContainerInterface
     */
    protected $rootContainer;

    public function __construct(ContainerInterface $rootContainer)
    {
        $this->rootContainer = $rootContainer;
    }

    /**
     * Returns the name of the module.
     *
     * @return string
     */
    public abstract function getName();

    /**
     * You can return a container if the module provides one.
     *
     * It will be chained to the application's root container.
     *
     * @return ContainerInterface|null
     */
    public abstract function getContainer();

    /**
     * You can return an HTTP application if the module provides one.
     *
     * @return HttpKernelInterface|null
     */
    public abstract function getWebApplication();
}
