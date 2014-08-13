<?php

namespace Interop\Framework;

use Acclimate\Container\CompositeContainer;
use Acme\Blog\Article\ArticleRepository;
use Exception;
use Interop\Container\ContainerInterface;
use Interop\Framework\Web\WebRouter;
use Symfony\Component\HttpFoundation\Request;

class Application
{
    /**
     * @var CompositeContainer
     */
    private $container;

    /**
     * @var Module[]
     */
    private $modules;

    /**
     * @var Module[]
     */
    private $routes;

    public function __construct(array $modules, ContainerInterface $container = null)
    {
        $this->container = new CompositeContainer();

        if ($container) {
            $this->container->addContainer($container);
        }

        // Instantiate every module
        foreach ($modules as $class) {
            if (! is_subclass_of($class, Module::class)) {
                throw new Exception("$class is not an instance of " . Module::class);
            }

            /** @var Module $module */
            $module = new $class($this->container);

            $this->modules[$class] = $module;

            // Register the module's container
            $subContainer = $module->getContainer();
            if ($subContainer) {
                $this->container->addContainer($subContainer);
            }
        }
    }

    public function setWebRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function runWeb()
    {
        $router = new WebRouter($this->routes, $this->modules);

        $request = Request::createFromGlobals();

        $response = $router->handle($request);
        $response->send();
    }

    public function runCli()
    {
    }
}
