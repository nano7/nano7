<?php namespace Nano7;

use Illuminate\Container\Container;

class Application extends Container
{
    /**
     * The Laravel framework version.
     *
     * @var string
     */
    const VERSION = '5.6.0';

    /**
     * The base path for the Laravel installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * @var bool
     */
    protected $booted = false;

    /**
     * Create a new Illuminate application instance.
     *
     * @param  string|null $basePath
     * @return void
     */
    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();
        //$this->registerBaseServiceProviders();
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance('app', $this);
        $this->instance('Nano7\Application', $this);
        $this->instance('Illuminate\Contracts\Container\Container', $this);
    }

    /**
     * Set the base path for the application.
     *
     * @param  string $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->bindPathsInContainer();

        return $this;
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @param  string $path Optionally, a path to append to the base path
     * @return string
     */
    public function basePath($path = '')
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Bind all of the application paths in the container.
     *
     * @return void
     */
    protected function bindPathsInContainer()
    {
        $this->instance('path.base',   $this->basePath());
        $this->instance('path.app',    $this->basePath('app'));
        $this->instance('path.config', $this->basePath('app/config'));
        $this->instance('path.theme',  $this->basePath('theme'));
    }

    /**
     * Boot application.
     */
    public function boot($callback = null)
    {
        // Add listen boot
        if (! is_null($callback)) {
            event()->listen('app.boot', $callback);
            return;
        }

        // Verificar se jah foi bootado
        if ($this->booted) {
            return;
        }

        // Fire boot app
        event('app.boot', [$this->app]);
    }

    /**
     * Get the current application locale.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this['config']->get('app.locale');
    }

    /**
     * Set the current application locale.
     *
     * @param  string  $locale
     * @return void
     */
    public function setLocale($locale)
    {
        $this['config']->set('app.locale', $locale);

        //$this['translator']->setLocale($locale);

        //$this['events']->dispatch(new Events\LocaleUpdated($locale));
    }

    /**
     * Determine if application locale is the given locale.
     *
     * @param  string  $locale
     * @return bool
     */
    public function isLocale($locale)
    {
        return $this->getLocale() == $locale;
    }
}