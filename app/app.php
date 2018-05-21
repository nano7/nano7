<?php

error_reporting(E_ALL & ~E_NOTICE); // Exibe todos os erros, warnings, menos as noticias

$app = new \Nano7\Application(realpath(__DIR__.'/../'));

//---------------------------------------------------------------
// Base objects
//---------------------------------------------------------------
$app->singleton('events', function () use ($app) {
    return new \Nano7\Events\Dispatcher($app);
});

$app->singleton('config', function () use ($app) {
    return new \Nano7\Config\Repository();
});

$app->singleton('files', function () use ($app) {
    return new \Nano7\Support\Filesystem();
});

$app->singleton('url', function () use ($app) {
    return new \Nano7\Http\UrlGenerator($app['request']);
});

$app->singleton('router', function () use ($app) {
    return new \Nano7\Http\Routing\Router();
});

//---------------------------------------------------------------
// Services Provider
//---------------------------------------------------------------
$app->register(new \Nano7\View\ViewServiceProvider($app));

//---------------------------------------------------------------
// Kerners
//---------------------------------------------------------------
$app->singleton('kernel.web', 'Nano7\Http\Kernel');

return $app;
