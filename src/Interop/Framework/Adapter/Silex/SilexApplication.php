<?php

namespace Interop\Framework\Adapter;

use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use Silex\Application;

/**
 * This class extends the Silex Application class that itself extends Pimple.
 * It adds the capability for Pimple to accept fallback DI containers (or preprend
 * DI containers to Silex).
 *
 * @author David Négrier <david@mouf-php.com>
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class SilexApplication extends Application
{
    /**
     * @var ContainerInterface[]
     */
    private $prependContainers = [];

    /**
     * @var ContainerInterface[]
     */
    private $fallbackContainers = [];

    /**
     * Registers a container that will be queried if the Pimple container does not
     * contain the requested instance.
     *
     * @param ContainerInterface $container
     */
    public function registerFallbackContainer(ContainerInterface $container)
    {
        $this->fallbackContainers[] = $container;
    }

    /**
     * Registers a container that will be queried before the Pimple container.
     *
     * @param ContainerInterface $container
     */
    public function registerPrependContainer(ContainerInterface $container)
    {
        array_unshift($this->prependContainers, $container);
    }

    public function offsetExists($id)
    {
        foreach ($this->prependContainers as $container) {
            if ($container->has($id)) {
                return true;
            }
        }

        $has = parent::offsetExists($id);
        if ($has) {
            return true;
        }

        foreach ($this->fallbackContainers as $container) {
            if ($container->has($id)) {
                return true;
            }
        }

        return false;
    }

    public function offsetGet($id)
    {
        // Let's search in the prepended containers:
        foreach ($this->prependContainers as $container) {
            if ($container->has($id)) {
                return $container->get($id);
            }
        }

        if (parent::offsetExists($id)) {
            return parent::offsetGet($id);
        }

        // Let's search in the fallback mode:
        foreach ($this->fallbackContainers as $container) {
            if ($container->has($id)) {
                return $container->get($id);
            }
        }

        throw new (sprintf('Unknown entry "%s"', $id));
    }
}
