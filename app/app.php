<?php

$app = new \Nano7\Application(realpath(__DIR__.'/../'));

//---------------------------------------------------------------
// Services Provider
//---------------------------------------------------------------
$app->register(new \Nano7\BaseServiceProviders($app));
$app->register(new \Nano7\Database\DatabaseServiceProviders($app));
$app->register(new \Nano7\Http\WebServiceProviders($app));
$app->register(new \Nano7\View\ViewServiceProvider($app));
$app->register(new \Nano7\Translation\TranslationServiceProvider($app));
$app->register(new \Nano7\Auth\AuthServiceProviders($app));

return $app;
