<?php

use Acme\BackOfficeModule\BackOfficeModule;
use Acme\BlogModule\BlogModule;
use Acme\CoreModule\CoreModule;
use Acme\FrontendModule\FrontendModule;
use DI\ContainerBuilder;
use Interop\Framework\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/configs/config.php');
$container = $builder->build();

$app = new Application(
    [
        CoreModule::class,
        FrontendModule::class,
        BlogModule::class,
        BackOfficeModule::class,
    ],
    $container
);

$app->setWebRoutes([
    '/blog' => BlogModule::class,
    '/admin' => BackOfficeModule::class,
    '/' => FrontendModule::class,
]);
