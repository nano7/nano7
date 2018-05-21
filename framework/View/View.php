<?php namespace Nano7\View;

use Nano7\Support\Filesystem;

class View
{
    /**
     * @var ViewManager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @param $name
     * @param $params
     */
    public function __construct(ViewManager $manager, $name, $params)
    {
        $this->manager = $manager;
        $this->name    = $name;
        $this->params  = $params;
        $this->files   = new Filesystem();
    }

    /**
     * @param string|array $key
     * @param string|null $value
     * @return $this
     */
    public function with($key, $value = null)
    {
        if (is_array($key)) {
            $this->params = array_merge([], $this->params, $key);
        }

        $this->params[$key] = $value;

        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        $file = $this->files->combine($this->manager->getPathTemplate(), $this->name . '.php');
        if (! $this->files->exists($file)) {
            throw new \Exception(sprintf('View `%s` not exist', $this->name));
        }

        $render = function ($file_render, $data) {
            extract($data);

            include $file_render;
        };

        ob_start();
        try {
            $render($file, $this->params);

            $content = ob_get_clean();
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        return $content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}