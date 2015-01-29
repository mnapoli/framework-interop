This is an example of interoperability between frameworks through framework-agnostic **modules**.

    composer install
    php -S localhost:8000 -t web

## What?

This is **one** application composed of 3 modules, each one using a different framework:

- the front-end module is running on **Silex** (`/`)
- the blog module is running on **Symfony 2** (`/blog`)
- the back-office module is running on **Zend Framework 1** (`/admin`)

## How it works

A module can provide one or more of the followings:

- a DI container
- an HTTP application
- a CLI application (TODO)

When the application is constructed, it will build a root DI container to which all the
module's containers will be chained.

Then, HTTP/CLI applications can be built using the **root** container (not the module's
container), which allows to access all the entries of all the container's.

## How to write a module

You start by writing a class that implements `Interop\Framework\ModuleInterface`:

```php
namespace Acme\BlogModule;

class BlogModule extends ModuleInterface
{
    public function getName()
    {
        return 'blog';
    }

    /**
     * You can return a container if the module provides one.
     *
     * It will be chained to the application's root container.
     *
     * @return ContainerInterface|null
     */
    public function getContainer(ContainerInterface $rootContainer)
    {
        return new Picotainer([
            "myService" => function() { return new MyService(); }
        ], $rootContainer);
    }
}
```

If your module provides an HTTP router, your module can implement the `HttpModuleInterface`.

```php
namespace Acme\BlogModule;

class BlogModule extends HttpModuleInterface
{
    public function getName()
    {
        return 'blog';
    }

    /**
     * You can return a container if the module provides one.
     *
     * It will be chained to the application's root container.
     *
     * @param $rootContainer ContainerInterface The root container (provided so you can use it as a delegate-lookup container).
     * @return ContainerInterface|null
     */
    public function getContainer(ContainerInterface $rootContainer)
    {
        return new Picotainer([
            "myService" => function() { return new MyService(); }
        ], $rootContainer);
    }

    /**
     * You can return a StackPHP middleware if the module provides one.
     *
     * @param $app HttpKernelInterface The kernel your middleware will be wrapping.
     * @return HttpKernelInterface|null
     */
    public function getHttpMiddleware(HttpKernelInterface $app)
    {
        return new MyMiddleware($app);
    }
}
```

HTTP applications can be any [StackPHP middleware](http://stackphp.com) i.e. a class implementing Symfony's `HttpKernelInterface` that can be chained with other `HttpKernelInterface` objects.

Containers can be any class implementing `Interop\Container\ContainerInterface`.
