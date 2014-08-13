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
