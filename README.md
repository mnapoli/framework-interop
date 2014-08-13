This is freaking awesome.

    composer install
    php -S localhost:8000 -t web

## What?

This is **one** application running on 3 different frameworks:

- the front-end module is running on **Silex** (`/`)
- the blog module is running on **Symfony 2** (`/blog`)
- the back-office module is running on **Zend Framework 1** (`/admin`)

## How it works

An application is divided in **modules**. A module can provide one or more of the followings:

- a DI container
- an HTTP application
- a CLI application

When the application is constructed, it will build a root DI container to which all the
module's containers will be chained.

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
    public function getWebApplication()
    {
        return new WebApplication();
    }
}
```

The "web application" can be any class implementing Symfony's `HttpKernelInterface`.

Containers can be any class implementing `Interop\Container\ContainerInterface`.
