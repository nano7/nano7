<?php namespace Nano7\View;

class ViewManager
{
    /**
     * @var string
     */
    protected $pathTemplate = '';

    /**
     * @param $pathTemplate
     */
    public function __construct($pathTemplate)
    {
        $this->pathTemplate = $pathTemplate;
    }

    /**
     * @return string
     */
    public function getPathTemplate()
    {
        return $this->pathTemplate;
    }

    /**
     * @param $viewName
     * @param array $params
     * @return View
     */
    public function make($viewName, $params = [])
    {
        $view = new View($this, $viewName, $params);

        return $view;
    }
}