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
- a CLI application

When the application is constructed, it will build a root DI container to which all the
module's containers will be chained.

Then, HTTP/CLI applications can be built using the **root** container (not the module's
container), which allows to access all the entries of all the container's.

## How to write a module

You start by writing a class that extends `Interop\Framework\Module`:

```php
namespace Acme\BlogModule;

class BlogModule extends Module
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
    public function getContainer()
    {
        return null;
    }

    /**
     * You can return an HTTP application if the module provides one.
     *
     * @return HttpKernelInterface|null
     */
    public function getHttpApplication()
    {
        return new HttpApplication();
    }
}
```

HTTP applications can be any class implementing Symfony's `HttpKernelInterface`.

Containers can be any class implementing `Interop\Container\ContainerInterface`.
