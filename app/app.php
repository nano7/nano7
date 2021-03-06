<?php

$app = new \Nano7\Foundation\Application(realpath(__DIR__.'/../'));

//---------------------------------------------------------------
// Services Provider
//---------------------------------------------------------------
$app->register(new \Nano7\Foundation\FoundationServiceProviders($app));
$app->register(new \Nano7\Foundation\Translation\TranslationServiceProvider($app));
$app->register(new \Nano7\Console\ConsoleServiceProviders($app));

//---------------------------------------------------------------
// Services Provider Configured
//---------------------------------------------------------------
$providers = $app->make('manifest')->providers();
foreach ($providers as $provider) {
    $app->register(new $provider($app));
}

return $app;
