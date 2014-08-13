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
     * @return string
     */
    public abstract function getName();

    /**
     * @return ContainerInterface|null
     */
    public abstract function getContainer();

    /**
     * @return HttpKernelInterface|null
     */
    public abstract function getWebApplication();
}
