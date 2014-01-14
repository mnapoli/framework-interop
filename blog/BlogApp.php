<?php

use Acme\BlogBundle\AcmeBlogBundle;
use DI\Bridge\Symfony\SymfonyContainerBridge;
use Sensio\Bundle\DistributionBundle\SensioDistributionBundle;
use Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class BlogApp extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
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
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * Gets the container's base class.
     *
     * @return string
     */
    protected function getContainerBaseClass()
    {
        return 'DI\Bridge\Symfony\SymfonyContainerBridge';
    }

    /**
     * Initializes the DI container.
     */
    protected function initializeContainer()
    {
        parent::initializeContainer();

        /** @var SymfonyContainerBridge $compositeContainer */
        $compositeContainer = $this->getContainer();

        // Configure your container here
        // http://php-di.org/doc/container-configuration
        $builder = new \DI\ContainerBuilder();
        $builder->wrapContainer($compositeContainer);
        $builder->addDefinitions(__DIR__ . '/config/config.php');

        $builder->build()->get(\Acme\Blog\Article\ArticleRepository::class);

        $compositeContainer->setFallbackContainer($builder->build());
    }
}
