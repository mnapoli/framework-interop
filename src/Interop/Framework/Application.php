<?php

namespace Interop\Framework;

use Acclimate\Container\CompositeContainer;
use Exception;
use Interop\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Mouf\Picotainer\Picotainer;
use Stack\Builder;

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

    /**
     * 
     * @param array $modules An array of strings (the class name of the module), or objects implementing ModuleInterface 
     * @param ContainerInterface $container
     * @throws Exception
     */
    public function __construct(array $modules, ContainerInterface $container = null)
    {
        $this->container = new CompositeContainer();

        if ($container) {
            $this->container->addContainer($container);
        }

        // Instantiate every module
        foreach ($modules as $class) {
            if ($class instanceof ModuleInterface) {
                $module = $class;
                $this->modules[get_class($module)] = $module;
            } else {
                if (! is_subclass_of($class, ModuleInterface::class)) {
                    throw new Exception("$class is not an instance of " . ModuleInterface::class);
                }
    
                /** @var ModuleInterface $module */
                $module = new $class();
    
                $this->modules[$class] = $module;
            }

            // Register the module's container
            $subContainer = $module->getContainer($this->container);
            if ($subContainer) {
                $this->container->addContainer($subContainer);
            }
        }
    }
    
    private function init() {
        // Init every module
        foreach ($this->modules as $module) {
            $module->init();
        }
    }

    public function setWebRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function runHttp()
    {
        $this->init();
        
        // default app to return a 404 since we declare no route in it!
        $app = new \Silex\Application();
        
        $reverseModules = array_reverse($this->modules);
        foreach ($reverseModules as $module) {
        	if ($module instanceof HttpModuleInterface) {
        		$app = $module->getHttpMiddleware($app);
        	}
        }
        
        $request = Request::createFromGlobals();

        $response = $app->handle($request);
        $response->send();
    }

    public function runCli()
    {
    }
}
