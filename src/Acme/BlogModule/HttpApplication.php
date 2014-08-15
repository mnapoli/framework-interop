<?php

namespace Acme\BlogModule;

use Acme\BlogBundle\AcmeBlogBundle;
use Interop\Container\ContainerInterface;
use Interop\Framework\Adapter\Symfony\SymfonyContainerAdapter;
use Sensio\Bundle\DistributionBundle\SensioDistributionBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class HttpApplication extends Kernel
{
    private $rootContainer;

    public function __construct(ContainerInterface $rootContainer, $environment, $debug)
    {
        $this->rootContainer = $rootContainer;

        parent::__construct($environment, $debug);
    }

    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SecurityBundle(),
            new TwigBundle(),
            new SensioFrameworkExtraBundle(),
            new AcmeBlogBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new WebProfilerBundle();
            $bundles[] = new SensioDistributionBundle();
            $bundles[] = new SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/app/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function getCacheDir()
    {
        // Override cache location
        return $this->rootContainer->get('cache.dir');
    }

    public function getLogDir()
    {
        // Override logs location
        return $this->rootContainer->get('logs.dir');
    }

    protected function getContainerBaseClass()
    {
        // Override the default container
        return SymfonyContainerAdapter::class;
    }

    protected function initializeContainer()
    {
        parent::initializeContainer();

        /** @var SymfonyContainerAdapter $symfonyContainer */
        $symfonyContainer = $this->getContainer();
        $symfonyContainer->setFallbackContainer($this->rootContainer);
    }
}
