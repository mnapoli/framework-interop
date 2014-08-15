<?php

namespace Interop\Framework\Web;

use Exception;
use Interop\Framework\Module;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class HttpRouter implements HttpKernelInterface
{
    /**
     * @var string[]
     */
    private $routes;

    /**
     * @var Module[]
     */
    private $modules;

    public function __construct(array $routes, array $modules)
    {
        $this->routes = $routes;
        $this->modules = $modules;
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        if (empty($this->routes)) {
            throw new Exception('No routes were configured');
        }

        if (! isset($this->routes['/'])) {
            throw new Exception('No default route was configured');
        }

        $pathInfo = rawurldecode($request->getPathInfo());

        // Route to the first application matching the URL
        foreach ($this->routes as $path => $moduleName) {
            if (0 === strpos($pathInfo, $path)) {
                $module = $this->modules[$moduleName];

                $app = $module->getHttpApplication();

                if (! $app instanceof HttpKernelInterface) {
                    throw new Exception("$moduleName::getHttpApplication() doesn't return a web application through");
                }

                return $app->handle($request, $type, $catch);
            }
        }

        // 404
        return new Response('', 404);
    }
}
