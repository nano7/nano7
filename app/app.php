<?php

$app = new \Nano7\Application(realpath(__DIR__.'/../'));

//---------------------------------------------------------------
// Services Provider
//---------------------------------------------------------------
$app->register(new \Nano7\BaseServiceProviders($app));
$app->register(new \Nano7\Http\WebServiceProviders($app));
$app->register(new \Nano7\View\ViewServiceProvider($app));

//---------------------------------------------------------------
// Kerners
//---------------------------------------------------------------
$app->singleton('kernel.web', 'Nano7\Http\Kernel');

return $app;
