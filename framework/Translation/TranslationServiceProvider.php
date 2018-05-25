<?php namespace Nano7\Translation;

use Illuminate\Translation\Translator;
use Nano7\Support\ServiceProvider;
use Illuminate\Translation\FileLoader;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register objetos base.
     */
    public function register()
    {
        $this->registerLoader();

        $this->registerTraslator();
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new FileLoader($app['files'], $app['path.lang']);
        });
    }

    /**
     * Register translator.
     *
     * @return void
     */
    protected function registerTraslator()
    {
        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);

            return $trans;
        });
    }
}