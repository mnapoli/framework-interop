This is freaking awesome.

    composer install
    php -S localhost:8000 -t web

## What?

This is **one** application running on 3 different frameworks:

- the front-end module is running on **Silex** (`/`)
- the blog module is running on **Symfony 2** (`/blog`)
- the back-office module is running on **Zend Framework 1** (`/admin`)

These modules are not independent sup-applications. They really are modules of one application:

- they share the same virtual host and URL (each module has a prefix)
- they share the same DI container and its configuration (PHP-DI is used here)
- they share the same model and services (loggers, mailer, ORM, repositories, …)

The model code (model classes, repositories and services) is framework-agnostic.

## Why?

Because!

## How?

1. Symfony's `HttpKernelInterface` and [Stack](http://stackphp.com/) allows to route each request to the correct framework/module
2. [Container interoperability](https://github.com/container-interop/container-interop) to make your config/container framework-agnostic
